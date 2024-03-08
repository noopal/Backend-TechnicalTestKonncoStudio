<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Http\Request\BarangRequest;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return response()->json(['data' => $barangs], 200);
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return response()->json(['data' => $barang], 200);
    }

    public function store(BarangRequest $request)
    {
        $gambarPath = $request->file('gambar_barang')->store('gambar_barang', 'public');

        $barang = Barang::create([
            'nama_barang'      => $request->nama_barang,
            'harga_barang'     => $request->harga_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
            'stok'             => $request->stok,
            'gambar_barang'    => $gambarPath,
        ]);

        return response()->json(['message' => 'Barang berhasil ditambahkan', 'data' => $barang], 201);
    }

    public function update(BarangRequest $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $gambarPath = $barang->gambar_barang;

        if ($request->hasFile('gambar_barang')) {
            Storage::disk('public')->delete($barang->gambar_barang);
            $gambarPath = $request->file('gambar_barang')->store('gambar_barang', 'public');
        }

        $barang->update([
            'nama_barang'      => $request->nama_barang,
            'harga_barang'     => $request->harga_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
            'stok'             => $request->stok,
            'gambar_barang'    => $gambarPath,
        ]);

        return response()->json(['message' => 'Detail barang berhasil diperbarui', 'data' => $barang], 200);
    }

    public function delete($id)
    {
        $barang = Barang::findOrFail($id);
        Storage::disk('public')->delete($barang->gambar_barang);
        $barang->delete();

        return response()->json(['message' => 'Barang berhasil dihapus'], 200);
    }
}
