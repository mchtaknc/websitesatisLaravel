@extends('admin.layouts.page')

@section('css')
@push('css')
<link rel="stylesheet" href="{{ asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush
@endsection
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Müşteriler</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Anasayfa</a></li>
                <li class="breadcrumb-item active">Müşteriler</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
@endsection
@section('content')
<div class="container-fluid">
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h3 class="card-title">Müşteriler</h3>
            </div>
            <div class="col-md-6">
                <a href="{{ route('admin.customers.create') }}" class="btn btn-sm btn-outline-dark float-right">Yeni Ekle</a>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped display nowrap responsive">
            <thead>
                <tr>
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>Telefon</th>
                    <th>Eklenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->firstname }}</td>
                        <td>{{ $customer->lastname }}</td>
                        <td>{{ $customer->phonenumber }}</td>
                        <td>{{ date('d-m-Y',strtotime($customer->created_at)) }}</td>
                        <td width="80px">
                            <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-success btn-sm" title="Düzenle"><i class="fa fa-edit"></i></a>  
                            <form action="{{ route('admin.customers.destroy',$customer->id) }}" method="post" class="d-inline">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Sil"><i class="fa fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
</div><!-- /.container-fluid -->
@endsection
@section('js')
@push('js')
<script src="{{ asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script>
    $(function(){
        $("#example1").DataTable({
            "language": {
                "url": "{{asset('assets/admin/js/Turkish.json')}}"
            },
        });
    });
</script>
@endpush
@endsection