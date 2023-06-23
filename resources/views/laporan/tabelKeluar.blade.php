<a href="/pdfKeluar{{ $waktu }}/{{ $id }}" class="btn btn-sm btn-warning"><i class="fa fa-file-pdf-o"></i> PDF</a>
{{-- <a href="{{ $id }}" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i> Excel</a> --}}
<table id="invoice" class="table table-striped">
    <thead>
       <tr>
           <th>ID</th>
           <th>Products</th>
           <th>Barang Keluar</th>
           <th>Sisa Stok</th>
           <th>Harga Satuan</th>
           <th>Total</th>
           <th>Tanggal</th>
       </tr>
    </thead>
    <?php $no=1;?>
    @foreach($bulan as $i)
    <?php $total = $i->qty * $i->harga; ?>
        <tbody>
            <td>{{ $no++ }}</td>
            <td>{{ $i->product->nama }}</td>
            <td>{{ $i->qty }}</td>
            <td>{{ $i->qty_p }}</td>
            <td>{{ number_format($i->harga,0,',','.') }}</td>
            <td id="total">{{ number_format($total,0,',','.') }}</td>
            <td>{{ $i->tanggal }}</td>
        </tbody>
    @endforeach
</table>
<h4 id="hasil"></h4>

