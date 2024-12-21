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
        $user = User::where('role', 'customer')->paginate(10);
        return $user;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        //
        $user = User::whereId($id)->first();
        if (!$user) {
            return response()->json([
                'message'   => 'Maaf Customer Tidak Valid',
            ], 422);
        } else {
            // return $user;
            if ($user->status == 'y') {

                $user->update([
                    'status'    => 'n',
                ]);
                
            }else{
                $user->update([
                    'status'    => 'y',
                ]);
            }

            return response()->json([
                'message'   => 'Status Customer Berhasil di ubah'
            ], 202);
        }
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
