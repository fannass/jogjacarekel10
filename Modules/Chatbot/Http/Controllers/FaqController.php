<?php

namespace Modules\Chatbot\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Chatbot\Models\Faq;
use Modules\MedicalCenter\Models\MedicalCenter;
use Modules\MedicalTreatment\Models\MedicalTreatment;
use Modules\MedicalPoint\Models\MedicalPoint;
use Modules\MedicalCost\Models\MedicalCost;
use Modules\MedicalAlter\Models\MedicalAlter;
use Modules\MedicalCare\Models\MedicalCare;
use Modules\Chatbot\Models\MedicalList;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::paginate(10);
        $medicalTypes = $this->getAllMedicalTypes();
        return view('chatbot::faqs.index', compact('faqs', 'medicalTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicalTypes = MedicalList::orderBy('name')->pluck('name');
        $districts = $this->getDistrictsDIY();
        return view('chatbot::faqs.create', compact('medicalTypes', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'medical_type' => 'required',
            'answer' => 'required',
            'location_type' => 'required',
        ]);

        if (empty($request->district) && empty($request->question)) {
            return back()->withErrors(['district' => 'Kecamatan atau Pertanyaan harus diisi minimal salah satu.'])->withInput();
        }

        $data = $request->only(['medical_type', 'answer', 'location_type', 'district', 'question']);
        if (!empty($data['district'])) {
            $data['question'] = $data['district'];
        }

        Faq::create($data);

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ berhasil ditambahkan!');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $faq = Faq::findOrFail($id);
        return view('chatbot::faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        $medicalTypes = MedicalList::orderBy('name')->pluck('name');
        $districts = $this->getDistrictsDIY();
        return view('chatbot::faqs.edit', compact('faq', 'medicalTypes', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'medical_type' => 'required',
            'answer' => 'required',
            'location_type' => 'required',
        ]);

        if (empty($request->district) && empty($request->question)) {
            return back()->withErrors(['district' => 'Kecamatan atau Pertanyaan harus diisi minimal salah satu.'])->withInput();
        }

        $faq = Faq::findOrFail($id);
        $data = $request->only(['medical_type', 'answer', 'location_type', 'district', 'question']);
        if (!empty($data['district'])) {
            $data['question'] = $data['district'];
        }
        $faq->update($data);

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ berhasil dihapus!');
    }

    // API untuk mendapatkan list medical types
    public function getMedicalTypes()
    {
        $types = $this->getAllMedicalTypes();
        return response()->json($types);
    }

    // API untuk mendapatkan medical berdasarkan type dan location
    public function getMedicalByTypeAndLocation(Request $request)
    {
        $type = $request->input('type');
        $location = $request->input('location');

        // Cari di semua model medical
        $medicals = collect();
        
        // Medical Center
        $medicals = $medicals->concat(
            MedicalCenter::where('type', $type)
                ->where(function($query) use ($location) {
                    $query->where('district', 'like', "%{$location}%")
                          ->orWhere('sub_district', 'like', "%{$location}%");
                })
                ->where('status', true)
                ->get()
        );

        // Medical Treatment
        $medicals = $medicals->concat(
            MedicalTreatment::where('type', $type)
                ->where('status', true)
                ->get()
        );

        // Medical Point
        $medicals = $medicals->concat(
            MedicalPoint::where('status', true)
                ->get()
        );

        // Medical Cost
        $medicals = $medicals->concat(
            MedicalCost::where('status', true)
                ->get()
        );

        // Medical Alter
        $medicals = $medicals->concat(
            MedicalAlter::where('status', true)
                ->get()
        );

        // Medical Care
        $medicals = $medicals->concat(
            MedicalCare::where('status', true)
                ->get()
        );

        return response()->json($medicals);
    }

    // Helper method untuk mendapatkan semua medical types
    private function getAllMedicalTypes()
    {
        $types = collect();
        
        // Medical Center
        $types = $types->concat(MedicalCenter::distinct()->pluck('type'));
        
        // Medical Treatment
        $types = $types->concat(MedicalTreatment::distinct()->pluck('type'));
        
        // Medical Point - menggunakan nama sebagai type
        $types = $types->concat(MedicalPoint::distinct()->pluck('name'));
        
        // Medical Cost - menggunakan nama sebagai type
        $types = $types->concat(MedicalCost::distinct()->pluck('name'));
        
        // Medical Alter - menggunakan nama sebagai type
        $types = $types->concat(MedicalAlter::distinct()->pluck('name'));
        
        // Medical Care - menggunakan nama sebagai type
        $types = $types->concat(MedicalCare::distinct()->pluck('name'));

        return $types->unique()->values();
    }

    private function getDistrictsDIY()
    {
        return [
            'Bantul', 'Banguntapan', 'Bantul', 'Dlingo', 'Imogiri', 'Jetis', 'Kasihan', 'Kretek', 'Pajangan', 'Pandak', 'Piyungan', 'Pleret', 'Pundong', 'Sanden', 'Sedayu', 'Sewon', 'Srandakan',
            'Gunungkidul', 'Gedangsari', 'Girisubo', 'Karangmojo', 'Ngawen', 'Nglipar', 'Paliyan', 'Panggang', 'Patuk', 'Playen', 'Ponjong', 'Purwosari', 'Rongkop', 'Saptosari', 'Semanu', 'Semin', 'Tanjungsari', 'Tepus', 'Wonosari',
            'Kulon Progo', 'Galur', 'Girimulyo', 'Kalibawang', 'Kokap', 'Lendah', 'Nanggulan', 'Panjatan', 'Pengasih', 'Samigaluh', 'Sentolo', 'Temon', 'Wates',
            'Sleman', 'Berbah', 'Cangkringan', 'Depok', 'Gamping', 'Godean', 'Kalasan', 'Minggir', 'Mlati', 'Moyudan', 'Ngaglik', 'Ngemplak', 'Pakem', 'Prambanan', 'Seyegan', 'Sleman', 'Tempel', 'Turi',
            'Yogyakarta', 'Danurejan', 'Gedongtengen', 'Gondokusuman', 'Gondomanan', 'Jetis', 'Kotagede', 'Kraton', 'Mantrijeron', 'Mergangsan', 'Ngampilan', 'Pakualaman', 'Tegalrejo', 'Umbulharjo', 'Wirobrajan',
        ];
    }
} 