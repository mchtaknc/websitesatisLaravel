@extends('front.dashboard')
@section('dashboard-content')
<div class="account nuhost-filter-list-container">
    <h5>Hesap Bilgilerim</h5>
    <form class="custom-form mt-4" action="{{ route('account.update') }}" method="post">
        @csrf
        @method('PUT')
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-label-form-sm">Ad</label>
                    <input type="text" class="form-control form-control-sm @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname', $customer->firstname) }}">
                    @error('firstname')
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('firstname')}}</strong></span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-label-form-sm">Soyad</label>
                    <input type="text" class="form-control form-control-sm @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname', $customer->lastname) }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('lastname')}}</strong></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-label-form-sm">E-Posta</label>
                    <input type="text" class="form-control form-control-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email',$customer->user->email) }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('email')}}</strong></span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-label-form-sm">Telefon Numarası</label>
                    <input type="text" class="form-control form-control-sm @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{ old('phonenumber',$customer->phonenumber) }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('phonenumber')}}</strong></span>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-label-form-sm">Firma Adı (Opsiyonel)</label>
                    <input type="text" class="form-control form-control-sm" name="companyname" value="{{ old('companyname',$customer->company_name) }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-label-form-sm">Adres</label>
                    <input type="text" class="form-control form-control-sm @error('address') is-invalid @enderror" name="address" value="{{ old('address',$customer->address) }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('address')}}</strong></span>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-label-form-sm">Ülke</label>
                    <input type="text" class="form-control form-control-sm @error('country') is-invalid @enderror" name="country" value="{{ old('country',$customer->country) }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('country')}}</strong></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-label-form-sm">Şehir</label>
                    <input type="text" class="form-control form-control-sm @error('city') is-invalid @enderror" name="city" value="{{ old('city',$customer->city) }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('city')}}</strong></span>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="col-label-form-sm">İlçe</label>
                    <input type="text" class="form-control form-control-sm @error('state') is-invalid @enderror" name="state" value="{{ old('state',$customer->state) }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('state')}}</strong></span>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-label-form-sm">Vergi Dairesi (Opsiyonel)</label>
                    <input type="text" class="form-control form-control-sm" name="tax_office" value="{{ old('tax_office',$customer->tax_office) }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-label-form-sm">Vergi No (Opsiyonel)</label>
                    <input type="text" class="form-control form-control-sm" name="tax_id" value="{{ old('tax_id',$customer->tax_id) }}">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-sm">Kaydet</button>
    </form>
</div>
@endsection