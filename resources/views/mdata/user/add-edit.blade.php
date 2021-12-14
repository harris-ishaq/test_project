@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Pengguna</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('users/') }}">Pengguna</a></div>
            @if ($edit)
                <div class="breadcrumb-item active"><a href="#">Ubah Data Pengguna</a></div>
            @else
                <div class="breadcrumb-item active"><a href="#">Tambah Pengguna</a></div>
            @endif
        </div>
    </div>
    <div class="section-body">
        <!-- @if ($edit)
            {!! Form::open(['url' => 'users/'.$data->id, 'method' => 'PUT', 'id' => 'form']) !!}
        @else
            {!! Form::open(['url' => 'users/', 'method' => 'POST', 'id' => 'form']) !!}
        @endif -->
        <div class="row ">
            <div class="col-12 col-md- col-lg-12">
                <div class="card">
                    <div class="card-header">
                    @if ($edit)
                        <h4>Ubah Data Pengguna</h4>
                    @else
                        <h4>Input Data Pengguna</h4>
                    @endif
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
                                        @if ($edit)
                                            @lang('Pilih field data pengguna yang ingin dirubah.')
                                        @else
                                            @lang('Isikan data - data yang diperlukan untuk melakukan pendaftaran pengguna baru.')
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                @if ($edit)
                                    <form action="{{ url('users/'.$data->id) }}" method="post">
                                    @method('PUT')
                                @else
                                    <form action="{{ url('users/store') }}" method="post">
                                @endif
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                            value="{{ $edit ? $data->name : old('name') }}" {{ $edit ? ($data->hasRole('Pengguna') ? 'readonly' : '') : '' }}>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Pengguna</label>
                                        <input type="hidden" name="id" id="id" value="{{ $edit ? $data->id : old('id') }}">
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                            value="{{ $edit ? $data->username : old('username') }}" {{ $edit ? ($data->hasRole('Pengguna') ? 'readonly' : '') : '' }}>
                                        @error('username')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Hak Akses</label>
                                        @if ($edit)
                                            @if ($data->hasRole('Pengguna'))
                                                <input type="text" name="role-name" class="form-control @error('role') is-invalid @enderror"
                                                value="Pengguna" {{ $edit ? ($data->hasRole('Pengguna') ? 'readonly' : '') : '' }}>
                                                <input type="hidden" name="role" value="{{ $data->roles->pluck('id')->first() }}">
                                            @else
                                                <select class="form-control @error('role') is-invalid @enderror" name="role">
                                                    <option hidden >Pilih Level Pengguna</option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}" {{ $edit ? ($role->id == $data->roles->pluck('id')->first() ? 'selected' : '') : '' }}>{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        @else
                                            <select class="form-control @error('role') is-invalid @enderror" name="role">
                                                <option hidden >Pilih Level Pengguna</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}" {{ $edit ? ($role->id == $data->roles->pluck('id')->first() ? 'selected' : '') : '' }}>{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Kata Sandi</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                        @if ($edit)
                                            <strong style="color:red">Peringatan</strong><small>: Jangan isi password jika tidak ingin mengganti password sebelumnya.</small>
                                        @endif
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary float-left">
                                        {{ __($edit ? 'Update' : 'Create') }}
                                    </button> &nbsp;
                                    <a href="{{ url('users/') }}" class="btn btn-info">Cancel</a>
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
