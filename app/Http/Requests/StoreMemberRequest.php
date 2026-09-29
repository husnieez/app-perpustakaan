<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama'    => 'required|string|max:100',
            'nim'     => 'required|numeric|digits_between:8,15|unique:members,nim',
            'email'   => 'required|email|max:100|unique:members,email',
            'telepon' => 'required|numeric|digits_between:10,15', // UBAH 'nomor_telepon' MENJADI 'telepon'
            'status'  => 'required|in:aktif,nonaktif,Aktif,Nonaktif',
            'alamat'  => 'nullable|string|max:300',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'    => 'Nama wajib diisi.',
            'nim.required'     => 'NIM wajib diisi.',
            'email.required'   => 'Email wajib diisi.',
            'telepon.required' => 'Nomor telepon wajib diisi.',
            'telepon.digits_between' => 'Nomor telepon harus 10–15 digit angka.',
        ];
    }
}