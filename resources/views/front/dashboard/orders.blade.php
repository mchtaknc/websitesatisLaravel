@extends('front.dashboard')
@section('dashboard-content')
<div class="nuhost-filter-list-container">
    <h5 class="font-weight-bold pb-2" style="border-bottom: 1px solid #ddd">Siparişlerim</h5>
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
            pageLength: 25,
            responsive: true,
            processing: true,
            info: true,
            ajax: {
                url: "{{route('orders')}}",
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
    });
</script>
@endpush
@endsection
