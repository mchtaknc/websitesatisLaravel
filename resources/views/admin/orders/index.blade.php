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
            <h1 class="m-0">Siparişler</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Anasayfa</a></li>
                <li class="breadcrumb-item active">Siparişler</li>
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
                    <h3 class="card-title">Siparişler</h3>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('admin.orders.create') }}" class="btn btn-sm btn-outline-dark float-right">Yeni
                        Ekle</a>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered  display nowrap responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sipariş No</th>
                        <th>Müşteri Adı</th>
                        <th>Fiyat</th>
                        <th>Durum</th>
                        <th>Sipariş Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
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
    function format ( d ) {
    // `d` is the original data object for the row
    return '<table width="100%">'+
        '<tr>'+
            '<td>Ödeme Metodu:</td>'+
            '<td>'+d.payment_method+'</td>'+
            '</tr>'+
        '<tr>'+
        '<tr>'+
            '<td>Alan Adları:</td>'+
            '<td>'+d.domain+'</td>'+
            '</tr>'+
        '<tr>'+
            '<td>Paket - Tema</td>'+
            '<td>'+d.package+'</td>'+
            '</tr>'+
        '</table>';
    }
    $(function(){
        var table = $("#example1").DataTable({
            order: [],
            language: {
                "url": "{{asset('assets/admin/js/Turkish.json')}}"
            },
            pageLength: 25,
            responsive: true,
            processing: true,
            info: true,
            ajax: {
                url: "{{route('admin.orders.list')}}",
                type: "POST",
            },
            deferRender: true,
            columns: [
                {
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": ''
                },
                {
                    data: 'order_no'
                },
                {
                    data: 'customer'
                },
                {
                    data: 'price'
                },
                {
                    data: 'status'
                },
                {
                    data: 'order_date',
                },
                {
                    data: 'islemler',
                    orderable: false
                }
            ],
            columnDefs: [
                {
                    targets: -1,
                    title: 'İşlemler',
                    render: function(data, type, full, meta) {
                        var url = '{{route("admin.orders.edit",":id")}}';
                        url = url.replace(':id',data);
                        return '<a href="'+url+'" class="btn btn-sm btn-clean btn-icon btn-success btn-icon-sm edit" title="Düzenle"><i class="fa fa-edit"></i></a>';
                    }
                },
            ],
        });
        $('#example1 tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
            }
        });
    });
</script>
@endpush
@endsection
