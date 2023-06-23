<a href="/pdfProdukSupplier/{{ $id }}" class="btn btn-sm btn-warning"><i class="fa fa-file-pdf-o"></i> PDF</a>
{{-- <a href="/ExcelMasukSupplier/{{ $id }}" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i> Excel</a> --}}
<table id="invoice" class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Products</th>
            <th>Stok Produk</th>
            <th>QTY</th>
            <th>Tanggal</th>
        </tr>
    </thead>

    <?php $no=1;?>
    @foreach($bulan as $i)
    <tbody>
        <td>{{ $no++ }}</td>
        <td>{{ $i->nama }}</td>
        <td>{{ $i->qty }}</td>
        <td>{{ $i->tanggal }}</td>
    </tbody>
    @endforeach
</table>

