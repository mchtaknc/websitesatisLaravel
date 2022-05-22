@extends('admin.layouts.page')
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Müşteri Ekle</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Anasayfa</a></li>
                <li class="breadcrumb-item active">Müşteri Ekle</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Müşteri Ekle</h3>
        </div>
        <!-- /.card-header -->
        <form role="form" autocomplete="off" action="{{ route('admin.customers.store') }}" method="post" autocomplete="off">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Ad</label>
                    <input type="text" class="form-control form-control-sm @error('firstname') is-invalid @enderror" id="firstname" name="firstname" value="{{ old('firstname') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('firstname')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="name">Soyad</label>
                    <input type="text" class="form-control form-control-sm @error('lastname') is-invalid @enderror" id="lastname" name="lastname" value="{{ old('lastname') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('lastname')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="name">Telefon Numarası</label>
                    <input type="tel" class="form-control form-control-sm @error('phonenumber') is-invalid @enderror" id="phonenumber" name="phonenumber" value="{{ old('phonenumber') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('phonenumber')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="name">Firma Adı (Opsiyonel)</label>
                    <input type="text" class="form-control form-control-sm @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ old('company_name') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('company_name')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="name">Adres</label>
                    <input type="text" class="form-control form-control-sm @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('address')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="name">Ülke</label>
                    <input type="text" class="form-control form-control-sm @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('country')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="name">Şehir</label>
                    <input type="text" class="form-control form-control-sm @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('city')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="name">İlçe</label>
                    <input type="text" class="form-control form-control-sm @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('state')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="name">Vergi Dairesi (Opsiyonel)</label>
                    <input type="text" class="form-control form-control-sm @error('tax_office') is-invalid @enderror" id="tax_office" name="tax_office" value="{{ old('tax_office') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('tax_office')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="name">Vergi No (Opsiyonel)</label>
                    <input type="text" class="form-control form-control-sm @error('tax_id') is-invalid @enderror" id="tax_id" name="tax_id" value="{{ old('tax_id') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('tax_id')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="email">E-Posta</label>
                    <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('email')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="password">Şifre</label>
                    <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" name="password">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('password')}}</strong></span>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary btn-sm">Kaydet</button>
            </div>
        </form>
        <!-- /.card-body -->
    </div>
</div><!-- /.container-fluid -->
@endsection