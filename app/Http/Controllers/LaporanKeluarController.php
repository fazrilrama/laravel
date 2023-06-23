<?php

namespace App\Http\Controllers;


use App\Exports\ExportProdukMasuk;
use App\Product;
use App\Customer;
use App\Product_Keluar;
use App\Supplier;
use PDF;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class LaporanKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin,staff');
    }

    public function index()
    {
        $products = Product::orderBy('nama','ASC')
            ->get()
            ->pluck('nama','id');
        $customer = Customer::get();

        $invoice_data = Product_Keluar::all();
        return view('laporan.laporanKeluar', compact('products','customer', 'invoice_data'));
    }

    public function hari($id)
    {
        if($id == 0){
            $result = Product_Keluar::join('products', 'products.id', '=', 'product_id')->get();
        } else {
            $result = Product_Keluar::join('products', 'products.id', '=', 'product_id')->where('tanggal', $id)->get();
        }
        $data = [
            'bulan' => $result,
            'id' => $id,
            'waktu' => 'hari'
        ];
        // dd($data['bulan']);
        return view('laporan.tabelKeluar', $data);
    }

    public function bulan($id)
    {
        if($id == null){
            $result = Product_Keluar::join('products', 'products.id', '=', 'product_id')->get();
        } else {
            $curr_date = date("m", strtotime($id));
            $result = Product_Keluar::join('products', 'products.id', '=', 'product_id')->whereMonth('tanggal', $curr_date)->get();
            $getTotal = Product_Keluar::select('harga', 'qty')->join('products', 'products.id', '=', 'product_id')->whereMonth('tanggal', $curr_date)->get();
            
            // $hasil = [];

            
            // foreach($getTotal as $row){
            //     $harga = $row->harga;
            //     $qty = $row->qty;
            //     $hasil = $harga*$qty;
            //     // $haha = sum($hasil);
            // }
            // dd($hasil);
            // $duit =  $getTotal['harga']*$getTotal['qty'];
            // $hasil = $duit;
            // $hasil = $result->qty * $result->harga;
            $total = $result->sum('harga');
        }
        $data = [
            'bulan' => $result,
            'id' => $id,
            'waktu' => 'bulan'
        ];
        // dd($hasil);
        return view('laporan.tabelKeluar', $data);
    }

    public function costumer($id)
    {
        if($id == 0){
            $data['bulan'] = Product_Keluar::join('products', 'products.id', '=', 'product_id')->get();
            // $data['bulan'] = Product_Keluar::join('products', 'products.id', '=', 'product_id')->join('product_masuk', 'product_masuk.product_id', '=', 'products.id')->get();
        } else {
            $data['bulan'] = Product_Keluar::where('customer_id', $id)->get();
        }
        $data['id'] = $id;
        // return $data;
        dd($data['bulan']);
        // return view('laporan.tabelKeluar', $data);
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
    
    public function pdfCustomer($id)
    {
        if($id == 0){
            $product_keluar = Product_Keluar::all();
            $pdf = PDF::loadView('laporan.PdfProdukKeluar', compact('product_keluar'));
            return $pdf->download('produk_keluar.pdf');
        } else {
            $product_keluar = Product_Keluar::where('customer_id', $id)->get();
            $pdf = PDF::loadView('laporan.PdfProdukKeluar', compact('product_keluar'));
            return $pdf->download($id.'_product_keluar.pdf');
        }
    }

    public function pdfHari($id)
    {
        if($id == 0){
            $product_keluar = Product_Keluar::join('products', 'products.id', '=', 'product_id')->get();
            $pdf = PDF::loadView('laporan.pdfProdukKeluar', compact('product_keluar'));
            // return view('laporan.pdfProdukKeluar', compact('product_keluar'));
            return $pdf->download('LaporanProdukKeluar.pdf');
        } else {
            $product_keluar = Product_Keluar::join('products', 'products.id', '=', 'product_id')->where('tanggal', $id)->get();
            $pdf = PDF::loadView('laporan.pdfProdukKeluar', compact('product_keluar'));
            // return view('laporan.pdfProdukKeluar', compact('product_keluar'));
            return $pdf->download($id.'_ProductKeluar.pdf');
        }
    }
    
    public function pdfBulan($id)
    {
        if($id == 0){
            $product_keluar = Product_Keluar::join('products', 'products.id', '=', 'product_id')->get();
            $pdf = PDF::loadView('laporan.pdfProdukKeluar', compact('product_keluar'));
            // return view('laporan.pdfProdukKeluar', compact('product_keluar'));
            return $pdf->download('LaporanProdukKeluar.pdf');
        } else {
            $curr_date = date("m", strtotime($id));
            $product_keluar = Product_Keluar::join('products', 'products.id', '=', 'product_id')->whereMonth('tanggal', $curr_date)->get();
            $pdf =  PDF::loadView('laporan.PdfProdukKeluar', compact('product_keluar'));
            // return view('laporan.pdfProdukKeluar', compact('product_keluar'));
            return $pdf->download($curr_date.'_produk_keluar.pdf');
        }
    }
    public function exportExcel()
    {
        return (new ExportProdukMasuk)->download('product_masuk.xlsx');
    }
}
