<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class BarangRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'nama_barang'      => ['required', 'string'],
            'harga_barang'     => ['required', 'numeric', 'min:0'],
            'deskripsi_barang' => ['nullable', 'string'],
            'stok'             => ['required', 'integer', 'min:0'],
            'gambar_barang'    => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }

    public function attributes()
    {
        return [
            'nama_barang'      => 'Nama Barang',
            'harga_barang'     => 'Harga Barang',
            'deskripsi_barang' => 'Deskripsi Barang',
            'stok'             => 'Stok Barang',
            'gambar'           => 'Gambar Barang',
        ];
    }
}
