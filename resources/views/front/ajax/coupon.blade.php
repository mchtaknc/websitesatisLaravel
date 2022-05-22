<li class="list-group-item justify-content-between bg-light coupon-discount d-flex">
     <div class="text-success">
         <h5 class="domain-filter-tab-title">Kupon Kodu <span>indiriminiz</span></h5>
         <small class="code">{{session('coupon.name')}}</small>
     </div>
     <span class="text-success discount">-{{session('coupon.discount')}} TL</span>
</li>