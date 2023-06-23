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
        <h3 class="box-title">Laporan Produk Keluar</h3>
    </div>

    <div class="box-header">
        <div class="row col-md-3">
            <form id="hari1">
                <div class="form-group">
                    <label>Filter Hari : </label>
                    <input type="date" class="form-control" id="hari2">
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-3">
            <form id="bulan3">
                <div class="form-group">
                    <label>Filter Bulan : </label>
                    <input type="date" class="form-control" id="bulan4">
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
            </form>
        </div>
    </div>



    <!-- /.box-header -->
    <div class="box-body" id="results">

    </div>
    <!-- /.box-body -->
</div>


@endsection

@section('bot')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

<!-- DataTables -->
<script src=" {{ asset('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
<script src="{{ asset('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>

<script>
    $(document).ready(function(){
        awal();
        
        $("#hari1").on('submit', function(e){
            e.preventDefault();
            hari();
        });

        $("#bulan3").on('submit', function(e){
            e.preventDefault();
            bulanKeluar();
        });

        function hari(){
            let id = $("#hari2").val();
            let url = '{!! URL::to('hari') !!}/' + id;
            $("#results").load(url);
        }

        function awal(){
            let id = 0;
            let url = '{!! URL::to('hari') !!}/' + id;
            $("#results").load(url);
        }

        function bulanKeluar(){
            var id = $("#bulan4").val();
            var url = '{!!URL::to('bulans')!!}/' + id;
            $("#results").load(url);
        }

    })
</script>

@endsection

