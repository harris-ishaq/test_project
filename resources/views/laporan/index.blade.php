@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Laporan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="">Report</a></div>
        </div>
    </div>
    <div class="section-body">
        <div class="row ">
            <div class="col-12 col-md- col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Unduh Laporan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-4">
                                <div class="card-title">
                                    <h5>
                                        <strong>
                                            @lang('Form Unduh Laporan')
                                        </strong>
                                    </h5>
                                    <p class="card-lead" style="font-size: 14px;">
                                        @lang('Pilih laporan yang ingin diunduh.')
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-8">
                                <form action="{{ url('reports/download') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label>Bulan Laporan</label>
                                                <select class="form-control @error('role') is-invalid @enderror" name="month">
                                                <option hidden >Pilih Bulan Laporan</option>
                                                <option value="1-3" >Januari - Maret</option>
                                                <option value="4-6" >April - Juni</option>
                                                <option value="7-9" >Juli - September</option>
                                                <option value="10-12" >Oktober - Desember</option>
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                    <label>Tahun Laporan</label>
                                                    <select class="form-control @error('role') is-invalid @enderror" name="year">
                                                    <option hidden >Pilih Tahun Laporan</option>
                                                    @foreach ($datas as $data)
                                                        <option value="{{ $data->year }}" >{{ $data->year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-left">
                                        {{ __('Unduh') }}
                                    </button> &nbsp;
                                    <a href="{{ url('home/') }}" class="btn btn-info">Batal</a>
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

