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
            @if ($edit)
                <div class="breadcrumb-item active"><a href="#">Ubah Data Transaksi</a></div>
            @else
                <div class="breadcrumb-item active"><a href="#">Tambah Transaksi</a></div>
            @endif
        </div>
    </div>
    <div class="section-body">
        <div class="row ">
            <div class="col-12 col-md- col-lg-12">
                <div class="card">
                    <div class="card-header">
                    @if ($edit)
                        <h4>Ubah Data Transaksi</h4>
                    @else
                        <h4>Input Data Transaksi</h4>
                    @endif
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="card-title">
                                    <h5>
                                        <strong>
                                            @lang('Form Transaksi Peminjaman')
                                        </strong>
                                    </h5>
                                    <p class="card-lead" style="font-size: 14px;">
                                        @if ($edit)
                                            @lang('Pilih field data transaksi yang ingin dirubah.')
                                        @else
                                            @lang('Isikan data - data yang diperlukan untuk menambahkan transaksi baru.')
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                @if ($edit)
                                    <form action="{{ url('transactions/'.$data->id) }}" method="post">
                                    @method('PUT')
                                @else
                                    <form action="{{ url('transactions/store') }}" method="post">
                                @endif
                                    @csrf
                                    @if ($edit)
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Nomor Peminjaman</label>
                                                <input type="text" name="transaction_id" class="form-control @error('transaction_id') is-invalid @enderror"
                                                    value="{{ $edit ? $data->transaction_id : old('transaction_id') }}" readonly>
                                                @error('transaction_id')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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
                                                        value="{{ $edit ? $data->studentInformation->nis : old('nis') }}" placeholder="Isi NIS Peminjam"
                                                        autocomplete="off">

                                                    @error('students_id')
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
                                                <input type="hidden" name="students_id" id="students_id" value="{{ $edit ? $data->students_id : old('students_id') }}">
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" readonly
                                                    value="{{ $edit ? $data->studentInformation->name : old('name') }}" id="name" placeholder="Nama Siswa">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Buku</label>
                                        <select class="form-control select2" name="books_id">
                                            <option selected value="">Pilih Buku</option>
                                            @foreach ($books as $book)
                                                <option value="{{ $book->id }}" {{ $edit ? ($book->id == $data->books_id ? 'selected' : '') : '' }}>{{ $book->title }}, oleh {{ $book->author }}</option>
                                            @endforeach
                                        </select>
                                        @error('book_id')
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
                                            <input type="text" name="datefilter" class="form-control daterange-cus" value="{{ $edit ? $data->datefilter : old('datefilter') }}"
                                                placeholder="Waktu Peminjaman" autocomplete="off">>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-left">
                                        {{ __($edit ? 'Update' : 'Create') }}
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
<script type="text/javascript">
  let timer;
  $('#nis').keyup(function() {
    $('#students_id').val('');
    $('#name').val('');
    $('#nis').addClass('is-invalid');

    let val = $(this).val();
    clearTimeout(timer);
    timer = setTimeout(function () {
      $.ajax({
        url: '{{ url('students/get-student') }}',
        data: {nis: val},
        type: 'get',
        dataType: 'json',
        beforeSend: function () {
          $('#ic').html('<i class="fas fa-sync-alt"></i>');
        },
        success: function (res) {
          if(res.code == 200){
            $('#students_id').val(res.data.id);
            $('#name').val(res.data.nama);
            $('#txt_valid').hide();
            $('#nis').removeClass('is-invalid').addClass('is-valid');
          } else {
            $('#txt_valid').show();
          }
          $('#ic').html('<i class="fa fa-user"></i>');
        },
        error: function () {
          // body...
          $('#txt_valid').show();
          $('#ic').html('<i class="fa fa-user"></i>');
        }
      })
    }, 1000)
  });
</script>
@endsection

