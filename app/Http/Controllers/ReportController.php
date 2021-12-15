<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use DB;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        $listYear = Transaction::select(DB::raw("(DATE_FORMAT(date_start, '%Y')) as year"))
            ->orderBy('date_start')
            ->groupBy(DB::raw("DATE_FORMAT(date_start, '%Y')"))
            ->get();

        return view('laporan.index', [
            'datas' => $listYear
        ]);
    }

    public function download(Request $request)
    {
        $input = $request->validate([
            'month' => 'required|min:3',
            'year'  => 'required|integer|digits:4',
        ]);
        $months = explode('-', $input['month']);

        $datas = Transaction::whereMonth('date_start', '>=', $months[0])
            ->whereMonth('date_start', '<=', $months[1])
            ->whereYear('date_start', $input['year'])
            ->get();

        $month_list = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        // dd('Laporan Perpustakaan ('.$month_list[$months[0]-1].' - '.$month_list[$months[1]-1].'.pdf');
        $pdf = PDF::loadview('laporan.template-laporan-pdf',[
                'datas'         => $datas,
                'bulan_awal'    => $month_list[$months[0]-1],
                'bulan_akhir'   => $month_list[$months[1]-1],
                'year'          => $input['year']
            ]);

        return $pdf->download('Laporan Perpustakaan ('.$month_list[$months[0]-1].' - '.$month_list[$months[1]-1].').pdf');
    }

}
