<li class="list-group-item d-flex justify-content-between lh-condensed">
    <div class="padding-domain-filter">
        <h5 class="domain-filter-tab-title">SİPARİŞ DETAYI</h5>
        <div class="form-price-sujjestion-domain totalPrice">
            @if (Session::has('coupon'))
            <span><b>Ara Toplam:</b> {{ session('cart')->totalPrice }} TL</span>
            <span><b>KDV 18%:</b> {{ (session('cart')->taxPrice) }} TL</span>
            <span><b>Toplam:</b> {{ (session('cart')->taxTotal - session('coupon.discount')) }} TL</span>
            @else
            <span><b>Ara Toplam:</b> {{ session('cart')->totalPrice }} TL</span>
            <span><b>KDV 18%:</b> {{ session('cart')->taxPrice }} TL</span>
            <span><b>Toplam:</b> {{ session('cart')->taxTotal }} TL</span>
            @endif
        </div>
    </div>
</li>