<?php

namespace Modules\MedicalTreatment\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MedicalTreatment\Models\MedicalTreatment;
use Modules\MedicalTreatment\Http\Requests\MedicalTreatmentRequest;

class MedicalTreatmentController extends Controller
{
    public function index()
    {
        $treatments = MedicalTreatment::all();
        return view('medicaltreatment::index', compact('treatments'));
    }

    public function show($id)
    {
        $treatment = MedicalTreatment::findOrFail($id);
        return view('medicaltreatment::show', compact('treatment'));
    }

    public function create()
    {
        return view('medicaltreatment::create');
    }

    public function store(MedicalTreatmentRequest $request)
    {
        MedicalTreatment::create($request->validated());
        return redirect()->route('medicaltreatment.index')
            ->with('success', 'Perawatan medis berhasil ditambahkan');
    }

    public function edit($id)
    {
        $treatment = MedicalTreatment::findOrFail($id);
        return view('medicaltreatment::edit', compact('treatment'));
    }

    public function update(MedicalTreatmentRequest $request, $id)
    {
        $treatment = MedicalTreatment::findOrFail($id);
        $treatment->update($request->validated());
        return redirect()->route('medicaltreatment.index')
            ->with('success', 'Perawatan medis berhasil diperbarui');
    }

    public function destroy($id)
    {
        $treatment = MedicalTreatment::findOrFail($id);
        $treatment->delete();
        return redirect()->route('medicaltreatment.index')
            ->with('success', 'Perawatan medis berhasil dihapus');
    }
}