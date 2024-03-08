<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class KeranjangRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'barang_id'        => ['required', 'integer'],
            'jumlah'           => ['required', 'numeric', 'min:0'],
        ];
    }

    public function attributes()
    {
        return [
            'barang_id' => 'ID Barang',
            'jumlah'    => 'Jumlah Barang',
        ];
    }
}
