@extends('front.dashboard')
@section('dashboard-content')
<div class="tickets nuhost-filter-list-container">
    <div class="tickets-head">
        <h5>Yeni Talep Oluştur</h5>
    </div>
    <form class="custom-form mt-4" action="{{route('ticket.store')}}" method="post">
        @csrf
        @method('POST')
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="form-row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-label-form-sm">Konu</label>
                    <input type="text" class="form-control form-control-sm @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('subject')}}</strong></span>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="col-label-form-sm">Mesaj</label>
                    <textarea cols="5" rows="10" class="form-control form-control-sm @error('message') is-invalid @enderror" name="message">{{ old('message') }}</textarea>
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('message')}}</strong></span>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-sm">Kaydet</button>
    </form>
</div>
@endsection
