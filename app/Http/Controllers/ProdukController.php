<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use APP\Models\Fasilitas;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $produk = Produk::all();
        return $produk;
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $produk = Produk::create([
            'judul_pendek' => $request->judul_pendek,
            'slug' => $request->slug,
            'judul_panjang' => $request->judul_panjang,
            'subjudul' => $request->subjudul,
            'deskripsi' => $request->deskripsi,
            'foto' => $request->foto,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
            'fasilitas' => $request->fasilitas,
        ]);

        Fasilitas::create([
            'produk_id' => $produk->id,
            'kategori' => $produk->kategori,
        ]);

        return response()->json(data : [
            'message' => 'Selamat Anda Berhasil Mengupload Data'
        ], status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
        return $produk;
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Produk $produk)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        //
        $produk->update([
            'judul_pendek' => $request->judul_pendek,
            'slug' => $request->slug,
            'judul_panjang' => $request->judul_panjang,
            'subjudul' => $request->subjudul,
            'deskripsi' => $request->deskripsi,
            'foto' => $request->foto,
            'harga' => $request->harga,
            'satuan' => $request->satuan,
        ]);

        // Fasilitas::where('id',1)->update([
        //     'produk_id' => $produk->id,
        //     'kategori' => $produk->kategori,
        // ]);

        return response()->json(data : [
            'message' => 'Data Berhasil di Update'
        ], status: 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        //
        $produk->delete();

        return response()->json(data: [
            'message' => 'Data Berhasil di Hapus'
        ], status: 202);
    }
}
