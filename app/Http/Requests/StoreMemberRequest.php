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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|min:3',
            "nim" => 'required|integer',
            'email' => 'required|email',
            'nomor_telepon' => 'required|integer|min:12',
            'alamat' => 'required',
            'status' => 'required'
        ];
    }

    public function massage():array {
        return[
            'nama.required' => "Nama Anda harus di isi",
            'nama.min' => "Nama harus minimal 3 karakter",
            'nim.required' => "NIM Anda harus di isi",
            'email.required' => "Email Anda harus di isi",
            'nomor_telepon.required' => "No Telepon Anda harus di isi",
            'alamat.required' => "alamat Anda harus di isi",
            'status.required' => "status Anda harus di isi",
        ];
    }
}
