@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/custom.css')}}">
<link rel="stylesheet" href="{{asset('css/style.default.css')}}">
<link rel="stylesheet" href="{{asset('vendor/owl.carousel/assets/owl.theme.default.css')}}">
<link rel="stylesheet" href="{{asset('vendor/owl.carousel/assets/owl.carousel.css')}}">
@endsection

@section('content')
<div class="wrapper ">

    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="card">
            <div class="card-header card-header-primary">
                <div class="caption font-dark">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modTambah"><i
                            class="fa fa-plus"></i>
                        Tambah Produk</button>
                </div>
                <div class="tools"> </div>
            </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori Produk</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th>Hot / Ice</th>
                                <th>Harga</th>
                                {{-- <th>Status</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $key => $item)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$item->kategori}}</td>
                                <td>{{$item->kode_produk}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->h_i}}</td>
                                <td>{{$item->cash_price}}</td>
                                {{-- @if($item->status == 0)
                    <td><span class="label label-warning">Tidak Aktif</span></td>
                    @else
                    <td><span class="label label-success">Aktif</span></td>
                    @endif --}}
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs green dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-expanded="false"> Actions
                                            
                                        </button>
                                        <ul class="dropdown-menu pull-left" role="menu">
                                            <li>
                                                <button type="button" class="btn btn-warning btn-sm" style="margin-left:16px;"><a href="{{route('products.stok.edit',$item->id)}}" style="color:#fff;text-decoration:none;"><i class="icon-pencil"></i>
                                                    Edit</a></button>
                                            </li>

                                            <li style="padding:7px 0 5px 16px;">
                                                <form action="{{route('products.destroy',$item->id)}}"
                                                    method="POST">
                                                    {{csrf_field()}} {{method_field('DELETE')}}
                                                    <button type="button"
                                                        onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ?')){return this.form.submit()}else{return false}"
                                                        class="btn btn-danger btn-sm"><i class="icon-trash"></i>
                                                        Hapus</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
    
    <!-- BEGIN PAGE TITLE-->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <div class="caption font-dark">
                                <button type="button" class="btn btn-info" data-toggle="modal"
                                    data-target="#modTambahKategori"><i class="fa fa-plus"></i>
                                    Tambah Kategori</button>
                            </div>
                            <div class="tools"> </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="example2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($unit as $key => $item)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-xs green dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false"> Actions

                                                    </button>
                                                    <ul class="dropdown-menu pull-left" role="menu">
                                                        <li>
                                                            <button type="button" class="btn btn-warning btn-sm"
                                                                style="margin-left:17px;" data-toggle="modal"
                                                                data-target="#editDataKategori{{$item->id}}"><i
                                                                    class="icon-pencil"></i>
                                                                Edit</button>
                                                        </li>

                                                        <li style="padding:7px 0 5px 16px;">
                                                            <form action="{{route('units.destroy',$item->id)}}"
                                                                method="POST">
                                                                {{csrf_field()}} {{method_field('DELETE')}}
                                                                <button type="button"
                                                                    onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ?')){return this.form.submit()}else{return false}"
                                                                    class="btn btn-danger btn-sm"><i
                                                                        class="icon-trash"></i>
                                                                    Hapus</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </td>
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
    
            

        {{-- form kategori --}}
        <div class="modal fade" id="modTambahKategori" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        {{-- <h4 class="modal-title">Tambah Data Kategori</h4> --}}
                    </div>
                    <div class="modal-body">
                        <form action="{{route('units.store')}}" method="POST">
                            {{csrf_field()}}
                            <input type="text" name="name" class="form-control" placeholder="Nama Kategori" required>
                            <button type="submit" id="tambah" class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @foreach($unit as $key => $item)
        <div class="modal fade" id="editDataKategori{{$item->id}}" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        {{-- <h4 class="modal-title">Edit Data Kategori</h4> --}}
                    </div>
                    <div class="modal-body">
                        <form action="{{route('units.update',$item->id)}}" method="POST">
                            {{csrf_field()}}{{method_field('PUT')}}
                            <input type="text" name="name" class="form-control" value="{{$item->name}}" required>
                            <button type="submit" id="tambah" class="btn btn-primary">Edit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


        {{-- form produk --}}
        <div class="modal fade" id="modTambah" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        {{-- <h4 class="modal-title">Tambah Data Produk</h4> --}}
                    </div>
                    <div class="modal-body">
                        <form action="{{route('products.store')}}" method="POST">
                            {{csrf_field()}}
                            <select class="form-control" name="unit_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($unit as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <input type="text" name="kode_produk" class="form-control" placeholder="Kode Produk"
                                required>
                            <input type="text" name="name" class="form-control" placeholder="Nama Produk" required>
                            <select class="form-control" name="h_i" required>
                                <option value="">Pilih Hot / Ice</option>
                                <option>Hot</option>
                                <option>Ice</option>
                            </select>
                            <input type="number" step="any" name="cash_price" class="form-control" placeholder="Harga" required>
                            <div class="col-md-6" style="float:left;">
                                <div class="">
                                    <label class="control-label">Kategori</label>
                                    <select name="category" class="form-control">
                                        <option value="">Pilih Ingredient</option>
                                        @foreach($ingredient as $item)
                                        <option value="{{$item->id}}" data-object="{{$item}}">{{$item->ingredient_nama}} 
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1"style="float:left;">
                                <label class="control-label">Tambah</label>
                                <button class="btn btn-sm btn-success" type="button" onclick="saveSub()"><i
                                        class="fa fa-plus"></i></button>
                            </div>
                            <div class="">
                                <table class="table table-hover table-bordered" style="margin-top:30px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center">Ingredient</th>
                                            <th style="text-align: center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="listSubCat">
                                        {{-- @if(!empty($product->id))
                                    @foreach($ingredient as $subCategory)
                                    <tr id="tr_{{$subCategory->id}}">
                                        <td>{{$subCategory->name}}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="deleteSub({{$subCategory->id}})"><i
                                                    class="fa fa-"></i></button>
                                        </td>
                                        </tr>
                                        @endforeach
                                        @endif --}}
                                    </tbody>
                                    <tfoot id="listSub">
                                        {{-- @if(!empty($product->id))
                                    @foreach($ingredient as $subCategory)
                                    <input type="hidden" name="subCategory[]" id="tr_{{$subCategory->id}}"
                                        value="{{$subCategory->id}}">
                                        @endforeach
                                        @endif --}}
                                    </tfoot>
                                </table>
                            </div>

                            <button type="submit" id="tambah" class="btn btn-primary">Tambah</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>

        {{-- form kategory produk --}}
        <div class="modal fade" id="modTambah" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            {{-- <h4 class="modal-title">Tambah Data Produk</h4> --}}
                        </div>
                        <div class="modal-body">
                            <form action="{{route('products.store')}}" method="POST">
                                {{csrf_field()}}
                                <select class="form-control" name="unit_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($unit as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="kode_produk" class="form-control" placeholder="Kode Produk"
                                    required>
                                <input type="text" name="name" class="form-control" placeholder="Nama Produk" required>
                                <select class="form-control" name="h_i" required>
                                    <option value="">Pilih Hot / Ice</option>
                                    <option>Hot</option>
                                    <option>Ice</option>
                                </select>
                                <input type="number" step="any" name="cash_price" class="form-control" placeholder="Harga" required>
                                <div class="col-md-6" style="float:left;">
                                    <div class="">
                                        <label class="control-label">Kategori</label>
                                        <select name="category" class="form-control">
                                            <option value="">Pilih Ingredient</option>
                                            @foreach($ingredient as $item)
                                            <option value="{{$item->id}}" data-object="{{$item}}">{{$item->ingredient_nama}} 
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1"style="float:left;">
                                    <label class="control-label">Tambah</label>
                                    <button class="btn btn-sm btn-success" type="button" onclick="saveSub()"><i
                                            class="fa fa-plus"></i></button>
                                </div>
                                <div class="">
                                    <table class="table table-hover table-bordered" style="margin-top:30px;">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Ingredient</th>
                                                <th style="text-align: center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="listSubCat">
                                            {{-- @if(!empty($product->id))
                                        @foreach($ingredient as $subCategory)
                                        <tr id="tr_{{$subCategory->id}}">
                                            <td>{{$subCategory->name}}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="deleteSub({{$subCategory->id}})"><i
                                                        class="fa fa-"></i></button>
                                            </td>
                                            </tr>
                                            @endforeach
                                            @endif --}}
                                        </tbody>
                                        <tfoot id="listSub">
                                            {{-- @if(!empty($product->id))
                                        @foreach($ingredient as $subCategory)
                                        <input type="hidden" name="subCategory[]" id="tr_{{$subCategory->id}}"
                                            value="{{$subCategory->id}}">
                                            @endforeach
                                            @endif --}}
                                        </tfoot>
                                    </table>
                                </div>
    
                                <button type="submit" id="tambah" class="btn btn-primary">Tambah</button>
    
                            </form>
                        </div>
                    </div>
    
                </div>
            </div>

        @foreach($products as $key => $item)
        <div class="modal fade" id="editData{{$item->id}}" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        {{-- <h4 class="modal-title">Edit Data Barang</h4> --}}
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            {{csrf_field()}}{{method_field('PUT')}}
                            <select class="form-control" name="unit" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($unit as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                            <input type="text" name="kode_produk" class="form-control" value="{{$item->kode_produk}}"
                                required>
                            <input type="text" name="name" class="form-control" value="{{$item->name}}" required>
                            <input type="number" name="cash_price" class="form-control" value="{{$item->cash_price}}"
                                required>
                            <button type="submit" id="tambah" class="btn btn-primary">Edit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endsection

        @section('script')
        <script type="text/javascript">
            var arr_sub = [];

            function setSubCategory() {
                //$('[name=subCategory]').empty().append('<option value="">Pilih Sub Kategori</option>');
                $('[name=subCategory]').empty();
                if ($('[name=category]').val() == '') return $('[name=subCategory]').empty().append(
                    '<option value="">Pilih Sub Kategori</option>');
                $('[name=category] option:selected').data('object').sub_category.forEach(function (sub) {
                    $('[name=subCategory]').append('<option value="' + sub.id + '">' + sub.name + sub.nilai +  '</option>');
                });
            }

            function saveSub() {
                if ($('[name=category]').val() == '') return;
                var subCat = parseInt($('[name=category]').val());
                if (arr_sub.indexOf(subCat) !== -1) return;
                var row = '<tr id="tr_' + subCat + '">\n' +
                    '                    <td>' + $('[name=category] option:selected').text() + '</td>\n' +
                    '                    <td style="text-align: center">\n' +
                    '                      <button class="btn btn-sm btn-danger" onclick="deleteSub('+subCat+')"><i class="fa fa-remove"></i></button>\n' +
                    '                    </td>\n' +
                    '                  </tr>';
                $('#listSubCat').append(row);
                $('#listSub').append('<input type="hidden" name="category[]" id="tr_' + subCat + '" value="' + subCat +
                    '">');
                arr_sub.push(subCat);
            }

            function deleteSub(id) {
                var index = arr_sub.indexOf(id);
                if (index === -1) return;
                arr_sub.splice(index, 1);
                $('#tr_' + id).remove();
            }
        </script>
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

        $(document).ready(function() {
            $('#example2').DataTable( {
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