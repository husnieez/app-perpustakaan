<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // biasanya true supaya request bisa jalan
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama'         => 'required|string|max:100',
            'nim'          => 'required|digits_between:10,15',
            'email'        => 'required|email|max:100',
            'nomer_telpon' => 'required|digits_between:12,15',
            'alamat'       => 'required|string|max:300',
            'status'       => 'required|in:aktif,pasif',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required'         => 'Nama wajib diisi.',
            'nama.string'           => 'Nama harus berupa teks.',
            'nama.max'              => 'Nama maksimal 100 karakter.',

            'nim.required'          => 'NIM wajib diisi.',
            'nim.digits_between'    => 'NIM harus 10–15 digit angka.',

            'email.required'        => 'Email wajib diisi.',
            'email.email'           => 'Format email tidak valid.',
            'email.max'             => 'Email maksimal 100 karakter.',

            'nomer_telpon.required' => 'Nomor telepon wajib diisi.',
            'nomer_telpon.digits_between' => 'Nomor telepon harus 12–15 digit angka.',

            'alamat.required'       => 'Alamat wajib diisi.',
            'alamat.string'         => 'Alamat harus berupa teks.',
            'alamat.max'            => 'Alamat maksimal 300 karakter.',

            'status.required'       => 'Status wajib diisi.',
            'status.in'             => 'Status hanya boleh bernilai aktif atau pasif.',
        ];
    }
}
