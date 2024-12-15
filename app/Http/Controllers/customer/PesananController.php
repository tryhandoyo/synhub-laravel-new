<?php

namespace App\Http\Controllers\customer;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $produk = Produk::whereId($request->produk)->first();
        $rules = [];
        $messages = [];

        // return $produk->slug;
        switch($produk->slug){
            case 'ruang-meeting':
                $rules['perusahaan'] = 'required';
                $rules['jumlah_orang'] = 'required|integer|min:30|max:200';
                $rules['tanggal_1'] = 'required';
                $rules['jam_1'] = 'required';
                $rules['jam_2'] = 'required';
                $rules['keterangan'] = 'required';
                $rules['bayar'] = 'required';
                $messages['perusahaan.required'] = 'Silahkan Masukkan Nama Perusahaan!';
                $messages['jumlah_orang.required'] = 'Silahkan Masukkan Jumlah Orang!';
                $messages['jumlah_orang.integer'] = 'Silahkan Masukkan Jumlah Orang!';
                $messages['jumlah_orang.min'] = 'Silahkan Masukkan Jumlah Orang!';
                $messages['jumlah_orang.max'] = 'Silahkan Masukkan Jumlah Orang!';
                $messages['tanggal_1.required'] = 'Silahkan Pilih Tanggal!';
                $messages['jam_1.required'] = 'Silahkan Pilih Jam Masuk!';
                $messages['jam_2.required'] = 'Silahkan Pilih Jam Keluar!';
                $messages['keterangan.required'] = 'Silahkan Masukkan Deskripsi!';
                $messages['bayar.required'] = 'Silahkan Pilih Opsi Pembayaran!';
                
                $durasi = $request->jam_2 - $request->jam_1;
                break;

            case 'ruang-acara':
                $rules['perusahaan'] = 'required';
                $rules['jumlah_orang'] = 'required|integer|min:30|max:200';
                $rules['tanggal_1'] = 'required';
                $rules['tanggal_2'] = 'required';
                $rules['keterangan'] = 'required';
                $rules['bayar'] = 'required';
                $messages['perusahaan.required'] = 'Silahkan Masukkan Nama Perusahaan!';
                $messages['jumlah_orang.required'] = 'Silahkan Masukkan Jumlah Orang!';
                $messages['jumlah_orang.integer'] = 'Silahkan Masukkan Jumlah Orang!';
                $messages['jumlah_orang.min'] = 'Silahkan Masukkan Jumlah Orang!';
                $messages['jumlah_orang.max'] = 'Silahkan Masukkan Jumlah Orang!';
                $messages['tanggal_1.required'] = 'Silahkan Pilih Tanggal Mulai!';
                $messages['tanggal_2.required'] = 'Silahkan Pilih Tanggal Selesai!';
                $messages['keterangan.required'] = 'Silahkan Masukkan Deskripsi!';
                $messages['bayar.required'] = 'Silahkan Pilih Opsi Pembayaran!';

                $durasi = Carbon::parse($request->tanggal_2)->diffInDays(Carbon::parse($request->tanggal_1));
                break;

            case 'ruang-coworking':
                $rules['tanggal_1'] = 'required';
                $rules['jam_1'] = 'required';
                $rules['jam_2'] = 'required';
                $rules['keterangan'] = 'required';
                $rules['bayar'] = 'required';
                $messages['tanggal_1.required'] = 'Silahkan Pilih Tanggal!';
                $messages['jam_1.required'] = 'Silahkan Pilih Jam Mulai!';
                $messages['jam_2.required'] = 'Silahkan Pilih Jam Selesai!';
                $messages['keterangan.required'] = 'Silahkan Masukkan Deskripsi!';
                $messages['bayar.required'] = 'Silahkan Pilih Opsi Pembayaran!';

                $durasi = $request->jam_2 - $request->jam_1;
                break;
        }

            
        $validation = Validator::make($request->all(), $rules, $messages);

        if($validation->fails()){
            return response()->json($validation->errors(), 422);
        }

        
        else {
            $kode_pesanan = 'SYB-' . time() . '-' . FileHelper::generateRandomString();
            $total = $durasi * $produk->harga;

            Pesanan::create([
                'kode_pesanan'  => $kode_pesanan,
                'user_id'   => 1,
                'produk_id' => $request->produk,
                'perusahaan' => $request->perusahaan,
                'jumlah_orang' => $request->jumlah_orang,
                'tanggal_1' => Carbon::parse($request->tanggal_1),
                'tanggal_2' => Carbon::parse($request->tanggal_2),
                'jam_1' => $request->jam_1,
                'jam_2' => $request->jam_2,
                'keterangan' => $request->keterangan,
                'status' => 1,
                'durasi' => $durasi,
                'total' => $total,
                'bayar_id' => 1,
            ]);

            return response()->json([
                'message' => 'Pesanan Berhasil, Silahkan Lakukan Pembayaran'
            ], 201);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pesanan $pesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan)
    {
        //
    }
}
