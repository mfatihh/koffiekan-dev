<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | {{ config('app.name', 'Pratista') }}</title>

    {{ Html::style(url('css/pdf.css')) }}
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    @yield('style')
</head>
<body>
    <div class="content">
        @yield('content')
    </div>
    @yield('script')
</body>
</html>