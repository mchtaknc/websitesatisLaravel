@extends('front.dashboard')
@section('dashboard-content')
<div class="mb-3 orders nuhost-filter-list-container">
    <h5>Son Siparişlerim</h5>
    <table class="datatable table table-hover table-bordered" style="width:100%">
        <thead>
            <th></th>
            <th>Sipariş No</th>
            <th>Fiyat</th>
            <th>Durum</th>
            <th>Sipariş Tarihi</th>
        </thead>
    </table>
</div>
<div class="mb-3 tickets nuhost-filter-list-container">
    <div class="tickets-head">
        <h5>Son Destek Taleplerim</h5>
        <a href="{{route('ticket.create')}}"><i class="fa fa-plus"></i> Yeni Talep Oluştur</a>
    </div>
    <table class="tickets-table table table-hover table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Talep ID</th>
                <th>Konu</th>
                <th>Durum</th>
                <th>Oluşturan</th>
                <th>Oluşturulma Tarihi</th>
                <th></th>
            </tr>
        </thead>
    </table>
</div>
@endsection
@section('js')
@push('js')
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
    $(document).ready( function () {
        var table = $('.datatable').DataTable({
            order: [4,'desc'],
            language:{
                url:"{{ asset('assets/front/js/Turkish.json') }}"
            },
            lengthChange: false,
            pageLength: 10,
            responsive: true,
            processing: true,
            info: true,
            ajax: {
                url: "{{route('orders')}}",
                type: "POST",
                data: {
                    last_order: true
                }
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
                    data: 'price'
                },
                {
                    data: 'status'
                },
                {
                    data: 'order_date',
                }
            ],
        });

        $('.datatable tbody').on('click', 'td.details-control', function () {
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

        var ticketsTable = $('.tickets-table').DataTable({
            language:{
                url:"{{ asset('assets/front/js/Turkish.json') }}"
            },
            order: [[4,'desc']],
            lengthChange: false,
            responsive: true,
            processing: true,
            serverSide: true,
            info: true,
            pageLength: 10,
            ajax: {
                url: "{{route('tickets')}}",
                type: "POST",
                dataType: "json",
                data: {
                    last_order: true
                }
            },
            columnDefs: [
                {
                    targets: [5],
                    orderable: false
                }
            ],
        });
    });
</script>
@endpush
@endsection
