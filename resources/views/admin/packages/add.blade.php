@extends('admin.layouts.page')
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Paket Ekle</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Anasayfa</a></li>
                <li class="breadcrumb-item active">Paket Ekle</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Paket Ekle</h3>
        </div>
        <!-- /.card-header -->
        <form role="form" autocomplete="off" action="{{ route('admin.packages.store') }}" method="post" autocomplete="off">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Paket Adı</label>
                    <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('name')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="description">Paket Açıklaması</label>
                    <input type="text" class="form-control form-control-sm @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('description')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="description">Paket Özellikleri</label>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="specifications">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm specification @error('specifications') is-invalid @enderror">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn btn-success checked" title="Olan Özellik"><i class="fa fa-check"></i> </span>
                                        <span class="input-group-text btn btn-danger not-checked" title="Olmayan Özellik"><i class="fa fa-times"></i> </span>
                                        <span class="input-group-text btn btn-warning optional" title="Opsiyonel"><i class="fa fa-circle"></i> </span>
                                    </div>
                                    <div class="check">
                                        @if(old('specifications') != null)
                                        @php
                                            $specs = json_decode(old('specifications'),1);
                                        @endphp
                                        @foreach ($specs as $item)
                                        <span>{{$item['value']}} <i class="@if($item['status'] === 'checked') fa fa-check @elseif($item['status'] === 'not-checked') fa fa-times @else fa fa-circle @endif"></i> <i class="fa fa-trash-alt float-right remove-spec"></i></span>
                                        @endforeach
                                        @endif
                                        <input type="hidden" name="specifications" class="spec-input" value="{{old('specifications')}}">
                                    </div>
                                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('specifications')}}</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price">Paket Fiyatı</label>
                    <input type="text" class="form-control form-control-sm @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('price')}}</strong></span>
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
@section('js')
@push('js')
<script src="{{asset('assets/admin/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="{{ asset('assets/admin/js/custom.js') }}"></script>
<script>
    $("#price").inputmask({
        alias: 'currency',
        rightAlign: false,
    });
</script>
@endpush
@endsection