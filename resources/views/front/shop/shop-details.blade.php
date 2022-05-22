@extends('front.layouts.page')

@section('content')
    @include('front.layouts.partials.headerv2')
    <section class="padding-100-0">
        <div class="container">
            <div class="shop-details">
                @foreach($errors->all() as $error)
                <div class="alert alert-danger"><strong>{{$error}}</strong></div>
                @endforeach
                <h5 class="font-weight-bold mb-3">Kurulum Bilgileri</h5>
                <form class="add_domain" method="post" action="{{ route('product.domain.add', $product_id) }}">
                    @csrf
                    <div class="new-domain">
                        <label class="custom-radio">
                            Kendime ait alan adım var.
                            <input type="radio" class="domainreg" name="installDomain" value="owndomain" checked>
                            <span class="checkmark"></span>
                        </label>
                        <label class="custom-radio">
                            Yeni alan adı kaydetmek istiyorum.
                            <input type="radio" class="domainreg" name="installDomain" value="domainregister">
                            <span class="checkmark"></span>
                        </label>
                        <label class="custom-radio">
                            Alan adımı transfer edeceğim.
                            <input type="radio" class="domainreg" name="installDomain" value="domaintransfer">
                            <span class="checkmark"></span>
                        </label>
                        @if($errors->has('installDomain'))
                        <span class="invalid-feedback d-block mb-3" role="alert"><strong>{{$errors->first('installDomain')}}</strong></span>
                        @endif
                        <div class="input-group">
                            <input type="text" class="form-control domaincontrol @if($errors->has('domain')) is-invalid @endif" name="domain"
                                   placeholder="Örn: alanadiniz.com">
                        </div>
                        @if($errors->has('domain'))
                        <span class="invalid-feedback d-block" role="alert"><strong>{{$errors->first('domain')}}</strong></span>
                        @endif
                        <button type="button" class="btn header-order-button-primary domaincontrolbtn"
                                style="display: none;"><i class="fa fa-search"></i> Kontrol Et
                        </button>
                    </div>
                    <button type="submit" class="btn btn-primary purchasebtn mt-3">SATIN AL</button>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('js')
    @push('js')
        <script>
            $(".domainreg").change(function (e) {
                var val = $(this).val();
                if (val === 'domainregister') {
                    $(".domaincontrolbtn").fadeIn();
                } else {
                    $('.domaincontrol').parent('.input-group').find('span').remove();
                    $(".purchasebtn").removeAttr('disabled');
                    $(".domaincontrolbtn").fadeOut();
                }
            });
            $(".domaincontrolbtn").click(function (e) {
                e.preventDefault();
                var domain = $('.domaincontrol').val();
                $.ajax({
                    url: "{{ route('whois') }}",
                    method: "post",
                    data: {
                        domain: domain
                    },
                    success: function (response) {
                        $(".domaincontrol").parent('.input-group').find('span').remove();
                        var cls = 'text-success d-block w-100';
                        if (response.status == 0 || response.status == -1 || response == '') {
                            cls = 'text-danger d-block w-100';
                            $('.domaincontrol').parent('.input-group').append($('<span/>', {
                                class: cls,
                                text: "Geçersiz alan adı.",
                            }));
                            $(".purchasebtn").attr('disabled',true);
                        }
                        if (response.status == 1 && response.available == false) {
                            cls = 'text-danger d-block w-100';
                            $('.domaincontrol').parent('.input-group').append($('<span/>', {
                                class: cls,
                                text: response.domain + " alan adı kullanımdadır.",
                            }));
                            $(".purchasebtn").attr('disabled',true);
                        }
                        if (response.status == 1 && response.available == true) {
                            $('.domaincontrol').parent('.input-group').append($('<span/>', {
                                class: cls,
                                text: response.domain + " alan adı müsait",
                            }));
                            $(".purchasebtn").removeAttr('disabled');
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
