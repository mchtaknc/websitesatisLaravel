@extends('admin.layouts.page')
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Sipariş Ekle</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Anasayfa</a></li>
                <li class="breadcrumb-item active">Sipariş Ekle</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sipariş Ekle</h3>
        </div>
        <!-- /.card-header -->
        <form role="form" autocomplete="off" action="{{ route('admin.orders.store') }}" method="post" autocomplete="off">
            @csrf
            @method('POST')
            <div class="card-body">
                <div class="form-group">
                    <label for="customer">Müşteri</label>
                    <select class="form-control form-control-sm @error('customer') is-invalid @enderror" name="customer">
                        <option value="">Seçiniz...</option>
                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer') ==  $customer->id ? 'selected' : null }}>
                            {{ $customer->firstname.' '.$customer->lastname }}</option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('customer')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="order_status">Durum</label>
                    <select class="form-control form-control-sm @error('order_status') is-invalid @enderror" name="order_status">
                        <option value="">Seçiniz...</option>
                        <option value="SUCCESS">Başarılı</option>
                        <option value="waiting">Ödeme Bekliyor</option>
                        <option value="FAILURE">Başarısız</option>
                    </select>
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('order_status')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="order_payment_method">Ödeme Yöntemi</label>
                    <select class="form-control form-control-sm @error('order_payment_method') is-invalid @enderror" name="order_payment_method">
                        <option value="">Seçiniz...</option>
                        <option value="bank_transfer">Banka Havalesi</option>
                        <option value="credit_card">Kredi Kartı</option>
                    </select>
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('order_payment_method')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="order_price">Ücret <small>KDV dahil fiyat giriniz.</small></label>
                    <input type="text" class="form-control form-control-sm @error('order_price') is-invalid @enderror" id="order_price" name="order_price"
                        value="{{ old('order_price') }}" placeholder="0.00">
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('order_price')}}</strong></span>
                </div>
                <div class="form-group">
                    <div class="products">
                        <div class="product">
                            <table class="form table-bordered" style="width:500px">
                                <tr>
                                    <td>Ürün\Hizmet</td>
                                    <td>
                                        <select class="form-control form-control-sm productprice @error('order_packages.*') is-invalid @enderror"
                                            name="order_packages[]">
                                            <option value="">Seçiniz...</option>
                                            @foreach ($packages as $package)
                                            <option value="{{ $package->id }}"
                                                {{ old('order_packages[]') ==  $package->id ? 'selected' : null }}>
                                                {{ $package->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{$errors->first('order_packages.*')}}</strong></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alan Adı</td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm @error('order_domain.*') is-invalid @enderror" name="order_domain[]">
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{$errors->first('order_domain.*')}}</strong></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Adet</td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm @error('order_qty.*') is-invalid @enderror" name="order_qty[]">
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{$errors->first('order_qty.*')}}</strong></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-flat btn-light addproduct"><i class="fa fa-plus-circle"></i> Başka Hizmet Ekle</button>
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
<script>
    //Çoklu seçimlerde çalışacak şekilde tekrar düzenlenmesi lazım hesaplama fonksiyonunun.
    $(document).on('change','.productprice',function(){
        var val = $(this).val();
        var temp = 0;
        var total = 0;
        if(val != '') {
            $.ajax({
                url : "{{route('admin.package.price')}}",
                method: "post",
                dataType: "json",
                data: {
                    package: val
                },
                success: function(response) {
                    temp = Number(response);
                    total += Number(temp);
                    $("#order_price").val(total);
                },
            });
        } else {
            $("#order_price").val(total);
        }
    });
    $(".addproduct").click(function(){
        var prodtemplate = $(".products .product:first").clone();
        var order = prodtemplate.appendTo('.products');
    });
    $("#order_price").inputmask({
        alias: 'currency',
        rightAlign: false,
    });
</script>
@endpush
@endsection
