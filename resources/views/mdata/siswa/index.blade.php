@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Siswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ url('students/') }}">Siswa</a></div>
        </div>
    </div>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>List Siswa</h4>
                <div class="card-header-form mr-3">
                    <form action="{{ url('students/search') }}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="name" placeholder="Cari siswa">
                            <div class="input-group-btn">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-header-button">
                    <a href="{{ url('students/create') }}" class="btn btn-lg btn-icon icon-left btn-primary" style="border-radius: 5px !important;"><i class="fas fa-user-plus"></i> Tambah Siswa</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless table-md">
                        <thead>
                            <tr>
                                <th scope="col" style="width:5%">#</th>
                                <th scope="col">Nomor Induk Siswa</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col" style="width:15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($datas))
                                @foreach ($datas as $data)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $data->nis }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->class }}</td>
                                        <td>{{ $data->gender }}</td>
                                        <td>
                                            <a href="{{ url('students/'.$data->id.'/edit') }}" class="btn btn-sm btn-info">Edit</a>&#9;
                                            <a href="{{ url('students/'.$data->id.'/destroy') }}" class="btn btn-sm btn-danger">Delete</a>&#9;
                                            <!-- <a href="{{ url('students/'.$data->id.'/add-as-users') }}" class="btn btn-sm btn-success">Tambah Sebagai Pengguna</a> -->
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5"><em>@lang('Tidak ada data.')</em></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-center">
                {{ $datas->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</section>
@stop

@section('scripts')
    <script src="{{ asset(('stisla/node_modules/jquery-ui-dist/jquery-ui.min.js')) }}"></script>
@endsection
