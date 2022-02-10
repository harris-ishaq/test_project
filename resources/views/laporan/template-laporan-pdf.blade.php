<!DOCTYPE html>
<html>
<head>
	<title>Laporan Perpustakaan</title>
</head>
<body>
	<style type="text/css">
        hr.dash-line {
            border-top: 2px dashed black;
        }
        table {
            width: 100%;
        }
        .table_data, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .kop {
            border-collapse: collapse;
        }
        .noBorder {
            border:none !important;
        }
	</style>
    <table class="kop" style="border-collapse: collapse;" width="100%">
        <tr>
            <td class="noBorder" width="22" align="center"><img src="" width="60%"></td>
            <td class="noBorder" width="55" align="center">
                <h4>PEMERINTAH KABUPATEN KUTAI TIMUR<br>
                DINAS PENDIDIKAN KECAMATAN MUARA BENGKAL<br>
                SDN 001 MUARA BENGKAL<br>
                Jl. Singa Raja RT.05 Desa Ngayau Kecamatan Muara Bengkal</h4>
            </td>
            <td class="noBorder" width="23" align="center"><img src="" width="100%"></td>
        </tr>
    </table>

    <hr>
    <center>
        <h4 style="margin-bottom:0px;">Laporan Perpustakaan</h4><br>
        <p style="margin-top:0px;">Bulan {{ $bulan_awal }} - {{ $bulan_akhir }} {{ $year }}<br> SDN 001 Muara Bengkal</p>
    </center>
	<table border="1" class="table_data">
        <thead>
            <tr>
                <th>#</th>
                <th class="text-center">NIS</th>
				<th class="text-center">Nama</th>
				<th class="text-center">Judul Buku</th>
				<th class="text-center">Tanggal Pinjam</th>
                <th class="text-center">Tanggal Kembali</th>
                <th class="text-center">Denda</th>
			</tr>
        </thead>
		<tbody>
            @if (count($datas) > 0)
                @foreach($datas as $no=>$data)
                <tr>
                    <td style="text-align:center">{{ $no+1 }}</td>
                    <td style="text-align:center">{{ $data->studentInformation->nis }}</td>
                    <td style="text-align:center">{{ $data->studentInformation->name }}</td>
                    <td style="text-align:center">{{ $data->bookInformation->title }}</td>
                    <td style="text-align:center">{{ $data->date_start->format('d-m-Y') }}</td>
                    <td style="text-align:center">
                        @if ($data->date_returned)
                            {{ $data->date_returned->format('d-m-Y') }}
                        @else
                            Belum Kembali
                        @endif
                    </td>
                    <td style="text-align:center">
                        @if ($data->date_returned > $data->date_return)
                            20.000
                        @else
                            -
                        @endif
                    </td>
                </tr>
                @endforeach
            @else
            <tr>
                <td colspan="7" class="text-align:center">Belum ada data</td>
            </tr>
            @endif
            <tr>
                <td colspan="6" style="text-align:center">Jumlah Denda</td>
                <td style="text-align:center">{{ number_format(round($denda),0,",",".") }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <br>
    <br>
    <br>
    <table style="border-collapse: collapse;" width="100%">
        <tr>
            <td class="noBorder" width="80" align="center"></td>
            <td class="noBorder" width="20" style="text-align:center">Muara Bengkal, {{ $tanggal }} {{ $bulan }} {{$tahun}}</td>
        </tr>
        <tr>
            <td class="noBorder" width="80" align="center"></td>

            <td class="noBorder" width="20" align="center">&nbsp;</td>
        </tr>
        <tr>
            <td class="noBorder" width="80" align="center"></td>
            <td class="noBorder" width="20" align="center">&nbsp;</td>
        </tr>
        <tr>
            <td class="noBorder" width="80" align="center"></td>
            <td class="noBorder" width="20" align="center">&nbsp;</td>
        </tr>
        <tr>
            <td class="noBorder" width="80" align="center"></td>
            <td class="noBorder" style="border-bottom: 1px solid black;" width="20" align="center"><b>SYAFRAN, S. Pd</b></td>
        </tr>
        <tr>
            <td class="noBorder" width="80" align="center"></td>
            <td class="noBorder" width="20" align="center">NIP. 19690514 200105 1 001</td>
        </tr>
    </table>
</body>
</html>
