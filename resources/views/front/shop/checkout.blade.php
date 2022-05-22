@extends('front.layouts.page')

@section('content')
@include('front.layouts.partials.headerv2')
<section class="padding-100-0">
    <div class="container">
        <div class="succec-domain-search-mesage mb-5">
            SİPARİŞ BİLGİLERİ
        </div>
        <form action="{{route('product.checkout')}}" class="checkout-form" method="post">
            @csrf
            @method('post')
            <div class="row">
                <div class="col-md-8">
                    <div class="form-inner">
                        <div class="row mb-5 align-items-center justify-content-center text-center">
                            <div class="col-md-12 text-left mb-4">
                                <h5>Kişisel Bilgiler</h5>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm @error('firstname') is-invalid @enderror" placeholder="Ad" id="firstname" name="firstname" value="{{ auth()->user() !== null ? auth()->user()->customer->firstname : old('firstname') }}" required>
                                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('firstname')}}</strong></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-user-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm @error('lastname') is-invalid @enderror" placeholder="Soyad" name="lastname" value="{{ auth()->user() !== null ? auth()->user()->customer->lastname : old('lastname') }}" required>
                                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('lastname')}}</strong></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    </div>
                                    <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" placeholder="E-Posta Adresi" name="email" value="{{ auth()->user() !== null ? auth()->user()->email : old('email') }}" required>
                                    <span class="invalid-feedback text-left" role="alert"><strong>{{$errors->first('email')}}</strong></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                    </div>
                                    <input type="tel" class="form-control form-control-sm @error('phonenumber') is-invalid @enderror" placeholder="Telefon Numarası" name="phonenumber" value="{{ auth()->user() !== null ? auth()->user()->customer->phonenumber : old('phonenumber') }}" required>
                                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('phonenumber')}}</strong></span>
                                </div>
                            </div>
                            @guest
                            <div class="col-md-6 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" placeholder="Şifre" required>
                                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('password')}}</strong></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-sm" name="password_confirmation" placeholder="Şifre Tekrar" required>
                                </div>
                            </div>
                            @endguest
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-left mb-4">
                                <h5>Fatura Adresi</h5>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-file-signature"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm @error('companyname') is-invalid @enderror" name="companyname" placeholder="Firma Adı (Opsiyonel)" value="{{ auth()->user() !== null ? auth()->user()->customer->companyname : old('companyname') }}">
                                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('companyname')}}</strong></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-building"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm @error('tax_office') is-invalid @enderror" name="tax_office" placeholder="Vergi Dairesi (Opsiyonel)" value="{{ auth()->user() !== null ? auth()->user()->customer->tax_office : old('tax_office') }}">
                                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('tax_office')}}</strong></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm @error('tax_id') is-invalid @enderror" name="tax_id" placeholder="Vergi Numarası (Opsiyonel)" value="{{ auth()->user() !== null ? auth()->user()->customer->tax_id : old('tax_id') }}">
                                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('tax_id')}}</strong></span>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-globe-europe"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm @error('country') is-invalid @enderror" name="country" placeholder="Ülke" value="{{ auth()->user() !== null ? auth()->user()->customer->country : old('country') }}" required>
                                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('country')}}</strong></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm @error('city') is-invalid @enderror" placeholder="Şehir" name="city" value="{{ auth()->user() !== null ? auth()->user()->customer->city : old('city') }}" required>
                                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('city')}}</strong></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm @error('state') is-invalid @enderror" placeholder="İlçe" name="state" value="{{ auth()->user() !== null ? auth()->user()->customer->state : old('state') }}" required>
                                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('state')}}</strong></span>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="input-group">
                                    <textarea rows="5" class="form-control form-control-sm @error('address') is-invalid @enderror" placeholder="Adres" name="address" required>{{ auth()->user() !== null ? auth()->user()->customer->address : old('address') }}</textarea>
                                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('address')}}</strong></span>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="input-group">
                                    <textarea rows="5" class="form-control form-control-sm" name="notes" placeholder="Siparişinize eklemek istediğiniz bir not veya bildi var ise buraya yazabilirsiniz.">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="list-group checkout-price mb-3 search-box-filter-domains">
                        @include('front.ajax.totalprice')
                    </ul>
                    <div class="aggrement mb-3">
                        <h5 class="domain-filter-tab-title">ÖDEME YÖNTEMİ</h5>
                        <label><input type="radio" name="payment_method" value="credit_card" checked="checked"> Kredi Kartı / Banka Kartı</label>
                        <label><input type="radio" name="payment_method" value="bank_transfer"> Banka Havalesi / EFT</label>
                        <h5 class="domain-filter-tab-title mt-5">SÖZLEŞME</h5>
                        <label><input type="checkbox" name="agreement" required> Kullanım Koşulları'nı ve Mesafeli Satış Sözleşmesi'ni okudum, onaylıyorum.</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Ödeme Yap</button>
                </div>
            </div>
        </form>
    </div>
    @if(isset($payment))
    {{!! $payment !!}}
    @endif
</section>
@endsection
@section('js')
@push('js')
@if(session('success'))
<script>
    swal.fire('Başarılı', "{{session('success')}}", 'success');
</script>
@elseif(session('errors'))
<script>
    swal.fire("Hata", "Lütfen hatalı alanları düzeltiniz.", "error");
</script>
@endif
@endpush
@endsection
