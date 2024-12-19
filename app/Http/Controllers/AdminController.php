<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

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

}
