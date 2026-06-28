<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreDisposisiRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Pastikan hanya user yang login yang bisa melakukan ini
        return Auth::check();
    }

    public function rules(): array
{
    return [
        'kode_surat'    => 'required',
        'nomor_surat'   => 'required',
        'judul_surat'   => 'required',
        'tanggal_surat' => 'required|date', // Pastikan nama ini ada
        'asal_surat'    => 'required|string', // Pastikan nama ini ada
    ];
}
}