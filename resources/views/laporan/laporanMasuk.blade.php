@extends('layouts.master')


@section('top')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">

<!-- daterange picker -->
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')


<div class="box col-md-6">

    <div class="box-header">
        <h3 class="box-title">Laporan Produk Masuk</h3>
    </div>

    <div class="box-header">
        <div class="row col-md-3">
            <form id="bulan1">
                <div class="form-group">
                    <label>Filter Bulan : </label>
                    <input type="date" class="form-control" id="bulan2">
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-3">
            <form action="" id="supplier1">
                <div class="form-group">
                    <label>Per Supplier : </label>
                    <select class="form-control" id="supplier2">
                        <option value="0">Pilih Supplier</option>
                        <?php foreach ($supplier as $row):?>
                            <option value="<?= $row->id?>"><?= $row->nama?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">submit</button>
            </form>
        </div> 
    </div>
    <!-- /.box-header -->
    <div class="box-body" id="result">
        
    </div>
    <!-- /.box-body -->
</div>

@include('product_masuk.form')

@endsection

@section('bot')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<!-- DataTables -->
<script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>


<script>
    $(document).ready(function(){
        supplier();
        $("#bulan1").on('submit', function (e){
            e.preventDefault();
            bulan();
        });
        $("#supplier1").on('submit', function(e){
            e.preventDefault();
            supplier();
        })

        function bulan(){
            var id = $("#bulan2").val();
            // console.log(id);
            var url = '{!!URL::to('bulan')!!}/' + id;
            // console.log(url);
            $("#result").load(url); 
        }

        function supplier(){
            var id = $("#supplier2").val();
            var url = '{!!URL::to('supplier')!!}/' + id;
            $("#result").load(url);
        }
    })
</script>

@endsection

