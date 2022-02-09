@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset(('stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css')) }}">
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Buku</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('books/') }}">Buku</a></div>
            @if ($edit)
                <div class="breadcrumb-item active"><a href="#">Ubah Data Buku</a></div>
            @else
                <div class="breadcrumb-item active"><a href="#">Tambah Buku</a></div>
            @endif
        </div>
    </div>
    <div class="section-body">
        <div class="row ">
            <div class="col-12 col-md- col-lg-12">
                <div class="card">
                    <div class="card-header">
                    @if ($edit)
                        <h4>Ubah Data Buku</h4>
                    @else
                        <h4>Input Data Buku</h4>
                    @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="card-title">
                                    <h5>
                                        <strong>
                                            @lang('Form Data Buku')
                                        </strong>
                                    </h5>
                                    <p class="card-lead" style="font-size: 14px;">
                                        @if ($edit)
                                            @lang('Pilih field data pengguna yang ingin dirubah.')
                                        @else
                                            @lang('Isikan data - data yang diperlukan untuk menambahkan data buku baru.')
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                @if ($edit)
                                    <form action="{{ url('books/'.$data->id) }}" method="post">
                                    @method('PUT')
                                @else
                                    <form action="{{ url('books/store') }}" method="post">
                                @endif
                                    @csrf
                                    <div class="form-group">
                                        <label>Kode Buku</label>
                                        <input type="text" name="code_book" class="form-control @error('code_book') is-invalid @enderror"
                                            value="{{ $edit ? $data->code_book : old('code_book') }}">
                                        @error('code_book')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>No. ISBN</label>
                                        <input type="text" name="isbn" class="form-control @error('isbn') is-invalid @enderror"
                                            value="{{ $edit ? $data->isbn : old('isbn') }}">
                                        @error('isbn')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Judul</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                            value="{{ $edit ? $data->title : old('title') }}">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Penulis</label>
                                        <input type="text" name="author" class="form-control @error('author') is-invalid @enderror"
                                            value="{{ $edit ? $data->author : old('author') }}">
                                        @error('author')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Penerbit</label>
                                        <input type="text" name="publisher" class="form-control @error('publisher') is-invalid @enderror"
                                            value="{{ $edit ? $data->publisher : old('publisher') }}">
                                        @error('publisher')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Terbit</label>
                                        <select class="form-control @error('year') is-invalid @enderror" name="year">
                                            <option hidden >Pilih Tahun Terbit</option>
                                            @for ($i = $year; $i > $year-50; $i--)
                                                <option value="{{ $i }}" {{ $edit ? ($i == $data->year ? 'selected' : '') : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Buku</label>
                                        <input type="text" name="qty" class="form-control @error('qty') is-invalid @enderror"
                                            value="{{ $edit ? $data->qty : old('qty') }}">
                                        @error('qty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Masuk</label>
                                        <input type="text" class="form-control datepicker" name="entry_date" value="{{ $edit ? $data->entry_date : old('entry_date') }}">
                                        @error('entry_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary float-left">
                                        {{ __($edit ? 'Update' : 'Create') }}
                                    </button> &nbsp;
                                    <a href="{{ url('books/') }}" class="btn btn-info">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('scripts')
<script src="{{ asset(('stisla/js/page/forms-advanced-forms.js')) }}"></script>
<script src="{{ asset(('stisla/node_modules/bootstrap-daterangepicker/daterangepicker.js')) }}"></script>
@endsection
