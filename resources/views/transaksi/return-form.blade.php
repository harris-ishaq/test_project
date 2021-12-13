@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset(('stisla/node_modules/select2/dist/css/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(('stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css')) }}">
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Transaksi</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('transactions/') }}">Transaksi</a></div>
            <div class="breadcrumb-item active"><a href="#">Pengembalian</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row ">
            <div class="col-12 col-md- col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pengembalian Buku</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="card-title">
                                    <h5>
                                        <strong>
                                            @lang('Form Pengembalian Buku')
                                        </strong>
                                    </h5>
                                    <p class="card-lead" style="font-size: 14px;">
                                        @lang('Pastikan data yang ada di form sudah benar sebelum melakukan pengembalian.')
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <form action="{{ url('transactions/return/'.$data->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Nomor Peminjaman</label>
                                                <input type="text" name="transaction_id" class="form-control @error('transaction_id') is-invalid @enderror"
                                                    value="{{ $data ? $data->transaction_id : old('transaction_id') }}" readonly>
                                                @error('transaction_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                            <label>Nomor Induk Siswa Peminjam</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="ic">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" name="nis" id="nis" class="form-control @error('nis') is-invalid @enderror"
                                                        value="{{ $data ? $data->studentInformation->nis : old('nis') }}" placeholder="Isi NIS Peminjam"
                                                        autocomplete="off" readonly>

                                                    @error('nis')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <small class="text-danger font-italic" id="txt_valid" style="display: none;">Data tidak valid.</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Nama Siswa</label>
                                                <input type="hidden" name="students_id" id="students_id" value="{{ $data ? $data->students_id : old('students_id') }}">
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" readonly
                                                    value="{{ $data ? $data->studentInformation->name : old('name') }}" placeholder="Nama Siswa">
                                                @error('students_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Buku</label>
                                        <input type="hidden" name="books_id" value="{{ $data ? $data->books_id : old('books_id') }}">
                                        <input type="text" name="name" class="form-control @error('book') is-invalid @enderror" readonly
                                                    value="{{ $data->book }}">
                                        @error('books_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Waktu Peminjaman</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                            </div>
                                            <input type="text" name="datefilter" class="form-control daterange-cus" value="{{ $data ? $data->datefilter : old('datefilter') }}"
                                                placeholder="Waktu Peminjaman" autocomplete="off" readonly>
                                            <input type="hidden" name="date" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Pengembalian</label>
                                        <input type="text" class="form-control datepicker" name="date_returned" value="{{ $data ? $data->date_returned : old('date_returned') }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary float-left">
                                        {{ __('Save') }}
                                    </button> &nbsp;
                                    <a href="{{ url('transactions/') }}" class="btn btn-info">Cancel</a>
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
<script src="{{ asset(('stisla/node_modules/select2/dist/js/select2.full.min.js')) }}"></script>
<script src="{{ asset(('stisla/node_modules/bootstrap-daterangepicker/daterangepicker.js')) }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
$(function() {

  $('input[name="datefilter"]').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
  });

  $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));

  });

  $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });

});
</script>
@endsection

