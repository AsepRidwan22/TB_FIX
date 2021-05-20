@extends('adminlte::page')

@section('title', 'PT.ARAM INDONESIA')

@section('content_header')
    <h1> Pengambilan Barang</h1>
@stop

@section('content')
    <div class="container">
        <div class="row justifly-content-center">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">{{ __('  ') }}</div> -->

                    <div class="card-body">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#tambahProductModal"><i class="fa fa-minus"></i> Product Keluar</button>
                        <hr/>
                        <table id="table-data" class="table table-borderer">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>QTY</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach($takes as $take)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $take->id_product }}</td>
                                        <td>{{ $take->qty }}</td>
                                        <td><div class="alert alert-success text-center" role="alert">Success</div></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambah Data --}}
    <div class="modal fade" id="tambahProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('take.submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="id_product">NAMA BARANG</label>
                            <select id="id_product" class="form-control" name="id_product">
                                @foreach($products as $product)
                                <option  class="form-control" name="id_product" value="{{ $product->name }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="qty">QTY</label>
                            <input type="number" class="form-control" name="qty" id="qty" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
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