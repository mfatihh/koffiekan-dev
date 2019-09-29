@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/custom.css')}}">
<link rel="stylesheet" href="{{asset('css/style.default.css')}}">
<link rel="stylesheet" href="{{asset('vendor/owl.carousel/assets/owl.theme.default.css')}}">
<link rel="stylesheet" href="{{asset('vendor/owl.carousel/assets/owl.carousel.css')}}">
@endsection

@section('content')
<h3>Edit Produk</h3>
<div class="col-md-12 card" style="padding:25px;">
    <h4>Detail Produk</h4>
    <form action="{{route('products.update', $product->id)}}" method="POST">
        {{csrf_field()}} {{method_field('PUT')}}
        <div class="row">
            <div class="col-md-6">
                <label>Kategori</label>
                <select class="form-control" name="unit_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($unit as $item)
                    <option {{ $item->id ==  $product->unit_id ? 'selected="selected"' : '' }} value="{{$item->id}}">
                        {{$item->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label>Kode Produk</label>
                <input type="text" name="kode_produk" class="form-control" value="{{$product->kode_produk}}" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>Nama Produk</label>
                <input type="text" name="name" class="form-control" value="{{$product->name}}" required>
            </div>

            <div class="col-md-6">
                <label>Hot / Ice</label>
                <select class="form-control" name="h_i" required>
                    <option value="">Pilih Hot / Ice</option>
                    <option {{ 'Hot' ==  $product->h_i ? 'selected="selected"' : '' }}>Hot</option>
                    <option {{ 'Ice' ==  $product->h_i ? 'selected="selected"' : '' }}>Ice</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label>Harga</label>
                <input type="number" name="cash_price" class="form-control" value="{{$product->cash_price}}" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
    <br><br>
    <h4>List Ingredient Produk</h4>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modTambah"><i
        class="fa fa-plus"></i>
    Tambah Produk</button>
    <table class="table table-hover table-bordered" style="margin-top:30px;">
        <thead>
            <tr>
                <th style="text-align: center">Ingredient</th>
                <th style="text-align: center">Satuan</th>
                <th style="text-align: center">Harga</th>
                <th style="text-align: center">Aksi</th>
            </tr>
        </thead>
        <tbody id="listSubCat">
            @foreach($product_ingredient as $item)
            <tr>
                <td>{{$item->ingredient_nama}}</td>
                <td class="text-center">
                    <form action="{{route('products.updateSatuan')}}" method="POST">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <input type="hidden" name="ingredient_id" value="{{$item->id}}">
                    <input type="number" min="0" value="{{$item->nilai}}" step="any" name="nilai"> {{$item->satuan}}
                </td>
                <td class="text-center">
                       {{formatRp($item->harga)}}
                    </td>
                <td>
                    <div class="btn-group">
                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-expanded="false"> Actions

                        </button>
                        <ul class="dropdown-menu pull-left" role="menu">
                            <li>
                                    {{csrf_field()}} {{method_field('PUT')}}
                                    <input type="submit" style="margin-left:16px;" class="btn btn-warning btn-sm" value="Update">
                                </form>
                            </li>

                            <li style="padding:7px 0 5px 16px;">
                                <form action="{{route('products.deleteSatuan')}}" method="POST">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="ingredient_id" value="{{$item->id}}">
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
                    <form action="{{route('add.ingredient')}}" method="POST">
                        {{csrf_field()}}
                        {{-- <select class="form-control" name="unit_id" required>
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
                        <div class="col-md-6" style="float:left;"> --}}
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <div class="">
                                <label class="control-label">Kategori</label>
                                <select name="ingredient_id" class="form-control">
                                    <option value="">Pilih Ingredient</option>
                                    @foreach($ingredient as $item)
                                    <option value="{{$item->id}}" data-object="{{$item}}">{{$item->ingredient_nama}} 
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-md-1"style="float:left;">
                            <label class="control-label">Tambah</label>
                            <button class="btn btn-sm btn-success" type="submit"><i
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
                                <tbody id="listSubCat"> --}}
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
                                {{-- </tbody>
                                <tfoot id="listSub">
                                    {{-- @if(!empty($product->id))
                                @foreach($ingredient as $subCategory)
                                <input type="hidden" name="subCategory[]" id="tr_{{$subCategory->id}}"
                                    value="{{$subCategory->id}}">
                                    @endforeach
                                    @endif --}}
                                {{-- </tfoot>
                            </table> --}} 
                        {{-- </div> --}}

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
    <script>
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
    </script>
@endsection