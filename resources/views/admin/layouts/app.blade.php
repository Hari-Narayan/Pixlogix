<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.partials.head')
</head>

<body class="sidebar-mini layout-fixed control-sidebar-slide-open accent-purple">

    <div class="wrapper">
    
        @include('admin.partials.topbar')
        @include('admin.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">

                @yield('content-header')

            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    @yield('content')

                </div>
            </section>
        </div>

        @include('admin.partials.footer')

    </div>

    @include('admin.partials.javascripts')

</body>
</html>