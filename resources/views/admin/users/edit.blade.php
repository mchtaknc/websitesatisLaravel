@extends('admin.layouts.page')
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Kullanıcı Düzenle</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Anasayfa</a></li>
                <li class="breadcrumb-item active">Kullanıcı Düzenle</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Kullanıcı Düzenle</h3>
        </div>
        <!-- /.card-header -->
        <form role="form" autocomplete="off" action="{{ route('admin.users.update',$user->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">İsim</label>
                    <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name',$user->name) }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('name')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="email">E-Posta</label>
                    <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email',$user->email) }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('email')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="password">Şifre</label>
                    <input type="password" class="form-control form-control-sm" id="password" name="password" autocomplete="new-password">
                </div>
                <div class="form-group">
                    <label for="role">E-Posta</label>
                    <select name="role" id="role" class="form-control form-control-sm @error('role') is-invalid @enderror">
                        <option value="admin">Admin</option>
                    </select>
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('role')}}</strong></span>
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