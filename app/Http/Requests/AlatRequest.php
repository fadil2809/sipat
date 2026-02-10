<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AlatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        
        $alatId = $this->route('alat'); 

        return [
           // validasi pindah kesini
            'nama_alat' => [
                'required',
                'string',
                'max:255',
                Rule::unique('alats', 'nama_alat')->ignore($alatId),
            ],
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|integer|min:0',
            'gambar_alat' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
