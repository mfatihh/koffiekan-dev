@extends('layouts.app')

@section('content')

<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> User Profile | Account
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet ">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="{{asset('img/avatar/'.Auth::user()->avatar)}}" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> {{Auth::user()->name }} </div>
                    <div class="profile-usertitle-job"> </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="#tab_1_1" data-toggle="tab">
                                <i class="icon-home"></i> Personal info </a>
                        </li>
                        {{-- <li>
                            <a href="#tab_1_2" data-toggle="tab">
                                <i class="icon-settings"></i> Change avatar </a>
                        </li> --}}
                        <li>
                            <a href="#tab_1_3" data-toggle="tab">
                                <i class="icon-info"></i> Change password </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                            </div>
                            <!-- <ul class="nav nav-tabs">
                                                            <li class="active">
                                                                <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                                            </li>
                                                            <li>
                                                                <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                                            </li>
                                                            <li>
                                                                <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                                            </li>
                                                        </ul> -->
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab_1_1">
                                    <form role="form" method="POST" action="{{route('profil.update', Auth::user()->id)}}">
                                        {{csrf_field()}} {{method_field('PUT')}}
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" />
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control" />
                                        </div>

                                        <div class="margiv-top-10">
                                            <button type="submit" class="btn green"> Save Changes </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                                <!-- CHANGE AVATAR TAB -->
                                <div class="tab-pane" id="tab_1_2">
                                    <form action="{{url('profil/'.Auth::user()->id.'/update/ava')}}" method="POST">
                                        {{csrf_field()}} {{method_field('PATCH')}}
                                        <div class="form-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <img src="{{asset('img/avatar/'.Auth::user()->avatar)}}" width="150px"
                                                    height="150px" />
                                                @if ($errors->has('avatar'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('avatar') }}</strong>
                                                </span>
                                                @endif
                                                <br><br>
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <input type="file" name="avatar"> </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="margin-top-10">
                                            <button type="submit" class="btn green"> Submit </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->
                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane" id="tab_1_3">
                                    <form action="{{url('profil/'.Auth::user()->id.'/update/password')}}" method="POST">
                                        {{csrf_field()}} {{method_field('PATCH')}}
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                        <div class="form-group">
                                            <label class="control-label">New Password</label>
                                            <input type="password" name="password" class="form-control" /> </div>
                                        <div class="form-group">
                                            <label class="control-label">Re-type New Password</label>
                                            <input type="password" name="password_confirmation" class="form-control" />
                                        </div>
                                        <div class="margin-top-10">
                                            <button type="submit" class="btn green"> Change Password </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- END CHANGE PASSWORD TAB -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
@endsection