@extends('front.layouts.page')

@section('content')
@include('front.layouts.partials.headerv2')
<section class="padding-100-0">
    <div class="container">
        <div class="succec-domain-search-mesage">
            BANKA HAVALESİ
        </div>
        <div class="row mr-tp-40 justify-content-left">
            <div class="col-md-12">
                <p class="alert alert-success">Siparişiniz başarıyla alınmıştır. Mevcut ödemeniz gereken tutar. {{ $totalPrice }} TL'dir. Ödemenizi aşağıdaki banka hesap bilgilerinden gerçekleştirebilirsiniz.</p>
            </div>
        </div>
    </div>
</section>
@endsection