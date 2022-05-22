@extends('front.layouts.page')

@section('content')
@include('front.layouts.partials.headerv2')
<section class="white-gray-border-top" style="padding-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="product-detail-image">
                    <a href="#" data-fancybox="gallery">
                        @if($theme->image->where('featured',1)->first() != '')
                        <img class="img-fluid" src="{{asset('storage/themes/'.$theme->image->where('featured',1)->first()['name'])}}">
                        @elseif($theme->image->where('featured',0)->first() != '')
                        <img class="img-fluid" src="{{asset('storage/themes/'.$theme->image->first()['name'])}}">
                        @else
                        <img class="img-fluid" src="{{asset('assets/front/img/unnamed.png')}}">
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-details">
                    <h4>{{$theme->name}}</h4>
                    @if (!empty(json_decode($theme->featured_specifications,1)))
                        <ul>
                            @foreach (json_decode($theme->featured_specifications,1) as $item)
                                <li><i class="fa fa-clock"></i> {{ $item['value'] }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="product-details-footer">
                        <p>Fiyat: {{$theme->package->price}}</p>
                        <a href="{{ $theme->demo_link }}" class="header-order-button-slid">Demoyu İncele</a>
                        <a href="{{ route('product.addToCart', ['id'=>$theme->package->id,'tema' => $theme->name]) }}" class="header-order-button-primary">Satın Al</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tabs" style="padding-bottom: 100px;">
        <div class="container">
            <ul class="nav mr-tp-70 resslers-features-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="Applications-tab" data-toggle="tab" href="#Applications" role="tab"
                       aria-controls="Applications" aria-selected="true">Detaylar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pay-tab" data-toggle="tab" href="#pay" role="tab"
                       aria-controls="pay" aria-selected="false">Ödeme Yöntemleri</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="Applications" role="tabpanel"
                    aria-labelledby="Applications-tab">
                    <div class="row text-left">
                        <div class="col-md-10 resslers-tabs-content-with-image d-block">
                            <div class="resslers-tabs-content-with-image-text">
                                {!! $theme->description !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pay" role="tabpanel" aria-labelledby="pay-tab">
                    <div class="row">
                        <div class="col-md-10 resslers-tabs-content-with-image d-block">
                            <div class="resslers-tabs-content-with-image-text">
                                <h5>
                                    Banka havalesi ve kredi kartına taksitle ödeme yapabilirsiniz.
                                    <br>
                                    Sipariş sayfasında ödeme tipini seçebilirsiniz.
                                </h5>
                                <div class="pt-5">
                                    <img src="{{ asset('assets/front/img/cards/axess.png')}}" alt="" />
                                    <img src="{{ asset('assets/front/img/cards/bonus.png')}}" alt="" />
                                    <img src="{{ asset('assets/front/img/cards/cardfinans.png')}}" alt="" />
                                    <img src="{{ asset('assets/front/img/cards/maximum.png')}}" alt="" />
                                    <img src="{{ asset('assets/front/img/cards/paraf.png')}}" alt="" />
                                    <img src="{{ asset('assets/front/img/cards/world.png')}}" alt="" />
                                    <img src="{{ asset('assets/front/img/cards/visa.png')}}" alt="" />
                                    <img src="{{ asset('assets/front/img/cards/mastercard.png')}}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
