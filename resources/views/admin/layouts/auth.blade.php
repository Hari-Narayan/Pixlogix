<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.partials.head')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            {{-- <a href="../../index2.html"><b>Admin</b>LTE</a> --}}
            <img style="width: 100px; height: 100px;" src="{{ url('public/admin/dist/img/logo_sm.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
        </div><!-- /.login-logo -->

        @yield('content')

    </div>
</body>
@include('admin.partials.javascripts')
</html>