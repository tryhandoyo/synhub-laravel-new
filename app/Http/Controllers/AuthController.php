<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'      => 'required',
            //rules unique digunakan untuk membuat aturan agar tidak terjadi kesamaan atau disebut unik,
            // unique:users = unique:nama_table,nama_kolom => jika nama kolom kebetulan sama tidak perlu di tulis lagi  
            'email'     => 'required|unique:users,email',
            'phone'     => 'required|unique:users',
            'password'  => 'required|min:8|confirmed',
            //password confiramtion
        ], [
            'name.required'         => 'Silahkan Masukkan Nama Lengkap Anda',
            'email.required'        => 'Silahkan Masukkan Email Anda',
            'email.unique'          => 'Maaf, email telat terdaftar',
            'phone.required'        => 'Silahkan Masukkan Nomor Telepon Anda',
            'phone.unique'          => 'Maaf, Nomor Telepon telat terdaftar',
            'password.required'     => 'Silahkan Masukkan Password Anda',
            'password.min'          => 'Input Karakter Minimal 8 ',
            'password.confirmed' => 'Silahkan Masukkan Password Confirmation',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        } else {
            $password = Hash::make($request->password);
            User::create([
                'name'  => $request->name,
                'email'  => $request->email,
                'phone'  => $request->phone,
                'password'  => $password,
                'role'  => 'customer',
                'status'  => 'y',
            ]);

            return response()->json([
                'message'   => 'Selamat, Anda Berhasil Mendaftar',
            ], 201);
        }
    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required|min:8',
        ], [
            'email.required'        => 'Silahkan Masukkan Email Anda',
            'password.required'     => 'Silahkan Masukkan Password Anda',
            'password.min'          => 'Input Karakter Minimal 8 ',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->erros(), 422);
        } else {
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json([
                    'message'   => 'Maaf Email anda belum terdaftar',
                ], 422);
            } else {
                $credential = Hash::check($request->password, $user->password);

                if (!$credential) {
                    return response()->json([
                        'message'   => 'Password anda salah',
                    ], 401);
                } else {
                    $user->token = $user->createToken('authToken')->plainTextToken;
                    return $user;
                }
            }
        }
    }
}
