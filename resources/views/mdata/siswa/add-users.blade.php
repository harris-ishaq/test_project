@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Pengguna</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('users/') }}">Pengguna</a></div>
            <div class="breadcrumb-item active"><a href="#">Tambah Pengguna</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row ">
            <div class="col-12 col-md- col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Input Data Pengguna</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="card-title">
                                    <h5>
                                        <strong>
                                            @lang('Form Data Pengguna')
                                        </strong>
                                    </h5>
                                    <p class="card-lead" style="font-size: 14px;">
                                        @lang('Isikan data - data yang diperlukan untuk mendaftarkan siswa sebagai pengguna sistem.')
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <form action="{{ url('users/store') }}" method="post">
                                @csrf
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $data ? $data->name : old('name') }}" readonly>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pengguna</label>
                                        <!-- <input type="hidden" name="id" id="id" value="{{ $data ? $data->id : old('id') }}"> -->
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                            value="{{ $data ? $data->nis : old('username') }}" readonly>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Hak Akses</label>
                                        <input type="hidden" name="role" id="role" value="{{ $role ? $role->id : old('id') }}">
                                        <input type="text" name="role_name" class="form-control @error('role') is-invalid @enderror"
                                            value="{{ $role ? $role->name : old('role_name')}}" readonly>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Kata Sandi</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary float-left">
                                        {{ __('Create') }}
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

@section('scripts')
    <script src="{{ asset(('stisla/node_modules/jquery-pwstrength/jquery.pwstrength.min.js')) }}"></script>
@endsection
