@extends('layouts.app')

@section('content')
<div class="wrapper " style="padding:0 30px 30px 30px;">
<!-- BEGIN PAGE TITLE-->
<h2 class="page-title"> Report Stok Ingredient
</h2>
<div class="row card" style="padding:10px;">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title col-md-6">
                <div class="tools"> </div>
                
                <button type="button" data-toggle="modal" data-target="#modTambah" class="btn btn-info btn-sm">
                        Stok Masuk</button><br><br>
                {{ Form::open(['method' => 'get', 'class' => 'form-inline well well-sm']) }}
                <select name="produk" class="form-control" style="width:150px;margin-right:20px;">
                    <option value="">Ingredient</option>
                    @foreach ($ingredient as $item)
                    <option value="{{$item->id}}"
                        {{ request('produk') ==  $item->id ? 'selected="selected"' : '' }}>{{$item->ingredient_nama}}</option>
                    @endforeach
                </select>
                {{ Form::select('month', $months, $month, ['class' => 'form-control', 'style'=>'max-width:100px;margin-right:20px;']) }}
                {{ Form::select('year', $years, $year, ['class' => 'form-control','style'=>'max-width:100px;margin-right:20px;']) }}
                {{ Form::submit('Lihat data', ['class' => 'btn btn-info btn-sm']) }}
                {{ Form::close() }}
            </div>
            
            <div class="portlet-body table-responsive">
                @if(request('produk') != null)
                <h3 align="center">
                    @foreach ($ingredient as $item)
                    @if(request('produk') == $item->id)
                    <b>{{$item->ingredient_nama}}</b>
                    @endif
                    @endforeach
                </h3>
                <h4>Total Stok Keluar bulan ini : <b>{{$stokSum->sum('keluar')}}</b></h4>
                <h4>Total Expenditure Stok Keluar bulan ini : <b>{{$stokSum->sum('harga')}}</b></h4>
                @endif
                @if ($errors->has('kskeluar'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('kskeluar') }}</strong>
                            </span>
                            @endif
                <table class="table table-striped table-bordered table-hover dataTable" id="sample_1" style="margin-top:20px;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Ingredient</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Expenditure</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stok as $key => $item)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$item->created_at->format('d-M-Y')}}</td>
                            <td>{{$item->ingredient_nama}}</td>
                            <td>{{$item->masuk}}</td>
                            <td>{{$item->keluar}}</td>
                            <td>{{$item->harga}}</td>
                        </tr>
                        @empty
                        <tr>
                                <td colspan=11>
                                    <center>Data Kosong</center>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modTambah" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('stok/kartu')}}">
                    {{csrf_field()}}{{method_field('POST')}}

                    <div class="form-group row">

                        <div class="col-md-8">
                            <select id="kode_produk" class="form-control" required name="kode_produk">
                                <option value="">Pilih Ingredient</option>
                                @foreach ($ingredient as $item)
                                <option value="{{$item->id}}">{{$item->ingredient_nama}}</option>
                                @endforeach

                            </select>

                            @if ($errors->has('kode_produk'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('kode_produk') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="masuk" class="col-md-4 col-form-label text-md-right">Jumlah Stok Masuk</label><br>

                        <div class="col-md-8">
                            <input id="masuk" type="number" class="form-control" name="masuk" min="0">

                            @if ($errors->has('masuk'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('masuk') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <button type="submit" id="tambah" class="btn btn-primary btn-sm">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modTambahKiloan" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Stok Kiloan Masuk</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{url('stok/kartu/kiloan')}}">
                    {{csrf_field()}}{{method_field('POST')}}

                    <div class="form-group row">
                        <label for="kname" class="col-md-4 col-form-label text-md-right">Nama</label>

                        <div class="col-md-8">
                            <input id="kname" type="text" class="form-control" name="name" required autofocus>

                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kkode_produk" class="col-md-4 col-form-label text-md-right">Nama Barang</label>

                        <div class="col-md-8">
                            <select id="kkode_produk" class="form-control" name="kode_produk">
                                @foreach ($stok as $item)
                                <option value="{{$item->kode_produk}}">{{$item->name}}</option>
                                @endforeach

                            </select>

                            @if ($errors->has('kode_produk'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('kode_produk') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kmasuk" class="col-md-4 col-form-label text-md-right">Jumlah Stok kiloan Masuk</label>

                        <div class="col-md-8">
                            <input id="kmasuk" type="number" class="form-control" name="masuk" min="0">

                            @if ($errors->has('masuk'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('masuk') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kketerangan" class="col-md-4 col-form-label text-md-right">Keterangan</label>

                        <div class="col-md-8">
                            <input id="kketerangan" type="text" class="form-control" name="keterangan">

                            @if ($errors->has('keterangan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('keterangan') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <button type="button" id="tambahKiloan" class="btn btn-primary" style="float:right;">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    document.getElementById("tambah").addEventListener("click", myFunction);

    function myFunction() {
        var name = document.getElementById("name").value;
        var kode_produk = document.getElementById("kode_produk").value;
        var masuk = document.getElementById("masuk").value;
        var keterangan = document.getElementById("keterangan").value;
        if (confirm("Nama : " + name + "\n" +
                "Kode produk : " + kode_produk + "\n" +
                "Jumlah masuk : " + masuk + "\n" +
                "Keterangan : " + keterangan + "\n" +
                "Apakah anda yakin ingin menambahkan data tersebut ?")) {
            return this.form.submit()
        } else {
            return false
        }
    }
</script>
@endsection