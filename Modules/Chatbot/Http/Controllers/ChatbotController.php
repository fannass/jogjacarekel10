<?php

namespace Modules\Chatbot\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('chatbot::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('chatbot::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('chatbot::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('chatbot::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Handle manual chatbot conversation (AJAX/JSON)
     */
    public function conversation(Request $request)
    {
        $step = $request->input('step', 1);
        $selectedMedical = $request->input('medical_type');
        $selectedDistrict = $request->input('district');

        // Step 1: Choose medical service
        if ($step == 1) {
            $medicalTypes = \Modules\Chatbot\Models\MedicalList::orderBy('name')->pluck('name');
            return response()->json([
                'step' => 1,
                'message' => 'Please select the type of medical service you are looking for:',
                'buttons' => $medicalTypes->map(function($type) {
                    return ['label' => $type, 'value' => $type];
                })->values(),
            ]);
        }

        // Step 2: Choose district
        if ($step == 2 && $selectedMedical) {
            $districts = $this->getDistrictsDIY();
            return response()->json([
                'step' => 2,
                'message' => 'Please select the district in Yogyakarta:',
                'buttons' => collect($districts)->map(function($district) {
                    return ['label' => $district, 'value' => $district];
                }),
                'medical_type' => $selectedMedical,
            ]);
        }

        // Step 3: Show FAQ answer
        if ($step == 3 && $selectedMedical && $selectedDistrict) {
            $faq = \Modules\Chatbot\Models\Faq::where('medical_type', $selectedMedical)
                ->where('question', 'like', "%$selectedDistrict%")
                ->first();
            if ($faq) {
                return response()->json([
                    'step' => 3,
                    'message' => $faq->answer,
                    'medical_type' => $selectedMedical,
                    'district' => $selectedDistrict,
                ]);
            } else {
                return response()->json([
                    'step' => 3,
                    'message' => "Sorry, there is no data for $selectedMedical in $selectedDistrict yet.",
                    'medical_type' => $selectedMedical,
                    'district' => $selectedDistrict,
                ]);
            }
        }

        // Default fallback
        return response()->json([
            'step' => 1,
            'message' => 'Please select the type of medical service you are looking for:',
        ]);
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