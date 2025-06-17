<?php

namespace Modules\Chatbot\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Chatbot\Models\MedicalList;

class MedicalListController extends Controller
{
    public function index()
    {
        $medicalLists = MedicalList::all();
        return view('chatbot::medical_lists.index', compact('medicalLists'));
    }

    public function create()
    {
        return view('chatbot::medical_lists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:medical_lists,name',
        ]);
        MedicalList::create($request->only('name'));
        return redirect()->route('medical-lists.index')->with('success', 'Medical berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $medical = MedicalList::findOrFail($id);
        return view('chatbot::medical_lists.edit', compact('medical'));
    }

    public function update(Request $request, $id)
    {
        $medical = MedicalList::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:medical_lists,name,' . $medical->id,
        ]);
        $medical->update($request->only('name'));
        return redirect()->route('medical-lists.index')->with('success', 'Medical berhasil diupdate!');
    }

    public function destroy($id)
    {
        $medical = MedicalList::findOrFail($id);
        $medical->delete();
        return redirect()->route('medical-lists.index')->with('success', 'Medical berhasil dihapus!');
    }
} 