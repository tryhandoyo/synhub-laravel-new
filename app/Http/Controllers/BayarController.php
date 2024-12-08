<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $bayar = Bayar::all();
        return $bayar;
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
        Bayar::create([
            'nama_orang' => $request->nama_orang,
            'nama_pembayaran' => $request->nama_pembayaran,
            'nomor_rekening' => $request->nomor_rekening,
            'logo' => $request->logo,
            'status' => $request->status,
        ]);

        return response()->json(data : [
            'message' => 'Selamat Anda Berhasil Mengupload Data'
        ], status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Bayar $bayar)
    {
        //
        return $bayar;
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Bayar $bayar)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bayar $bayar)
    {
        //
        $bayar->update([
            'nama_orang' => $request->nama_orang,
            'nama_pembayaran' => $request->nama_pembayaran,
            'nomor_rekening' => $request->nomor_rekening,
            'logo' => $request->logo,
            'status' => $request->status,
        ]);

        return response()->json(data : [
            'message' => 'Data Berhasil di Update'
        ], status: 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bayar $bayar)
    {
        //
        $bayar->delete();

        return response()->json(data: [
            'message' => 'Data Berhasil di Hapus'
        ], status: 202);
    }
}
