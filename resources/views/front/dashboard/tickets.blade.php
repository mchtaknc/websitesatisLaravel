@extends('front.dashboard')
@section('dashboard-content')
<div class="tickets nuhost-filter-list-container">
    <div class="tickets-head">
        <h5>Destek Taleplerim</h5>
        <a href="{{route('ticket.create')}}"><i class="fa fa-plus"></i> Yeni Talep Oluştur</a>
    </div>
    <table class="datatable table table-hover table-bordered" style="width:100%">
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
    $(document).ready( function () {
        var table = $('.datatable').DataTable({
            language:{
                url:"{{ asset('assets/front/js/Turkish.json') }}"
            },
            order: [[4,'desc']],
            lengthChange: false,
            responsive: true,
            processing: true,
            serverSide: true,
            info: true,
            pageLength: 25,
            ajax: {
                url: "{{route('tickets')}}",
                type: "POST",
                dataType: "json",
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
