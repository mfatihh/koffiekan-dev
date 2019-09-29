@extends('layouts.app')

@section('content')

<h3 class="page-title"> Kelola User
    <small></small>
</h3>
<div class="row" style="padding:20px">
    
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modTambah"><i class="fa fa-plus"></i>
                Tambah</button>
                
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        
        <div class="portlet card" style="padding:30px">
            <div class="portlet-title">
                
                <div class="tools"> </div>
            </div>
            
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $key => $item)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>
                                <a href="{{route('user.edit', $item->id)}}"><button class="btn btn-warning" style="float:left;"><i
                                            class="fa fa-pencil"></i> Edit</button></a>
                                <form action="{{route('user.destroy', $item->id)}}" method="POST">
                                    {{csrf_field()}} {{method_field('DELETE')}}
                                    <button type="button" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ?')){return this.form.submit()}else{return false}" class="btn btn-danger"><i class="fa fa-trash"></i>
                                        Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="modTambah" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{route('user.store')}}" name="formTambah">
                                {{csrf_field()}}

                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label">{{
                                        __('Nama') }}</label>

                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-12 col-form-label">{{
                                        __('E-Mail Address') }}</label>

                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-12 col-form-label">{{
                                        __('Password') }}</label>

                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password" required>

                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label">{{
                                        __('Confirm Password') }}</label>

                                    <div class="col-md-12">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-12">
                                        <button type="submit" id="tambah" class="btn btn-primary col-md-4" style="float:right;">
                                            Tambah 
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
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
            var posisi = document.getElementById("role").value;
            var email = document.getElementById("email").value;
            var role;
            if (posisi == 1){
                role = "superadmin";
            }else if(posisi == 2){
                role = "gudang";
            }else if(posisi == 3){
                role = "penjualan";
            }else{
                role = "customer";
            }
            // alert (
            //     "Nama Produk : "+ name + "\n"+
            //     "Posisi : "+ role + "\n"+
            //     "Email : "+ email + "\n"+
            //     "Apakah anda yakin ingin menambahkan data tersebut ?"
            // );
            if(confirm("Nama Produk : "+ name + "\n"+
                "Posisi : "+ role + "\n"+
                "Email : "+ email + "\n"+
                "Apakah anda yakin ingin menambahkan data tersebut ?"))
            {
                return this.form.submit()
            }else
               {
                return false
            }
        }
    </script>
    
    <script>
       $(document).ready(function() {
            $('#sample_1').DataTable( {
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