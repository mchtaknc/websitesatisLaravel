@extends('admin.layouts.page')
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Tema Kategorisi Ekle</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Anasayfa</a></li>
                <li class="breadcrumb-item active">Tema Kategorisi Ekle</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tema Kategorisi Ekle</h3>
        </div>
        <!-- /.card-header -->
        <form role="form" autocomplete="off" action="{{ route('admin.themes.category.store') }}" method="post">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Kategori Adı</label>
                    <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('name')}}</strong></span>
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