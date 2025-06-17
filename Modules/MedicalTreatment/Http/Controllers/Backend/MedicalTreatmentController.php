<?php

namespace Modules\MedicalTreatment\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Modules\MedicalTreatment\Models\MedicalTreatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laracasts\Flash\Flash;

class MedicalTreatmentController extends BackendBaseController
{
    use Authorizable;

    protected $module_action;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'MedicalTreatments';

        // module name
        $this->module_name = 'medicaltreatments';

        // directory path of the module
        $this->module_path = 'medicaltreatment::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\MedicalTreatment\Models\MedicalTreatment";

        // Tambahkan ini
        $this->module_action = 'Store';
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'intro' => 'required|string',
            'description' => 'nullable|string',
            'benefits' => 'nullable|string',
            'rating' => 'nullable|numeric|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/medicaltreatments');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            if ($image->move($path, $filename)) {
                $data['image'] = 'uploads/medicaltreatments/' . $filename;
            } else {
                return back()->withErrors(['image' => 'Gagal mengunggah gambar.']);
            }
        }

        $medicaltreatment = $this->module_model::create($data);

        Flash::success("<i class='fas fa-check'></i> New ".Str::singular($this->module_title)." Added")->important();

        Log::info(label_case($this->module_title.' '.$this->module_action)." | '".$medicaltreatment->name.'(ID:'.$medicaltreatment->id.") ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return redirect("admin/$this->module_name");
    }

    public function update(Request $request, $id)
    {
        $medicaltreatment = $this->module_model::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:medical_treatments,slug,'.$id,
            'type' => 'required|string|max:255',
            'intro' => 'required|string',
            'benefits' => 'nullable|string',
            'description' => 'nullable|string',
            'rating' => 'nullable|numeric|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($medicaltreatment->image && file_exists(public_path($medicaltreatment->image))) {
                unlink(public_path($medicaltreatment->image));
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/medicaltreatments');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            if ($image->move($path, $filename)) {
                $data['image'] = 'uploads/medicaltreatments/' . $filename;
            } else {
                return back()->withErrors(['image' => 'Gagal mengunggah gambar.']);
            }
        }

        $medicaltreatment->update($data);

        Flash::success("<i class='fas fa-check'></i> ".Str::singular($this->module_title)." Updated Successfully")->important();

        Log::info(label_case($this->module_title.' '.$this->module_action)." | '".$medicaltreatment->name.'(ID:'.$medicaltreatment->id.") ' by User:".auth()->user()->name.'(ID:'.auth()->user()->id.')');

        return redirect("admin/$this->module_name");
    }

    public function index()
    {
        $module_title = 'Medical Treatments';
        $module_name = 'medicaltreatments';
        $module_action = 'List';
        $module_icon = 'fa-regular fa-sun';
        $medicaltreatments = MedicalTreatment::paginate(10);
        return view('medicaltreatment::backend.medicaltreatments.index', compact('module_title', 'module_name', 'module_action', 'module_icon', 'medicaltreatments'));
    }
}