<?php

namespace App\Http\Controllers;

use App\Http\Request\KeranjangRequest;
use App\Models\Kerangjang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjangs = Kerangjang::with('barang')->get();
        return response()->json(['data' => $keranjangs], 200);
    }

    public function show($id)
    {
        $keranjang = Kerangjang::with('barang')->findOrFail($id);
        return response()->json(['data' => $keranjang], 200);
    }

    public function store(KeranjangRequest $request)
    {
        $keranjang = Kerangjang::create([
            'barang_id' => $request->barang_id,
            'jumlah'    => $request->jumlah,
        ]);

        return response()->json(['message' => 'Barang berhasil ditambahkan ke keranjang', 'data' => $keranjang], 201);
    }

    public function update(KeranjangRequest $request, $id)
    {
        $keranjang = Kerangjang::findOrFail($id);

        $data = [
            'barang_id' => $request->barang_id,
            'jumlah'    => $request->jumlah,
        ];

        $keranjang->update($data);

        return response()->json(['message' => 'Jumlah barang dalam keranjang berhasik diperbarui', 'data' => $keranjang], 200);
    }

    public function delete($id)
    {
        $keranjang = Kerangjang::findOrFail($id);
        $keranjang->delete();

        return response()->json(['message' => 'Barang berhasil dihapus dari keranjang'], 200);
    }
}
