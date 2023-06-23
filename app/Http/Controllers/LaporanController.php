<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class fileController extends Controller
{
    public function __construct()
    {
        $this->FileModel = new File();
    }

    public function LaporanProdukMasuk()
    {
        $data = [
            'judul' => 'Laporan Produk Masuk',
            'laporan' => Produk_Masuk::get(),
        ];

        return view('laporan.laporanMasuk', $data); 
    }

    public function LaporanProdukKeluar()
    {
        $data = [
            'judul' => 'Laporan Produk Keluar',
            'laporan' => Produk_Keluar::get(),
        ];
        
        return view('laporan.laporanKeluar', $data);
    }

}
