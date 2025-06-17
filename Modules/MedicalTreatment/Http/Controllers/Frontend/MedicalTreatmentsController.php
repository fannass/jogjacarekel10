<?php

namespace Modules\MedicalTreatment\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\MedicalTreatment\Models\MedicalTreatment;

class MedicalTreatmentsController extends Controller
{
    public function index()
    {
        $module_title = 'Medical Treatments';
        $module_name = 'medicaltreatments';
        $medicaltreatments = MedicalTreatment::paginate(10);
        return view('medicaltreatment::frontend.medicaltreatment.index', compact('module_title', 'module_name', 'medicaltreatments'));
    }

    public function show($id)
    {
        $id = decode_id($id);
        $module_title = 'Medical Treatments';
        $module_name = 'medicaltreatments';
        $medicaltreatment = MedicalTreatment::findOrFail($id);
        return view('medicaltreatment::frontend.medicaltreatment.show', compact('module_title', 'module_name', 'medicaltreatment'));
    }
} 