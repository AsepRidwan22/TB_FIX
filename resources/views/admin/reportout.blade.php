@extends('adminlte::page')

@section('title', 'PT.ARAM INDONESIA')

@section('content_header')
    <h1> Laporan Barang Keluar</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justifly-content-center">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">{{ __('  ') }}</div> -->

                    <div class="card-body">
                    <a href="{{ route('admin.print_reportout') }}" target="_blank" class="btn btn-secondary float-right"><i class="fa fa-print"></i> Cetak PDF</a>
                    <hr/>
                        <table id="table-data" class="table table-borderer">
                        <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAME</th>
                                    <th>QTY</th>
                                    <th>TANGGAL KELUAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($reportouts as $reportout)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $reportout->id_product }}</td>
                                        <td>{{ $reportout->qty }}</td>
                                        <td>{{ $reportout->created_at}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>

    </script>
@stop