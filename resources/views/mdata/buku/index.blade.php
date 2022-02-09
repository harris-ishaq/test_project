@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Buku</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ url('books/') }}">buku</a></div>
        </div>
    </div>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>List Buku</h4>
                <div class="card-header-form mr-3">
                    <form action="{{ url('books/search') }}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" name="title" placeholder="Cari buku">
                            <div class="input-group-btn">
                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-header-button">
                    <a href="{{ url('books/create') }}" class="btn btn-lg btn-icon icon-left btn-primary" style="border-radius: 5px !important;"><i class="fas fa-plus-square"></i> Tambah Buku</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless table-md">
                        <thead>
                            <tr>
                                <th scope="col" style="width:5%">#</th>
                                <th scope="col">Kode Buku</th>
                                <th scope="col">No. ISBN</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Penulis</th>
                                <th scope="col">Penerbit</th>
                                <th scope="col">Tahun Terbit</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Tanggal Masuk</th>
                                <th scope="col" style="width:15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($datas))
                                @foreach ($datas as $data)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $data->code_book }}</td>
                                        <td>{{ $data->isbn }}</td>
                                        <td>{{ $data->title }}</td>
                                        <td>{{ $data->author }}</td>
                                        <td>{{ $data->publisher }}</td>
                                        <td>{{ $data->year }}</td>
                                        <td>{{ $data->qty }}</td>
                                        <td>{{ $data->entry_date}}</td>
                                        <td><a href="{{ url('books/'.$data->id.'/edit') }}" class="btn btn-info">Edit</a>&#9;<a href="{{ url('books/'.$data->id.'/destroy') }}" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8"><em>@lang('Tidak ada data.')</em></td>
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
