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
            <h1 class="m-0">Kullanıcılar</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin') }}">Anasayfa</a></li>
                <li class="breadcrumb-item active">Kullanıcılar</li>
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
                <h3 class="card-title">Kullanıcılar</h3>
            </div>
            <div class="col-md-6">
                <a href="{{ route('admin.users.create') }}" class="btn btn-sm btn-outline-dark float-right">Yeni Ekle</a>
            </div>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped display nowrap responsive">
            <thead>
                <tr>
                    <th>İsim</th>
                    <th>Rol</th>
                    <th>E-Posta</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->email }}</td>
                        <td width="80px">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-success btn-sm" title="Düzenle"><i class="fa fa-edit"></i></a>  
                            <form action="{{ route('admin.users.destroy',$user->id) }}" method="post" class="d-inline">
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