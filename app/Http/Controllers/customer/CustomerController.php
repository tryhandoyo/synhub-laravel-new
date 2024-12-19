<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Bayar;
use App\Models\Produk;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexBanner()
    {
        //get data banner
        $banner = Banner::select(
            'judul',
            'subjudul',
            'foto',
            'posisi'
        )->get();
        return $banner;
    }

    public function indexProduk()
    {
        //get data produk
        $produk = Produk::with('fasilitas')->get();
        return $produk;
    }
    public function indexProdukShow(Produk $produk)
    {
        // //get data produk
        // $produk = Produk::with('fasilitas')->find(id);
        return $produk;
    }

    public function indexBayar()
    {
        $bayar = Bayar::all();
        return $bayar;
    }
}
