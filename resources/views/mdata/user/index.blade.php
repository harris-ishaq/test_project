@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Pengguna</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="{{ url('users/') }}">Pengguna</a></div>
        </div>
    </div>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>List Pengguna</h4>
                <div class="card-header-button">
                <!-- <div class="float-right"> -->
                <a href="{{ url('users/create') }}" class="btn btn-lg btn-icon icon-left btn-primary" style="border-radius: 5px !important;"><i class="fas fa-user-plus"></i> Tambah Pengguna</a>
                    <!-- </div> -->

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless table-md">
                        <thead>
                            <tr>
                                <th scope="col" style="width:5%">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Role Level</th>
                                <th scope="col">Username</th>
                                <th scope="col" style="width:20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users))
                                @foreach ($users as $user)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                        @forelse ($user->roles->take(1) as $role)
                                            {{ $role->name }}
                                        @empty
                                            Not assigned
                                        @endforelse
                                        </td>
                                        <td>{{ $user->username }}</td>
                                        <td><a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-info">Edit</a>&#9;<a href="{{ url('users/'.$user->id.'/destroy') }}" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4"><em>@lang('No records found.')</em></td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-center">
                {{ $users->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
</section>
@stop

@section('scripts')
    <script src="{{ asset(('stisla/node_modules/jquery-ui-dist/jquery-ui.min.js')) }}"></script>
@endsection
