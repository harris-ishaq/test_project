@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset(('stisla/node_modules/select2/dist/css/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(('stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css')) }}">
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Peminjaman Buku</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="{{ url('user-transactions/list') }}">Peminjaman Buku</a></div>
            <div class="breadcrumb-item"><a href="">Pinjam Buku</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row ">
            <div class="col-12 col-md- col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Isi Data Peminjaman Buku</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="card-title">
                                    <h5>
                                        <strong>
                                            @lang('Form Peminjaman Buku')
                                        </strong>
                                    </h5>
                                    <p class="card-lead" style="font-size: 14px;">
                                        @lang('Isikan data - data yang diperlukan untuk melakukan peminjaman buku.')
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <form action="{{ url('user-transactions/store') }}" method="post">
                                    @csrf
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
                                                        value="{{ $data ? $data->nis : old('nis') }}" placeholder="Isi NIS Peminjam" readonly>
                                                    <input type="hidden" name="students_id" id="students_id" value="{{ $data ? $data->id : old('students_id') }}">
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
                                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" readonly
                                                    value="{{ $data ? $data->name : old('name') }}" id="name" placeholder="Nama Siswa">
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
                                                <option value="{{ $book->id }}">{{ $book->title }}, oleh {{ $book->author }}</option>
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
                                            <input type="text" name="datefilter" class="form-control daterange-cus" value="{{ $data ? $data->datefilter : old('datefilter') }}"
                                                placeholder="Waktu Peminjaman" autocomplete="off">>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-left">
                                        {{ __('Buat') }}
                                    </button> &nbsp;
                                    <a href="{{ url('user-transactions/list') }}" class="btn btn-info">Batal</a>
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

