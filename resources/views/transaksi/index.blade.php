@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Transaksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ url('transactions/') }}">Transaksi</a></div>
        </div>
    </div>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>List Transaksi Peminjaman Berjalan</h4>
                <div class="card-header-button">
                    <a href="{{ url('transactions/create') }}" class="btn btn-lg btn-icon icon-left btn-primary" style="border-radius: 5px !important;"><i class="fas fa-plus-circle"></i> Transaksi Baru</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless table-md">
                        <thead>
                            <tr>
                                <th scope="col" style="width:3%">#</th>
                                <th scope="col">Nomor Peminjaman</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Peminjam</th>
                                <th scope="col">Tanggal Pinjam</th>
                                <th scope="col">Tanggal Pengembalian</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="width:22%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($datas))
                                @foreach ($datas as $data)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $data->transaction_id }}</td>
                                        <td>{{ $data->bookInformation->title }}</td>
                                        <td>{{ $data->studentInformation->name }}</td>
                                        <td>{{ $data->date_start->format('d-m-Y') }}</td>
                                        @if ($data->date_returned)
                                            <td>{{ $data->date_returned->format('d-m-Y') }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>
                                            @if ($data->status == 'aktif')
                                                <div class="badge badge-info">{{ ucfirst($data->status) }}</div></td>
                                            @elseif ($data->status == 'selesai')
                                                <div class="badge badge-success">{{ ucfirst($data->status) }}</div></td>
                                            @else
                                                <div class="badge badge-danger">{{ ucfirst($data->status) }}</div></td>
                                            @endif
                                        <td>
                                            @if ($data->status == 'aktif')
                                                <a href="{{ url('transactions/'.$data->id.'/return') }}" class="btn btn-sm btn-success">Pengembalian</a>&#9;
                                                <a href="{{ url('transactions/'.$data->id.'/edit') }}" class="btn btn-sm btn-info">Edit</a>&#9;
                                            @else
                                                <a href="{{ url('transactions/'.$data->id.'/cancel') }}" class="btn btn-sm btn-warning">Cancel</a>&#9;
                                            @endif
                                            <a href="{{ url('transactions/'.$data->id.'/destroy') }}" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
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
