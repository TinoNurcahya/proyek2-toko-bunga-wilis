<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'nama' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'min:8', 'max:15'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'foto_profil' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];

        // Hanya tambahkan validasi email jika user bukan pengguna Google
        if (!$this->user()->google_id) {
            $rules['email'] = [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class, 'email')->ignore($this->user()->id_users, 'id_users'),
            ];
        }

        return $rules;
    }


    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'nama.string' => 'Nama lengkap harus berupa teks.',
            'nama.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Email sudah digunakan.',

            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.string' => 'Nomor HP harus berupa angka.',
            'no_hp.min' => 'Nomor HP minimal 8 digit.',
            'no_hp.max' => 'Nomor HP maksimal 15 digit.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',

            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'foto_profil.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'nama' => 'nama lengkap',
            'no_hp' => 'nomor HP',
            'jenis_kelamin' => 'jenis kelamin',
            'foto_profil' => 'foto profil',
        ];
    }
}
