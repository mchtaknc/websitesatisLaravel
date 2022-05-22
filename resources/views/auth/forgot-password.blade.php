@extends('front.layouts.page')

@section('content')
@include('front.layouts.partials.headerv2')
<section class="form-contact-home-section">
    <!-- start contact us section -->
    <div class="container">
        <!-- start container -->
        <div class="row justify-content-center">
            <!-- start row -->
            <form class="col-md-8 row justify-content-center form-contain-home" style="margin-bottom: 100px;" id="ajax-contact" method="post" action="{{route('password.request')}}">
                @csrf
                <!-- start form -->
                <h5 style="width: 100%;">Şifremi Unuttum</h5><!-- title -->
                @if($errors->any())
                <div id="form-messages" class="error">
                <h6 class="my-3 font-weight-bold">Hata!<h6>
                @foreach($errors->all() as $error)
                <p>{{$error}}</p>
                @endforeach
                </div><!-- form message -->
                @endif
                <div class="col-md-12">
                    <!-- start col -->
                    <div class="field input-field">
                        <input class="form-contain-home-input" value="{{ old('email') }}" type="email" id="email" name="email" required><!-- input -->
                        <span class="input-group-prepend">E-Posta Adresi</span><!-- label -->
                    </div>
                </div><!-- end col -->
                <div class="btn-holder-contect">
                    <button type="submit" class=>GİRİŞ YAP</button><!-- submit button -->
                </div>
            </form><!-- end form -->

        </div><!-- end container -->
    </div><!-- end container -->
</section>
@endsection
