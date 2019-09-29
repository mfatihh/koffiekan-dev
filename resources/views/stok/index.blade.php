@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/custom.css')}}">
<link rel="stylesheet" href="{{asset('css/style.default.css')}}">
<link rel="stylesheet" href="{{asset('vendor/owl.carousel/assets/owl.theme.default.css')}}">
<link rel="stylesheet" href="{{asset('vendor/owl.carousel/assets/owl.carousel.css')}}">
@endsection

@section('content')
<div class="wrapper ">
    <!-- BEGIN PAGE TITLE-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="card">
                            <div class="card-header card-header-primary">
                               
                                <form action="{{url('stok/supplier')}}" method="POST" style="float:left;">
                                    {{csrf_field()}}{{method_field('POST')}}
                                    <select name="supplier" class="form-control" style="width:100px;"
                                        onchange="this.form.submit()">
                                        <option value="">Supplier</option>
                                        @foreach ($supp as $item)
                                        <option {{ request('supplier') ==  $item->name ? 'selected="selected"' : '' }}>
                                            {{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </form>
                                <a href="{{url('stok/min')}}" class="btn btn-default" style="margin-left:20px;">Filter
                                    min Stok </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Jenis Barang</th>
                                                <th>Supplier</th>
                                                <th>Stok</th>
                                                <th>Minus stok</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($stok as $key => $item)
                                            <tr>
                                                <td>{{++$key}}</td>
                                                <td>{{$item->kode_produk}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->supplier}}</td>
                                                @if($item->sisa_stok <= $item->min_stok)
                                                    <td><span class="label label-danger">Sisa stok
                                                            {{$item->sisa_stok}}</span></td>
                                                    @else
                                                    <td><span class="label label-success">Sisa stok
                                                            {{$item->sisa_stok}}</span></td>
                                                    @endif
                                                    @if($item->min_stok - $item->sisa_stok > 0)
                                                    <td>{{$item->min_stok - $item->sisa_stok}}</td>
                                                    @else
                                                    <td>-</td>
                                                    @endif
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endsection