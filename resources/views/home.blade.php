@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        @if(Auth::user()->hasRole('Pengguna'))
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <a href="#"><i class="fas fa-book"></i></a>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Jumlah Buku Tersedia</h4>
                    </div>
                    <div class="card-body">
                        {{ $book }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <a href="{{ url('user-transactions/list') }}"><i class="fas fa-exchange-alt"></i></a>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Transaksi</h4>
                    </div>
                    <div class="card-body">
                        {{ $transaction }}
                    </div>
                </div>
            </div>
        </div>
        @elseif(Auth::user()->hasRole('Kepala Sekolah'))
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <a href="#"><i class="fas fa-user-friends"></i></a>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Siswa</h4>
                    </div>
                    <div class="card-body">
                        {{ $student }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <a href="#"><i class="fas fa-book"></i></a>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Buku</h4>
                    </div>
                    <div class="card-body">
                        {{ $book }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <a href="#"><i class="fas fa-exchange-alt"></i></a>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Transaksi Tahun Ini</h4>
                    </div>
                    <div class="card-body">
                        {{ $transaction }}
                    </div>
                </div>
            </div>
        </div>
        @elseif(Auth::user()->hasRole('Admin'))
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <a href="{{ url('users/') }}"><i class="far fa-user"></i></a>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Pengguna</h4>
                    </div>
                    <div class="card-body">
                        {{ $user }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <a href="{{ url('students/') }}"><i class="fas fa-user-friends"></i></a>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Siswa</h4>
                    </div>
                    <div class="card-body">
                        {{ $student }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <a href="{{ url('books/') }}"><i class="fas fa-book"></i></a>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Buku</h4>
                    </div>
                    <div class="card-body">
                        {{ $book }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <a href="{{ url('transactions/') }}"><i class="fas fa-exchange-alt"></i></a>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Transaksi Tahun Ini</h4>
                    </div>
                    <div class="card-body">
                        {{ $transaction }}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
