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

        // dd('debug');

        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        } else {
            // return $request->fasilitas;


            $foto = $request->file('foto');
            $foto->storeAs('public/produk', $foto->hashName());

            $produk = Produk::create([
                // 'Kolom'      =>  isi
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

    public function showAll()
    {
        //
        $produk = Produk::with('fasilitas')->get();
        return $produk;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
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

            $foto = $request->file('foto');
            $foto->storeAs('public/produk', $foto->hashName());

            $produk->update([
                // 'Kolom'      =>  isi
                'judul_pendek'  => $request->judul_pendek,
                'slug'          => Str::slug($request->judul_pendek, '-'),
                'judul_panjang' => $request->judul_panjang,
                'subjudul'      => $request->subjudul,
                'deskripsi'     => $request->deskripsi,
                'foto'          => $foto->hashName(),
                'harga'         => $request->harga,
                'satuan'        => $request->satuan,
            ]);

            // cara memanggil variable ketik nama variable $produk->id(yang mau dipanggil)
            foreach ($request->fasilitas as $item) {
                $fasilitas = Fasilitas::where('produk_id', $produk->id)
                                        ->where('keterangan', $item)
                                        ->first();

                // Jika fasilitas ditemukan, lakukan update
                if ($fasilitas) {
                    $fasilitas->update([
                        'keterangan' => $item, // atau perubahan lain jika diperlukan
                    ]);
                } else {
                    // Jika fasilitas tidak ditemukan, lakukan create
                    Fasilitas::create([
                        'produk_id' => $produk->id,
                        'keterangan' => $item,
                    ]);
                }
            }
            return response()->json([
                'message' => 'Data Berhasil di Update'
            ], 202);
        }
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
