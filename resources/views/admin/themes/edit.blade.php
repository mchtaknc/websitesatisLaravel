@extends('admin.layouts.page')
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Tema Düzenle</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Anasayfa</a></li>
                <li class="breadcrumb-item active">Tema Düzenle</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tema Düzenle</h3>
        </div>
        <!-- /.card-header -->
        <form role="form" autocomplete="off" action="{{ route('admin.themes.update',$theme->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="category">Tema Kategorisi</label>
                    <select class="form-control form-control-sm @error('category') is-invalid @enderror"
                        name="category">
                        <option value="">Seçiniz...</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category',$theme->category->id) ==  $category->id ? 'selected' : null }}>
                            {{ $category->name }}</option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('category')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="package">Temanın Bağlı Olduğu Paket</label>
                    <select class="form-control form-control-sm @error('package') is-invalid @enderror" name="package">
                        <option value="">Seçiniz...</option>
                        @foreach ($packages as $package)
                        <option value="{{ $package->id }}" {{ old('package',$theme->package->id) ==  $package->id ? 'selected' : null }}>
                            {{ $package->name }}</option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('package')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="name">Tema Adı</label>
                    <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                        id="name" name="name" value="{{ old('name',$theme->name) }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('name')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="description">Tema Açıklaması</label>
                    <textarea class="form-control form-control-sm @error('description') is-invalid @enderror"
                        id="description" name="description">
                    {{ old('description',$theme->description) }}
                    </textarea>
                    <span class="invalid-feedback"
                        role="alert"><strong>{{$errors->first('description')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="description">Tema Öne Çıkan Özellikleri</label>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="theme-specs">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control form-control-sm theme-spec @error('theme-spec') is-invalid @enderror">
                                    <div class="input-group-append">
                                        <span class="input-group-text btn btn-success add"><i class="fa fa-plus"></i></span>
                                    </div>
                                    <div class="check">
                                        @if(old('featured_specifications',$theme->featured_specifications) != null)
                                        @php
                                        $specs = json_decode(old('featured_specifications', $theme->featured_specifications),1);
                                        @endphp
                                        @foreach ($specs as $item)
                                        <span>{{$item['value']}}<i class="fa fa-trash-alt float-right remove-spec"></i></span>
                                        @endforeach
                                        @endif
                                        <input type="hidden" name="featured_specifications" class="spec-input"
                                            value="{{old('featured_specifications',$theme->featured_specifications)}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tema Resimleri</label>
                    <div class="theme-images">
                        @foreach ($theme->image as $item)
                        <div class="theme-image">
                            <img src="{{ asset('storage/themes/'.$item->name)}}" width="150px">
                            <div class="control" data-id="{{ $item->id }}">
                                @if($item->featured == 0)
                                <a href="javascript:;" class="featured_image"><i class="fa fa-home"></i></a>
                                @endif
                                <a href="javascript:;" class="remove_image"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label for="images">Tema Resimleri</label>
                    <div class="input-group input-group-sm image-section">
                        <input type="file" name="file[]" class="form-control" style="padding: 1px 1px;">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-success add-image"><i class="fa fa-plus"></i> Ekle</button>
                        </div>
                    </div>
                    <div class="inputs"></div>
                </div>
                <div class="form-group">
                    <label for="demo_link">Demo Linki</label>
                    <input type="text" class="form-control form-control-sm @error('demo_link') is-invalid @enderror"
                        id="demo_link" name="demo_link" value="{{ old('demo_link',$theme->demo_link) }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('demo_link')}}</strong></span>
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
<script src="https://cdn.tiny.cloud/1/1y1ni83c3alyaritwrn46z182ghs9imuyys00avqyq3n8qis/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector:'textarea',
        plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinymcespellchecker',
        toolbar_mode: 'floating',
    });
    var array = [];
    if ($(".spec-input").val().length > 3) {
        array = JSON.parse($(".spec-input").val());
    }
    $('.theme-specs .add').click(function(){
        if($('.theme-spec').val().length > 3) {
            var value = $('.theme-spec').val();
            var span = document.createElement('span');
            span.innerHTML = value+' <i class="fa fa-trash-alt float-right remove-spec"></i>'
            array.push({'value':value});
            $('.check').append(span);
            $('.theme-spec').val('');
        }
    });
    $(document).on('click','.remove-spec',function(){
        var value = $(this).parent().text();
        var index = array.map(function (element) { return element.value; }).indexOf(value.trim());
        if (index > -1) {
            array.splice(index, 1);
        }
        $(this).parent().remove();
    });
    $("form").submit(function(){
        if(array.length > 0) {
            $(".spec-input").val(JSON.stringify(array));
        }
    });
    $(".add-image").click(function(){
        var imageInput = $(this).parent().parent().clone();
        $(imageInput).addClass('mt-2');
        $(imageInput).find('button').removeClass('btn-success').addClass('btn-danger').removeClass('add-image').addClass('remove-image').text('');
        $(imageInput).find('button').append('<i class="fa fa-trash"></i> Sil');
        $(".inputs").append(imageInput);
        $(".input-group input").last().val('');
        $(".input-group input").last().focus();
    });
    $('.inputs').on('click','.remove-image',function(){
        $(this).parent().parent().remove();
        $(".input-group input").last().focus();
    });
    $('form').on('click','.featured_image',function(e){
        e.preventDefault();
        var image_id = $(this).parent().data('id');
        var $el = $(this);
        $.ajax({
            url: "{{ route('admin.theme_image.featured') }}",
            dataType: "json",
            method: "post",
            data: {
                image_id : image_id,
                theme_id : "{{ $theme->id }}"
            },
            success: function(response){
                var $clone = $el.clone();
                $(".control").each(function(key,value){
                    if($(this).find('.featured_image').length == 0) {
                        $(".remove_image",this).before($clone);
                    }
                });
                $el.remove();
            },
            error: function(response) {
                toastr.error(response.responseJSON.message);
            }
        });
    });
    $('form').on('click','.remove_image',function(e){
        var $el = $(this);
        var image_id = $(this).parent().data('id');
        e.preventDefault();
        $.ajax({
            url: "{{ route('admin.theme_image.remove') }}",
            method: "post",
            dataType:"json",
            data: {
                image_id : image_id
            },
            success: function(response) {
                toastr.success(response.message);
                $el.parent().parent().remove();
            },
            error: function(response) {
                toastr.error(response.responseJSON.message);
            }
        });
    });
</script>
@endpush
@endsection