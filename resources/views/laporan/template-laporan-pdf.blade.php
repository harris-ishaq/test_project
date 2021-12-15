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
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
	</style>

    <center>
        <h2 style="margin-bottom:0px;">Laporan Perpustakaan</h2><br>
        <p style="margin-top:0px;">Bulan {{ $bulan_awal }} - {{ $bulan_akhir }} {{ $year }}<br> SDN 001 Muara Bengal</p>
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
                <th class="text-center">Tanggal Kembali</th>
                <th class="text-center">Denda</th>
			</tr>
        </thead>
		<tbody>
            @if (count($datas) > 0)
                @foreach($datas as $no=>$data)
                <tr>
                    <td class="text-center">{{ $no+1 }}</td>
                    <td class="text-center">{{ $data->studentInformation->nis }}</td>
                    <td class="text-center">{{ $data->studentInformation->name }}</td>
                    <td class="text-center">{{ $data->bookInformation->title }}</td>
                    <td class="text-center">{{ $data->date_start->format('d-m-Y') }}</td>
                    <td class="text-center">{{ $data->date_return->format('d-m-Y') }}</td>
                    <td>
                        @if ($data->status == 'denda')
                            Ya
                        @else
                            Tidak
                        @endif
                    </td>
                </tr>
                @endforeach
            @else
            @endif
        </tbody>
    </table>
</body>
</html>
