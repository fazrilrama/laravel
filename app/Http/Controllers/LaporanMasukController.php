<?php

namespace App\Http\Controllers;


use App\Exports\ExportProdukMasuk;
use App\Product;
use App\Product_Masuk;
use App\Supplier;
use PDF;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class LaporanMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,staff');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::orderBy('nama','ASC')
        //     ->get()
        //     ->pluck('nama','id');

        // $suppliers = Supplier::orderBy('nama','ASC')
        //     ->get()
        //     ->pluck('nama','id');

        // $supplier = Supplier::get();
        // $laporan = Product::InnerJoin('product_masuk', 'product_masuk.product_id', '=', 'products.id')->get();
        // dd($laporan);
        // dd($supplier);
        $invoice_data = Product_Masuk::all();
        // return view('laporan.laporanMasuk', compact('products','suppliers','invoice_data', 'supplier'));
        return view('laporan.laporanMasuk', compact('products','invoice_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function bulan($id)
    {
        $curr_date = date("m", strtotime($id));
        $data['bulan'] = Product_Masuk::whereMonth('tanggal', $curr_date)->get();
        // dd($data['bulan']);
        $data['id'] = $id;
        return view('laporan.tabelBulan', $data);
    }

    public function supplier($id)
    {
        if($id == 0){
            $data['bulan'] = Product_Masuk::get();
        } else {
            $data['bulan'] = Product_Masuk::where('supplier_id', $id)->get();
        }
        $data['id'] = $id;
        return view('laporan.tabel', $data);
    }

    public function exportProductMasukAll()
    {
        $product_masuk = Product_Masuk::all();
        $pdf = PDF::loadView('product_masuk.productMasukAllPDF',compact('product_masuk'));
        return $pdf->download('product_masuk.pdf');
    }

    public function exportProductMasuk($id)
    {
        $product_masuk = Product_Masuk::findOrFail($id);
        $pdf = PDF::loadView('product_masuk.productMasukPDF', compact('product_masuk'));
        return $pdf->download($product_masuk->id.'_product_masuk.pdf');
    }

    public function pdfSupplier($id)
    {
        if($id == 0){
            $product_masuk = Product_Masuk::get();
            $pdf = PDF::loadView('laporan.PdfProdukMasuk', compact('product_masuk'));
            return $pdf->download('Laporan_Produk_Masuk.pdf');
        } else {
            $product_masuk = Product_Masuk::findOrFail($id);
            $pdf = PDF::loadView('product_masuk.productMasukPDF', compact('product_masuk'));
            return $pdf->download($product_masuk->id.'_product_masuk.pdf');
        }
    }

    public function pdfBulan($id)
    {
        if($id == 0){
            $product_masuk = Product_masuk::get();
            $pdf = PDF::loadView('laporan.PdfProdukMasuk', compact('product_masuk'));
            return $pdf->download('laporan_Produk_Masuk.pdf');
        } else {
            $curr_date = date("m", strtotime($id));
            $product_masuk = Product_Masuk::whereMonth('tanggal', $curr_date)->get();
            // dd($product_masuk);
            $pdf = PDF::loadView('laporan.PdfProdukMasuk', compact('product_masuk'));
            return $pdf->download($curr_date.'_product_masuk.pdf');
        }
    }

    public function exportExcel()
    {
        return (new ExportProdukMasuk)->download('product_masuk.xlsx');
    }

    public function excelSupplier($id)
    {
       return (new ExportProdukMasuk($id));
    }
}
