<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $banner = Banner::select(
        //     'id',
        //     'judul',
        //     'subjudul',
        //     'foto',
        //     'posisi',
        //     'status')->get();
        $banner = Banner::all();
        return $banner;
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
        // return $request->garpu;
        //
        Banner::create([
            'judul' => $request->judul,
            'subjudul' => $request->subjudul,
            'foto' => $request->foto,
            'posisi' => $request->posisi,
            'status' => $request->status
        ]);

        // Fasilitas::create([
        //     'produk_id' => $produk->id,
        //     'kategori' => $produk->kategori,
        // ]);

        return response()->json(data : [
            'message' => 'Selamat Anda Berhasil Mengupload Data'
        ], status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
        return $banner;
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Banner $banner)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        //
        $banner->update([
            'judul' => $request->judul,
            'subjudul' => $request->subjudul,
            'foto' => $request->foto,
            'posisi' => $request->posisi,
            'status' => $request->status
        ]);

        return response()->json(data : [
            'message' => 'Data Berhasil di Update'
        ], status: 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        //
        $banner->delete();

        return response()->json(data: [
            'message' => 'Data Berhasil di Hapus'
        ], status: 202);
    }
}
