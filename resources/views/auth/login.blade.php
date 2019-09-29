<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Koffiekan
    </title>
    <link href="{{ asset('css/assets/material-dashboard.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/assets/demo/demo.css') }}" rel="stylesheet" />
    <link href="{{asset('css/font.googleapis.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
</head>

<body class=" login">

    <!-- End Navbar -->

    <div class="content" style="margin-top:50px;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <center>
                                <h2 class="card-title">Login</h2>
                                <p class="card-category">Login before go to Dashboard.</p>
                            </center>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-upgrade">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="text-center"></th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <br>
                                        <tr>
                                            <center>
                                                <div class="col-md-8 ml-auto mr-auto">
                                                    <div class="">
                                                        <form class="login-form" method="POST"
                                                            action="{{ route('login') }}">
                                                            {{ csrf_field() }}
                                                            <div class="alert alert-danger display-hide">
                                                                <button class="close" data-close="alert"></button>
                                                                <span>Masukan Email and password. </span>
                                                            </div>
                                                            @if ($errors->has('email'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                            @endif
                                                            <input
                                                                class="form-control form-control-solid placeholder-no-fix"
                                                                type="text" placeholder="Email" name="email" />
                                                    </div>
                                                    <div class="form-group">
                                                        @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                        @endif
                                                        <input
                                                            class="form-control form-control-solid placeholder-no-fix"
                                                            type="password" autocomplete="off" placeholder="Password"
                                                            name="password" /> </div>
                                                            <button type="submit" class="btn green uppercase" style="width:100%;">Login</button>

                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="rem-password">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                            </div>
                            </center>
                            </tr>
                            <tr>
                                <div class="col-ml-8">
                                    <td class="form-actions">
                                        
                                    </td>
                                </div>
                            </tr>
                            </tbody>
                            </form>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

</body>

</html>