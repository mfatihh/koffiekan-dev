@extends('layouts.app')

@section('content')

<h1 class="page-title"> Edit User
    <small></small>
</h1>
<div class="portlet card" style="padding:30px">
        <div class="tools">
            <a href="javascript:;" class="collapse"> </a>
            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
            <a href="javascript:;" class="reload"> </a>
            <a href="javascript:;" class="remove"> </a>
        
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM--><br><br>
        <form action="{{route('user.update', $user->id)}}" method="POST" class="form-horizontal">
            {{csrf_field()}}  {{method_field('PUT')}}
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Nama</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="name" value="{{$user->name}}">
                    </div>
                </div>
                <!--<div class="form-group">-->
                <!--    <label class="col-md-3 control-label" name="posisi">Posisi</label>-->
                <!--    <div class="col-md-12">-->
                <!--        <select name="role" class="form-control">-->
                <!--            @foreach ($role as $item)-->
                <!--            <option value="{{$item->id}}" {{ $user->roles[0]->name == $item->name ?'selected':''}}>{{$item->name}}</option>-->
                <!--            @endforeach-->
                <!--        </select>-->
                <!--    </div>-->
                <!--</div>-->
                <div class="form-group">
                    <label class="col-md-3 control-label">Email</label>
                    <div class="col-md-12">
                        <input type="email" name="email" class="form-control" value="{{$user->email}}">
                    </div>
                </div>
                <div class="form-actions top">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        </br>
        </br>

        <form action="{{url('user/'.$user->id.'/update/password')}}" method="POST" class="form-horizontal">
            {{csrf_field()}} {{method_field('PUT')}}
            <div class="form-body">
                <div class="form-group">
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                    <label class="col-md-3 control-label">Password Baru</label>
                    <div class="col-md-12">
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Konfirmasi Password Baru</label>
                    <div class="col-md-12">
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
                <div class="form-actions top">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>

@endsection