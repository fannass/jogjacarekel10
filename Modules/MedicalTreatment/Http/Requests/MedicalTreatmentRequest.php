<?php

namespace Modules\MedicalTreatment\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicalTreatmentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|in:Traditional medicine,Traditional Alternative',
            'intro' => 'nullable|string',
            'cost' => 'required|numeric|min:0',
            'status' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama perawatan wajib diisi',
            'name.max' => 'Nama perawatan maksimal 255 karakter',
            'type.required' => 'Jenis perawatan wajib diisi',
            'type.in' => 'Jenis perawatan harus berupa Traditional medicine atau Traditional Alternative',
            'cost.required' => 'Biaya perawatan wajib diisi',
            'cost.numeric' => 'Biaya perawatan harus berupa angka',
            'cost.min' => 'Biaya perawatan minimal 0'
        ];
    }
}