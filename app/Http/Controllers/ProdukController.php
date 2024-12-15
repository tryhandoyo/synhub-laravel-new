<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
        $validation = Validator::make($request->all(), [
            'judul_pendek' => 'required',
            'judul_panjang' => 'required',
            'subjudul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|mimes:jpg,png,jpeg,JPEG,JPG|image|max:2000',
            'harga' => 'required',
            'satuan' => 'required',
            'fasilitas' => 'required',
        ], [
            'judul_pendek.required' => 'silahkan masukkan judul pendek',
            'judul_panjang.required' => 'silahkan masukkan judul panjang',
            'subjudul.required' => 'silahkan masukkan subjudul',
            'deskripsi.required' => 'silahkan masukkan deskripsi',
            'foto.required' => 'silahkan masukkan foto',
            'foto.mimes' => 'format foto tidak sesuai',
            'foto.image' => 'format foto tidak sesuai',
            'foto.max' => 'ukuran foto maximal 2MB',
            'harga.required' => 'silahkan masukkan harga',
            'satuan.required' => 'silahkan masukkan satuan',
            'fasilitas.required' => 'silahkan masukkan fasilitas',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        } else {
            // return $request->fasilitas;

            $foto = $request->file('foto');
            $foto->storeAs('public/produk', $foto->hashName());

            $produk = Produk::create([
                'judul_pendek'  => $request->judul_pendek,
                'slug'          => Str::slug($request->judul_pendek, '-'),
                'judul_panjang' => $request->judul_panjang,
                'subjudul'      => $request->subjudul,
                'deskripsi'     => $request->deskripsi,
                'foto'          => $foto->hashName(),
                'harga'         => $request->harga,
                'satuan'        => $request->satuan,
            ]);
            // return $produk->id;

            // cara memanggil variable ketik nama variable $produk->id(yang mau dipanggil)
            foreach ($request->fasilitas as $item) {
                Fasilitas::create([
                    'produk_id' => $produk->id,
                    'keterangan' => $item,
                ]);
            }



            return response()->json(data: [
                'message' => 'Selamat Anda Berhasil Mengupload Data'
            ], status: 201);
        }
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

        return response()->json(data: [
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
