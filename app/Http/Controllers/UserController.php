<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::select(
            'id',
            'name',
            'phone',
            'email',
            'role')->get();
        return $user;
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
        User::create([
            'name' => 'Akbar Kuy',
            'phone' => '088282822828',
            'email' => 'akbarkuy@gmail.com',
            'password' => 'akbarkuy@gmail.com',
        ]);

        return response()->json(data : [
            'message' => 'Selamat Anda Berhasil Mendaftar'
        ], status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(User $user)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $user->update([
            'name' => 'Usman bin Skuy',
            'phone' => '088282829898',
            'email' => 'usmankuy@gmail.com',
            'password' => 'usmankuy@gmail.com',
        ]);

        return response()->json(data : [
            'message' => 'Data Berhasil di Update'
        ], status: 202);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();

        return response()->json(data: [
            'message' => 'Data Berhasil di Hapus'
        ], status: 202);
    }
}
