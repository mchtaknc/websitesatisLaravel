@extends('admin.layouts.page')
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Sipariş Düzenle</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Anasayfa</a></li>
                <li class="breadcrumb-item active">Sipariş Düzenle</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
@endsection
@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Sipariş Düzenle</h3>
        </div>
        <!-- /.card-header -->
        <form role="form" autocomplete="off" action="{{ route('admin.orders.update', $order->id) }}" method="post"
            autocomplete="off">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="customer">Müşteri</label>
                    <select class="form-control form-control-sm @error('customer') is-invalid @enderror"
                        name="customer">
                        <option value="">Seçiniz...</option>
                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}" {{ old('customer',$order->customer_id) ==  $customer->id ? 'selected' : null }}>
                            {{ $customer->firstname.' '.$customer->lastname }}</option>
                        @endforeach
                    </select>
                    <span class="invalid-feedback" role="alert"><strong>{{$errors->first('customer')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="order_status">Durum</label>
                    <select class="form-control form-control-sm @error('order_status') is-invalid @enderror"
                        name="order_status">
                        <option value="">Seçiniz...</option>
                        <option value="SUCCESS" {{$order->status == 'SUCCESS' ? 'selected' : null}}>Başarılı</option>
                        <option value="waiting" {{$order->status == 'waiting' ? 'selected' : null}}>Ödeme Bekliyor</option>
                        <option value="FAILURE" {{$order->status == 'FAILURE' ? 'selected' : null}}>Başarısız</option>
                    </select>
                    <span class="invalid-feedback"
                        role="alert"><strong>{{$errors->first('order_status')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="order_payment_method">Ödeme Yöntemi</label>
                    <select class="form-control form-control-sm @error('order_payment_method') is-invalid @enderror"
                        name="order_payment_method">
                        <option value="">Seçiniz...</option>
                        <option value="bank_transfer" {{$order->payment_method == 'bank_transfer' ? 'selected' : null}}>Banka Havalesi</option>
                        <option value="credit_card" {{$order->payment_method == 'credit_card' ? 'selected' : null}}>Kredi Kartı</option>
                    </select>
                    <span class="invalid-feedback"
                        role="alert"><strong>{{$errors->first('order_payment_method')}}</strong></span>
                </div>
                <div class="form-group">
                    <label for="order_price">Ücret <small>KDV dahil fiyat giriniz.</small></label>
                    <input type="text" class="form-control form-control-sm @error('order_price') is-invalid @enderror"
                        id="order_price" name="order_price" value="{{ old('order_price',$order->total) }}" placeholder="0.00">
                    <span class="invalid-feedback"
                        role="alert"><strong>{{$errors->first('order_price')}}</strong></span>
                </div>
                <div class="form-group">
                    <div class="products">
                        @foreach ($order->orderProducts as $item)
                        <div class="product">
                            <table class="form table table-bordered" style="width: 300px">
                                <tr>
                                    <td>Ürün\Hizmet</td>
                                    <td>
                                        {{$item->package->name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alan Adı</td>
                                    <td>
                                        {{$item->domain}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Adet</td>
                                    <td>
                                        {{$item->item_quantity}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        @endforeach
                    </div>
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
    $("#order_price").inputmask({
        alias: 'currency',
        rightAlign: false,
    });
</script>
@endpush
@endsection
