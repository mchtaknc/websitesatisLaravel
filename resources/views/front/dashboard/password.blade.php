@extends('front.dashboard')
@section('dashboard-content')
<div class="account nuhost-filter-list-container">
    <h5>Şifre Değiştir</h5>
    <form class="custom-form mt-4" action="{{ route('password') }}" method="post">
        @csrf
        @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
        @endif
        <div class="form-row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-label-form-sm">Eski Şifre</label>
                    <input type="password" class="form-control form-control-sm @error('current_password') is-invalid @enderror" name="current_password">
                    @error('current_password')
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('current_password')}}</strong></span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-label-form-sm">Yeni Şifre</label>
                    <input type="password" class="form-control form-control-sm @error('new_password') is-invalid @enderror" name="new_password">
                    @error('new_password')
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('new_password')}}</strong></span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-label-form-sm">Yeni Şifre Tekrar</label>
                    <input type="password" class="form-control form-control-sm @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation">
                    @error('new_password_confirmation')
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('new_password_confirmation')}}</strong></span>
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-sm">Kaydet</button>
    </form>
</div>
@endsection