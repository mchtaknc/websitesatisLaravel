@extends('front.layouts.page')

@section('content')
@include('front.layouts.partials.headerv2')
<section class="padding-100-0">
    <div class="container">
        <div class="succec-domain-search-mesage">
            SEPETİM
        </div>
        @if (Session::has('cart'))
        <div class="row mr-tp-40 justify-content-left">
            <div class="col-md-8">
                <div class="dedicated-container table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="dedicated-head">
                                <th scope="col"><span>Ürün Adı</span></th>
                                <th scope="col"><span>Adet</span></th>
                                <th scope="col"><span>Birim Fiyat</span></th>
                                <th scope="col"><span>Toplam Fiyat</span></th>
                                <th scope="col"><span>İşlem</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($products as $product)
                            <tr>
                                <td>
                                    <span class="plan-num">{{ $i }}</span> {{$product['item']['name']}}<br>
                                    <span class="font-weight-light"><b class="font-weight-bold">Alan Adı:</b> {{$product['domain']['domain'] ?? ""}}</span><br>
                                    <span class="font-weight-light"><b class="font-weight-bold">Tema:</b> {{$product['theme']}}</span>
                                </td>
                                <td><span>x1</span></td>
                                <td>{{$product['item']['price']}} TL</td>
                                <td>{{$product['price']}} TL</td>
                                <td>
                                    <a href="{{ route('product.removeCart',$product['item']['id']) }}" class="btn btn-sm btn-light remove-item" data-item="{{ $product['item']['id'] }}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @php
                            $i++;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="list-group mb-3 search-box-filter-domains">
                    @include('front.ajax.totalprice ')
                    @if(Session::has('coupon'))
                    @include('front.ajax.coupon')
                    @endif
                </ul>
                <form method="post" class="card search-box-filter-domains-promo">
                    <div class="input-group">
                        <input type="text" class="form-control" name="code" placeholder="Kupon Kodu">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Kodu Kullan</button>
                        </div>
                    </div>
                </form>
                <form class="text-right" action="{{route('product.checkout.show')}}">
                    <button type="submit" class="btn btn-success mt-3">Alışverişi Tamamla</button>
                </form>
            </div>
        </div>
        @else
        <div class="dedicated-container table-responsive">
            <table class="table ">
                <thead>
                    <tr class="dedicated-head">
                        <th scope="col"><span>Ürün Adı</span></th>
                        <th scope="col"><span>Adet</span></th>
                        <th scope="col"><span>Birim Fiyat</span></th>
                        <th scope="col"><span>Toplam Fiyat</span></th>
                        <th scope="col"><span>İşlem</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="5">Sepetinizde hiç ürün bulunmamaktadır.</td>
                    </tr>
                </tbody>
            </table>

        </div>
        @endif
    </div>
</section>
@endsection
@section('js')
@push('js')
@if(session('success'))
<script>
    swal.fire('Başarılı',"{{session('success')}}",'success');
</script>
@elseif(session('errors'))
<script>
    swal.fire("Hata","{{session('errors')->first('hata')}}","error");
</script>
@endif
@if(session()->has('cart'))
<script>
    function updateTotalPrice() {
        $.get("{{route('product.updateTotalPrice')}}",function(data){
            $(".search-box-filter-domains").html(data);
        });
    }
    $(function(){
        $(".search-box-filter-domains-promo").submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "{{route('product.attachcoupon')}}",
                method:"post",
                dataType: "json",
                data: formData,
                success: function(response) {
                    $(".search-box-filter-domains").html(response.total);
                    $(".search-box-filter-domains").append(response.html);
                },
                error: function(response) {
                    if(!response.responseJSON.coupon) {
                        $(".search-box-filter-domains li").not(':first').remove();
                        updateTotalPrice();
                    }
                    swal.fire('Hata',response.responseJSON.message,'error');
                }
            }).complete(function(){
                $(".search-box-filter-domains-promo input").val("");
            });
        });
    });
</script>
@endif
@endpush
@endsection