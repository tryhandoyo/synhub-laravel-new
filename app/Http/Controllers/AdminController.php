<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $pesanan = Pesanan::paginate(10);
        return $pesanan;
    }

    public function show(Pesanan $pesanan)
    {
        //
        return $pesanan;
    }

    public function update(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'kode_pesanan'  => 'required',
            'foto'          => 'required|image|mimes:jpg,png,jpeg,JPEG,JPG|image|max:2000',
            'status'        => 'required|in:3',
        ],[
            'kode_pesanan.required' => 'kode pesanan tidak ada',
            'foto.required'         => 'silahkan masukkan foto',
            'foto.mimes'            => 'format foto tidak sesuai',
            'foto.image'            => 'format foto tidak sesuai',
            'foto.max'              => 'ukuran foto maximal 2MB',
            'status.required'       => 'status tidak valid',
            'status.in'             => 'statuts tidak valid',
        ]);

        if($validation->fails()){
            return response()->json($validation->errors(), 422);
        }

        else {
            $pesanan = Pesanan::where('kode_pesanan', $request->kode_pesanan)->first();

            if(!$pesanan){
                return response()->json($validation->errors(), 422);
            }
            else {
                $pesanan->update([
                    'status'    => $request->status,
                ]);

                return response()->json([
                    'message'   => 'Pembayaran Sudah di Konfirmasi, Silahkan Cek Kode Pesanan Anda'
                ], 202);
            }
            
        }
    }

}
