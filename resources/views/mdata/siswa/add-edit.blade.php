@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Siswa</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('students/') }}">Siswa</a></div>
            @if ($edit)
                <div class="breadcrumb-item active"><a href="#">Ubah Data Siswa</a></div>
            @else
                <div class="breadcrumb-item active"><a href="#">Tambah Siswa</a></div>
            @endif
        </div>
    </div>
    <div class="section-body">
        <div class="row ">
            <div class="col-12 col-md- col-lg-12">
            @if(isset ($errors) && count($errors) > 0)
                <div class="alert alert-danger alert-notification alert-dismissible fade show">
                    <ul class="list-unstyled mb-0">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <div class="card">
                    <div class="card-header">
                    @if ($edit)
                        <h4>Ubah Data Siswa</h4>
                    @else
                        <h4>Input Data Siswa</h4>
                    @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="card-title">
                                    <h5>
                                        <strong>
                                            @lang('Form Data Siswa')
                                        </strong>
                                    </h5>
                                    <p class="card-lead" style="font-size: 14px;">
                                        @if ($edit)
                                            @lang('Pilih field data pengguna yang ingin dirubah.')
                                        @else
                                            @lang('Isikan data - data yang diperlukan untuk menambahkan data siswa baru.')
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                @if ($edit)
                                    <form action="{{ url('students/'.$data->id) }}" method="post">
                                    @method('PUT')
                                @else
                                    <form action="{{ url('students/store') }}" method="post">
                                @endif
                                    @csrf
                                    <div class="form-group">
                                        <label>Nomor Induk Siswa</label>
                                        <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror"
                                            value="{{ $edit ? $data->nis : old('nis') }}">
                                        @error('nis')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $edit ? $data->name : old('name') }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                            <option hidden>Jenis Kelamin</option>
                                            <option value="Laki - Laki" {{ $edit ? ('Laki - Laki' == $data->gender ? 'selected' : '') : '' }}>Laki - Laki</option>
                                            <option value="Perempuan" {{ $edit ? ('Perempuan' == $data->gender ? 'selected' : '') : '' }}>Perempuan</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary float-left">
                                        {{ __($edit ? 'Update' : 'Create') }}
                                    </button> &nbsp;
                                    <a href="{{ url('students/') }}" class="btn btn-info">Cancel</a>
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

