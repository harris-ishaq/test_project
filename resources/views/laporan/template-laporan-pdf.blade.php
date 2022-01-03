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
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
	</style>

    <center>
        <h2 style="margin-bottom:0px;">Laporan Perpustakaan</h2><br>
        <p style="margin-top:0px;">Bulan {{ $bulan_awal }} - {{ $bulan_akhir }} {{ $year }}<br> SDN 001 Muara Bengkal</p>
    </center>
    <hr>
	<table border="1" class="table">
        <thead>
            <tr>
                <th>#</th>
                <th class="text-center">NIS</th>
				<th class="text-center">Nama</th>
				<th class="text-center">Judul Buku</th>
				<th class="text-center">Tanggal Pinjam</th>
                <th class="text-center">Batas Kembali</th>
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
                    <td style="text-align:center">{{ $data->date_return->format('d-m-Y') }}</td>
                    <td style="text-align:center">
                        @if ($data->date_returned > $data->date_return)
                            Ya
                        @else
                            Tidak
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
</body>
</html>
