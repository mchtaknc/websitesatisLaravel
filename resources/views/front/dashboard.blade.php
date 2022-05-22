@extends('front.layouts.page')

@section('content')
@include('front.layouts.partials.headerv2')
<section class="padding-60-0-100">
    <div class="container blog-container-page">
        <div class="row justify-content-left mr-tp-60">
            <aside class="col-md-3 blog-sidebar">
                <div class="question-area-answer-navs">
                    <div class="nuhost-filter-list-container min-height-auto">
                        <h5 class="font-weight-bold pb-2" style="border-bottom: 1px solid #ddd"><i class="fa fa-user"></i> {{ Auth::user()->name }}</h5>
                        <ul id="nuhost-filter-list">
                            <li><a href="{{ route('dashboard') }}">Panel Anasayfa <i class="fas fa-angle-right"></i></a></li>
                            <li><a href="{{ route('account') }}">Bilgilerim <i class="fas fa-angle-right"></i></a></li>
                            <li><a href="{{ route('password') }}">Parola Değiştir <i class="fas fa-angle-right"></i></a></li>
                            <li><a href="{{ route('orders') }}">Siparişlerim <i class="fas fa-angle-right"></i></a></li>
                            <li><a href="{{ route('tickets') }}">Destek <i class="fas fa-angle-right"></i></a></li>
                            <li><a href="#" onclick="document.getElementById('logout-form').submit(); return false;">Çıkış Yap <i class="fas fa-angle-right"></i></a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
            </aside><!-- /.blog-sidebar -->
            <div class="col-md-9">
                <div class="dashboard">
                    @yield('dashboard-content')
                </div>
            </div>
        </div>
    </div>
</section>
@endsection