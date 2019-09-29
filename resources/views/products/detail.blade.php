@extends('layouts.app')

@section('content')

<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> Detail Data Barang
    <small></small>
</h1>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <a href="{{route('products.index')}}" class="btn btn-info">Kembali</a>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                    <tbody>
                        <tr>
                            <td>Jenis Produk</td>
                            <td>{{$barang->name}}</td>
                        </tr>
                        <tr>
                            <td>Kode Produk</td>
                            <td>{{$barang->kode_produk}}</td>
                        </tr>
                        <tr>
                            <td>Supplier</td>
                            <td>{{$barang->supplier}}</td>
                        </tr>
                        <tr>
                            <td>Min Stok</td>
                            <td>{{$barang->min_stok}}</td>
                        </tr>
                        <tr>
                            <td>Sisa Stok</td>
                            <td>{{$barang->sisa_stok}}</td>
                        </tr>
                        <tr>
                            <td>Sisa Stok Kiloan</td>
                            <td>{{$barang->sisa_stok_kiloan}}</td>
                        </tr>
                        <tr>
                            <td>Harga Kiloan</td>
                            <td>Rp {{$barang->harga_kiloan}}</td>
                        </tr>
                        <tr>
                            <td>Harga Satuan</td>
                            <td>Rp {{$barang->harga_satuan}}</td>
                        </tr>
                        <tr>
                            <td>Wadah</td>
                            <td>Rp {{$barang->wadah}}</td>
                        </tr>
                        <tr>
                            <td>Stiker</td>
                            <td>Rp {{$barang->stiker}}</td>
                        </tr>
                        <tr>
                            <td>Ongkir</td>
                            <td>Rp {{$barang->ongkir}}</td>
                        </tr>
                        <tr>
                            <td>Amplop</td>
                            <td>Rp {{$barang->amplop}}</td>
                        </tr>
                        <tr>
                            <td>Box</td>
                            <td>Rp {{$barang->box}}</td>
                        </tr>
                        <tr>
                            <td>Brosur</td>
                            <td>Rp {{$barang->brosur}}</td>
                        </tr>
                        <tr>
                            <td>Isolatip Wrap</td>
                            <td>Rp {{$barang->isolatip_wrap}}</td>
                        </tr>
                        <tr>
                            <td>Safety Factor</td>
                            <td>Rp {{$barang->safety_factor}}</td>
                        </tr>
                        <tr>
                            <td>Harga Modal</td>
                            <td>Rp {{$barang->harga_modal}}</td>
                        </tr>
                        <tr>
                            <td>Harga Jual Retail</td>
                            <td>Rp {{$barang->cash_price}}</td>
                        </tr>
                        <tr>
                            <td>Harga Jual Reseller</td>
                            <td>Rp {{$barang->credit_price}}</td>
                        </tr>
                        <tr>
                            <td>Profit</td>
                            <td>Rp {{$barang->profit}}</td>
                        </tr>
                        <tr>
                            <td>Margin</td>
                            <td>{{$barang->margin}} %</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
