@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Denda</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ url('transactions/') }}">Transaksi</a></div>
            <div class="breadcrumb-item active"><a href="{{ url('transactions/denda') }}">Denda</a></div>
        </div>
    </div>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>List Denda Aktif</h4>
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
                                <th scope="col">Batas Kembali</th>
                                <th scope="col">Tanggal Pengembalian</th>
                                <th scope="col">Nominal Denda</th>
                                <th scope="col" style="width:7%"></th>
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
                                        <td>{{ $data->date_return->format('d-m-Y') }}</td>
                                        <td><b style="color:red;">{{ $data->date_returned->format('d-m-Y') }}</b></td>
                                        <td>Rp 20,000</td>
                                        <td>
                                            <a href="{{ url('transactions/denda/'.$data->id) }}" class="btn btn-sm btn-success">Bayar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="9"><em>@lang('Tidak ada data.')</em></td>
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
