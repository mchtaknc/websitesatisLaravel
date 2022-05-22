@extends('admin.layouts.master')

@section('adminlte_css')
@stack('css')
@yield('css')
@endsection

@section('body')
<div class="wrapper">
    @include('admin.layouts.partials.nav')

    @include('admin.layouts.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content-header">
            @yield('content-header')
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- /.content -->
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    @include('admin.layouts.partials.footer')

</div>
@endsection

@section('adminlte_js')
@stack('js')
@yield('js')
@endsection