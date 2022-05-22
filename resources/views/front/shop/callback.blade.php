@extends('front.layouts.page')

@section('content')
@include('front.layouts.partials.headerv2')
<section class="padding-100-0">
    <div class="container">
        <div class="succec-domain-search-mesage">
            İŞLEM SONUCU
        </div>
        <div class="row mr-tp-40 justify-content-left">
            <div class="col-md-12">
                @if($paymentStatus == 'SUCCESS')
                <p class="alert alert-success">Ödemeniz başarıyla alınmıştır. Siparişiniz oluşturulmuştur.</p>
                @elseif($paymentStatus == 'FAILURE')
                <p class="alert alert-danger">Ödeme başarısız. İşlem yapılırken bir hata meydana geldi. Hata: {{ $error . ': ' . $errorMessage}}</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection