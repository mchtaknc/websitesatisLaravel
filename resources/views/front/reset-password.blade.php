@extends('front.layouts.page')

@section('content')
@include('front.layouts.partials.headerv2')
<section class="form-contact-home-section">
    <!-- start contact us section -->
    <div class="container">
        <!-- start container -->
        <div class="row justify-content-center">
            <!-- start row -->
            <form class="col-md-8 row justify-content-center form-contain-home" style="margin-bottom: 100px;" id="ajax-contact" method="post" action="{{route('password.update')}}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <!-- start form -->
                <h5 style="width: 100%;">Şifremi Yenile</h5><!-- title -->
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
                        <input class="form-contain-home-input" value="{{ old('email',$request->email) }}" type="email" id="email" name="email" required><!-- input -->
                        <span class="input-group-prepend">E-Posta Adresi</span><!-- label -->
                        @error('mail')
                            <span class="invalid-feedback is-invalid">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div><!-- end col -->
                <div class="col-md-12">
                    <div class="field input-field">
                        <input class="form-contain-home-input" type="password" id="password" name="password" required>
                        <span class="input-group-prepend">Şifre *</span>
                        @error('password')
                            <span class="invalid-feedback is-invalid">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="field input-field">
                        <input class="form-contain-home-input" type="password" id="password_confirmation" name="password_confirmation" required>
                        <span class="input-group-prepend">Şifre (Tekrar) *</span>
                    </div>
                </div>
                <div class="btn-holder-contect">
                    <button type="submit">YENİLE</button><!-- submit button -->
                </div>
            </form><!-- end form -->

        </div><!-- end container -->
    </div><!-- end container -->
</section>
@endsection
