<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        // $banner = Banner::All();
        $banner = Banner::paginate(5);
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
        $validation = Validator::make($request->all(), [
            'judul' => 'required|max:100|min:10',
            'subjudul' => 'required|max:200|min:10',
            'foto' => 'required|mimes:jpg,png,jpeg,JPEG,JPG|image|max:2000',
            'posisi' => 'required|in:1,2,3,4',
            'status' => 'required|in:y,n',

        ],[
            'judul.required' => 'silahkan masukkan judul',
            'judul.max' => 'maksimal karakter 100',
            'judul.min' => 'minimal karakter 10',
            'subjudul.required' => 'silahkan masukkan subjudul',
            'subjudul.max' => 'maksimal karakter 200',
            'subjudul.min' => 'minimal karakter 10',
            'foto.required' => 'silahkan upload foto',
            'foto.mimes' => 'format foto tidak sesuai',
            'foto.image' => 'format foto tidak sesuai',
            'foto.max' => 'ukuran foto maximal 2MB',
            'posisi.required' => 'maaf posisi tidak valid', 
            'posisi.in' => 'maaf posisi tidak valid',
            'status.required' => 'maaf status tidak valid', 
            'status.in' => 'maaf status tidak valid', 
        ]);

        if ($validation->fails()){
            return response()->json($validation->errors(), 422);
        }
        else {
            $foto = $request->file('foto');
            $foto->storeAs('public/banner',$foto->hashName());

            Banner::create([
                'judul' => $request->judul,
                'subjudul' => $request->subjudul,
                'foto' => $foto->hashName(),
                'posisi' => $request->posisi,
                'status' => $request->status
            ]);
    
            return response()->json(data : [
                'message' => 'Selamat Anda Berhasil Mengupload Data'
            ], status: 201);
            
        }
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
        $$validation = Validator::make($request->all(), [
            'judul' => 'required|max:100|min:10',
            'subjudul' => 'required|max:200|min:10',
            'foto' => 'required|mimes:jpg,png,jpeg,JPEG,JPG|image|max:2000',
            'posisi' => 'required|in:1,2,3,4',
            'status' => 'required|in:y,n',

        ],[
            'judul.required' => 'silahkan masukkan judul',
            'judul.max' => 'maksimal karakter 100',
            'judul.min' => 'minimal karakter 10',
            'subjudul.required' => 'silahkan masukkan subjudul',
            'subjudul.max' => 'maksimal karakter 200',
            'subjudul.min' => 'minimal karakter 10',
            'foto.required' => 'silahkan upload foto',
            'foto.mimes' => 'format foto tidak sesuai',
            'foto.image' => 'format foto tidak sesuai',
            'foto.max' => 'ukuran foto maximal 2MB',
            'posisi.required' => 'maaf posisi tidak valid', 
            'posisi.in' => 'maaf posisi tidak valid',
            'status.required' => 'maaf status tidak valid', 
            'status.in' => 'maaf status tidak valid', 
        ]);

        if ($validation->fails()){
            return response()->json($validation->errors(), 422);
        }
        else {
            $foto = $request->file('foto');
            $foto->storeAs('public/banner',$foto->hashName());

            $banner->update([
                'judul' => $request->judul,
                'subjudul' => $request->subjudul,
                'foto' => $foto->hashName(),
                'posisi' => $request->posisi,
                'status' => $request->status,
            ]);
    
            return response()->json([
                'message' => 'Data Berhasil di Update'
            ], 202);
            
        }
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
