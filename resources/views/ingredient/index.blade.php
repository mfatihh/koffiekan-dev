@extends('layouts.app')

@section('css')
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">   
@endsection

@section('content')
<div class="wrapper ">
    
<!-- BEGIN PAGE TITLE-->
<div class="content">
        <div class="container-fluid">
<div class="row">
    <div class="col-md-12">
            
                    <!--@if(session()->has('message'))-->
                        <div class="alert success">
                            <strong>Success!</strong> {{ session()->get('message') }}
                        </div>
                        <!--@endif-->
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="card">
            
                <div class="card-header card-header-primary">
                    <div class="caption font-dark">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modTambah"><i class="fa fa-plus"></i>
                            Tambah</button>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="card-body">
                    
                        <div class="table-responsive">
                    <table class="table" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori Ingredient</th>
                                <th>Nama Ingredient</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $item)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$item->kategory_name}}</td>
                                <td>{{$item->ingredient_nama}}</td>
                                <td>{{formatRp($item->harga_satuan)}} / {{$item->satuan_harga}} {{$item->satuan}}</td>
                                <td>{{$item->stok}} {{$item->satuan}}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm pull-left" data-toggle="modal" data-target="#editData{{$item->id}}"><i
                                            class="icon-pencil"></i> Edit</button>
                                        <form action="{{route('ingredient.destroy',$item->id)}}" method="POST">
                                            {{csrf_field()}} {{method_field('DELETE')}}
                                            <button type="button" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ?')){return this.form.submit()}else{return false}" class="btn btn-danger btn-sm"><i class="icon-trash"></i>
                                                Hapus</button>
                                        </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        
        <div class="card">
            
            <div class="card-header card-header-primary">
                <div class="caption font-dark">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modTambahKategory"><i class="fa fa-plus"></i>
                        Tambah Kategori </button>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="card-body">
                    <div class="table-responsive">
                <table class="table" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kating as $key => $item)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$item->kategory_name}}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm pull-left" data-toggle="modal" data-target="#editkategory{{$item->id}}"><i
                                        class="icon-pencil"></i> Edit</button>
                                    <form action="{{route('delete.kategory',$item->id)}}" method="POST">
                                        {{csrf_field()}} {{method_field('DELETE')}}
                                        <button type="button" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ?')){return this.form.submit()}else{return false}" class="btn btn-danger btn-sm"><i class="icon-trash"></i>
                                            Hapus</button>
                                    </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modTambahKategory" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    {{-- <h4 class="modal-title">Tambah Data Ingredient</h4> --}}
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('add.kategory')}}">
                        {{csrf_field()}}{{method_field('POST')}}
    
                        <div class="form-group row">
                            <label for="kategory_name" class="col-md-4 col-form-label">Name Kategori</label>
    
                            <div class="col-md-12">
                                <input id="kategory_name" type="text" class="form-control" name="kategory_name" required autofocus>
    
                                @if ($errors->has('kategory_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('kategory_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label for="harga" class="col-md-4 col-form-label ">Harga</label>
    
                            <div class="col-md-12">
                                <input id="harga" type="number" min="1" step="any" class="form-control" name="harga" required autofocus>
    
                                @if ($errors->has('harga'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('harga') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="satuan_harga" class="col-md-4 col-form-label ">Satuan harga</label>
    
                            <div class="col-md-12">
                                <input id="satuan_harga" type="number" min="1" step="any" class="form-control" name="satuan_harga" required autofocus>
    
                                @if ($errors->has('satuan_harga'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('satuan_harga') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="nilai" class="col-md-4 col-form-label">Stok awal</label>
        
                                <div class="col-md-12">
                                    <input id="nilai" step="any" type="number" class="form-control" name="nilai" required autofocus>
        
                                    @if ($errors->has('nilai'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nilai') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="cp_name" class="col-md-5 col-form-label">Satuan</label>
    
                            <div class="col-md-12">
                                <select id="cp_name" name="satuan" class="form-control">
                                    <option>Pcs</option>
                                    <option>ML</option>
                                    <option>Gram</option>
                                    <option>Buah</option>
                                    <option>Lembar</option>
                                    <option>Sachet</option>
                                    <option>Cc</option>
                                    <option>Botol</option>
                                    <option>Porsi</option>
                                    <option>Potong</option>
                                    <option>Scoup</option>
                                    <option>Takar</option>
                                </select>
                            </div>
                        </div> --}}
    
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" id="tambah" class="btn btn-primary col-md-12" style="float:right;">
                                    {{ __('Tambah') }}
                                </button>
                            </div>
                        </div>
                    </form>
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
                {{-- <h4 class="modal-title">Tambah Data Ingredient</h4> --}}
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('ingredient.store')}}">
                    {{csrf_field()}}{{method_field('POST')}}

                    <div class="form-group row">
                        <label for="ingredient_nama" class="col-md-4 col-form-label">Ingredient</label>

                        <div class="col-md-12">
                            <input id="ingredient_nama" type="text" class="form-control" name="ingredient_nama" required autofocus>

                            @if ($errors->has('ingredient_nama'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('ingredient_nama') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga" class="col-md-4 col-form-label ">Harga</label>

                        <div class="col-md-12">
                            <input id="harga" type="number" min="1" step="any" class="form-control" name="harga" required autofocus>

                            @if ($errors->has('harga'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('harga') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="satuan_harga" class="col-md-4 col-form-label ">Satuan harga</label>

                        <div class="col-md-12">
                            <input id="satuan_harga" type="number" min="1" step="any" class="form-control" name="satuan_harga" required autofocus>

                            @if ($errors->has('satuan_harga'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('satuan_harga') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                            <label for="nilai" class="col-md-4 col-form-label">Stok awal</label>
    
                            <div class="col-md-12">
                                <input id="nilai" step="any" type="number" class="form-control" name="nilai" required autofocus>
    
                                @if ($errors->has('nilai'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nilai') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="cp_name" class="col-md-5 col-form-label">Satuan</label>

                        <div class="col-md-12">
                            <select id="cp_name" name="satuan" class="form-control">
                                <option>Pcs</option>
                                <option>ML</option>
                                <option>Gram</option>
                                <option>Buah</option>
                                <option>Lembar</option>
                                <option>Sachet</option>
                                <option>Cc</option>
                                <option>Botol</option>
                                <option>Porsi</option>
                                <option>Potong</option>
                                <option>Scoup</option>
                                <option>Takar</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-12">
                            <button type="submit" id="tambah" class="btn btn-primary col-md-12" style="float:right;">
                                {{ __('Tambah') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@foreach ($kating as $item)
<div class="container">
    <div class="modal fade" id="editkategory{{$item->id}}" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="{{route('edit.kategory', $item->id)}}">
                        {{csrf_field()}}{{method_field('PUT')}}

                        <div class="form-group row">
                            <label for="kategory_name" class="col-md-4 col-form-label">Ingredient</label>

                            <div class="col-md-12">
                                <input id="kategory_name" type="text" class="form-control" name="kategory_name" value="{{$item->ingredient_nama}}"
                                    required autofocus>

                                @if ($errors->has('kategory_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('kategory_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                        <label for="harga" class="col-md-4 col-form-label">Harga</label>

                        <div class="col-md-12">
                            <input id="harga" type="number" min="1" step="any" value="{{$item->harga_satuan}}" class="form-control" name="harga" required autofocus>

                            @if ($errors->has('harga'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('harga') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="satuan_harga" class="col-md-4 col-form-label">Satuan harga</label>

                        <div class="col-md-12">
                            <input id="satuan_harga" type="number" min="1" step="any" value="{{$item->satuan_harga}}" class="form-control" name="satuan_harga" required autofocus>

                            @if ($errors->has('satuan_harga'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('satuan_harga') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                        <div class="form-group row">
                            <label for="nilai" class="col-md-4 col-form-label ">Stok awal</label>
    
                            <div class="col-md-12">
                                <input id="nilai" type="number" step="any" class="form-control" name="nilai" value="{{$item->stok}}" required autofocus>
    
                                @if ($errors->has('nilai'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nilai') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="cp_name" class="col-md-5 col-form-label ">Satuan</label>

                        <div class="col-md-12">
                            <select name="satuan" class="form-control">
                                <option {{$item->satuan == 'Pcs' ? 'selected="selected"' : ''}}>Pcs</option>
                                <option {{$item->satuan == 'ML' ? 'selected="selected"' : ''}}>ML</option>
                                <option {{$item->satuan == 'Gram' ? 'selected="selected"' : ''}}>Gram</option>
                                <option {{$item->satuan == 'Buah' ? 'selected="selected"' : ''}}>Buah</option>
                                <option {{$item->satuan == 'Lembar' ? 'selected="selected"' : ''}}>Lembar</option>
                                <option {{$item->satuan == 'Sachet' ? 'selected="selected"' : ''}}>Sachet</option>
                                <option {{$item->satuan == 'Cc' ? 'selected="selected"' : ''}}>Cc</option>
                                <option {{$item->satuan == 'Botol' ? 'selected="selected"' : ''}}>Botol</option>
                                <option {{$item->satuan == 'Porsi' ? 'selected="selected"' : ''}}>Porsi</option>
                                <option {{$item->satuan == 'Potong' ? 'selected="selected"' : ''}}>Potong</option>
                                <option {{$item->satuan == 'Scoup' ? 'selected="selected"' : ''}}>Scoup</option>
                                <option {{$item->satuan == 'Takar' ? 'selected="selected"' : ''}}>Takar</option>
                            </select>
                        </div>
                    </div> --}}
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary col-md-12" style="float:right;">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($data as $item)
<div class="container">
    <div class="modal fade" id="editData{{$item->id}}" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="{{route('ingredient.update', $item->id)}}">
                        {{csrf_field()}}{{method_field('PUT')}}

                        <div class="form-group row">
                            <label for="ingredient_nama" class="col-md-4 col-form-label">Ingredient</label>

                            <div class="col-md-12">
                                <input id="ingredient_nama" type="text" class="form-control" name="ingredient_nama" value="{{$item->ingredient_nama}}"
                                    required autofocus>

                                @if ($errors->has('ingredient_nama'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('ingredient_nama') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                        <label for="harga" class="col-md-4 col-form-label">Harga</label>

                        <div class="col-md-12">
                            <input id="harga" type="number" min="1" step="any" value="{{$item->harga_satuan}}" class="form-control" name="harga" required autofocus>

                            @if ($errors->has('harga'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('harga') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="satuan_harga" class="col-md-4 col-form-label">Satuan harga</label>

                        <div class="col-md-12">
                            <input id="satuan_harga" type="number" min="1" step="any" value="{{$item->satuan_harga}}" class="form-control" name="satuan_harga" required autofocus>

                            @if ($errors->has('satuan_harga'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('satuan_harga') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                        <div class="form-group row">
                            <label for="nilai" class="col-md-4 col-form-label ">Stok awal</label>
    
                            <div class="col-md-12">
                                <input id="nilai" type="number" step="any" class="form-control" name="nilai" value="{{$item->stok}}" required autofocus>
    
                                @if ($errors->has('nilai'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nilai') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    <div class="form-group row">
                        <label for="cp_name" class="col-md-5 col-form-label ">Satuan</label>

                        <div class="col-md-12">
                            <select name="satuan" class="form-control">
                                <option {{$item->satuan == 'Pcs' ? 'selected="selected"' : ''}}>Pcs</option>
                                <option {{$item->satuan == 'ML' ? 'selected="selected"' : ''}}>ML</option>
                                <option {{$item->satuan == 'Gram' ? 'selected="selected"' : ''}}>Gram</option>
                                <option {{$item->satuan == 'Buah' ? 'selected="selected"' : ''}}>Buah</option>
                                <option {{$item->satuan == 'Lembar' ? 'selected="selected"' : ''}}>Lembar</option>
                                <option {{$item->satuan == 'Sachet' ? 'selected="selected"' : ''}}>Sachet</option>
                                <option {{$item->satuan == 'Cc' ? 'selected="selected"' : ''}}>Cc</option>
                                <option {{$item->satuan == 'Botol' ? 'selected="selected"' : ''}}>Botol</option>
                                <option {{$item->satuan == 'Porsi' ? 'selected="selected"' : ''}}>Porsi</option>
                                <option {{$item->satuan == 'Potong' ? 'selected="selected"' : ''}}>Potong</option>
                                <option {{$item->satuan == 'Scoup' ? 'selected="selected"' : ''}}>Scoup</option>
                                <option {{$item->satuan == 'Takar' ? 'selected="selected"' : ''}}>Takar</option>
                            </select>
                        </div>
                    </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary col-md-12" style="float:right;">
                                    {{ __('Edit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable( {
                "paging":   true,
                "ordering": false,
                "searching": true,
                "info":     false,
                "bPaginate": false,
                "bLengthChange": false,
                "bFilter": true,
                "bInfo": false,
                "bAutoWidth": false 
            } );
        } );
    </script>
@endsection