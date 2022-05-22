@extends('front.layouts.master')

@section('front_css')
@stack('css')
@yield('css')
@endsection

@section('body')
<div class="modal fade" id="videomodal" tabindex="-1" role="dialog" aria-labelledby="videomodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <!-- 16:9 aspect ratio -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" id="video"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="preloader">
    <svg class="spinner" id="pageloader_anime" width="32px" height="32px" viewBox="0 0 66 66"
        xmlns="http://www.w3.org/2000/svg">
        <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
    </svg>
</div>

@yield('content')

@include('front.layouts.partials.footer')
@endsection

@section('front_js')
@stack('js')
@yield('js')
@endsection