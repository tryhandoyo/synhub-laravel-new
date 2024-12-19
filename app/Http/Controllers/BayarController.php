<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BayarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $bayar = Bayar::all();
        $bayar = Bayar::paginate(5);
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
        $validation = Validator::make($request->all(),[
            'nama_orang'        => 'required',
            'nama_pembayaran'   => 'required',
            'nomor_rekening'    => 'required',
            'logo'              => 'required|image|mimes:jpg,png,jpeg,JPEG,JPG|max:2000',
            'status'            => 'required|in:y,n',

        ],[
            'nama_orang.required'       => 'Silahkan Masukkan Nama Pemilik Rekening',
            'nama_pembayaran.required'  => 'Silahkan Masukkan Nama Pembayaran',
            'nomor_rekening.required'   => 'Silahkan Masukkan Nomor Rekening',
            'logo.required'             => 'Silahkan Upload Logo',
            'logo.mimes'                => 'Format Logo Tidak Sesuai',
            'logo.image'                => 'Format Logo Tidak Sesuai',
            'logo.max'                  => 'Ukuran Logo Maximal 2MB',
            'status.required'           => 'maaf status tidak valid', 
            'status.in'                 => 'maaf status tidak valid', 
        ]);

        if ($validation->fails()){
            return response()->json($validation->errors(), 422);
        }
        else {
            $foto = $request->file('logo');
            $foto->storeAs('public/bayar', $foto->hashName());

            Bayar::create([
                'nama_orang' => $request->nama_orang,
                'nama_pembayaran' => $request->nama_pembayaran,
                'nomor_rekening' => $request->nomor_rekening,
                'logo' => $foto->hashName(),
                'status' => $request->status,
            ]);
    
            return response()->json(data : [
                'message' => 'Selamat Anda Berhasil Mengupload Data'
            ], status: 201);
        }
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
        $validation = Validator::make($request->all(),[
            'nama_orang'        => 'required',
            'nama_pembayaran'   => 'required',
            'nomor_rekening'    => 'required|integer',
            'logo'              => 'required|image|mimes:jpg,png,jpeg,JPEG,JPG|max:2000',
            'status'            => 'required|in:y,n',

        ],[
            'nama_orang.required'       => 'Silahkan Masukkan Nama Pemilik Rekening',
            'nama_pembayaran.required'  => 'Silahkan Masukkan Nama Pembayaran',
            'nomor_rekening.required'   => 'Silahkan Masukkan Nomor Rekening',
            'nomor_rekening.integer'    => 'Nomor Rekening Berupa Angka',
            'logo.required'             => 'Silahkan Upload Logo',
            'logo.mimes'                => 'Format Logo Tidak Sesuai',
            'logo.image'                => 'Format Logo Tidak Sesuai',
            'logo.max'                  => 'Ukuran Logo Maximal 2MB',
            'status.required'           => 'maaf status tidak valid', 
            'status.in'                 => 'maaf status tidak valid', 
        ]);

        if ($validation->fails()){
            return response()->json($validation->errors(), 422);
        }
        else {
            $foto = $request->file('logo');
            $foto->storeAs('public/bayar', $foto->hashName());

            $bayar->update([
                'nama_orang' => $request->nama_orang,
                'nama_pembayaran' => $request->nama_pembayaran,
                'nomor_rekening' => $request->nomor_rekening,
                'logo' => $foto->hashName(),
                'status' => $request->status,
            ]);
    
            return response()->json([
                'message' => 'Data Berhasil Update'
            ], 202);
        }
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
