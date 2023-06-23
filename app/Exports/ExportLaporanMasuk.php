<?php

namespace App\Exports;

use App\Product_Masuk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ExportProdukMasuk implements FromView
{
    /**
     * melakukan format dokumen menggunakan html, maka package ini juga menyediakan fungsi lainnya agar dapat me-load data tersebut dari file html / blade di Laravel
     */
    use Exportable;

    public function view($id): View
    {
        // TODO: Implement view() method.
        if($id == 0){
            $result = Product_Masuk::all();
            return view('laporan.ExcelProdukMasukSupplier', compact('result'));
        } else {
            $result = Product_Masuk::where('supplier_id', $id)->get();
            return view('laporan.ExcelProdukMasukSupplier', compact('result'));
        }
    }
}
