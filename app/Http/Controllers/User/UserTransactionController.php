<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Transaction;
use App\Models\Book;
use Carbon\Carbon;

class UserTransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:permission-user-transaction', ['only' => ['index','create','store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentId = Student::where('nis', Auth::user()->username)->first();
        // dd(Transaction::where('students_id', $studentId->id)->latest()->paginate(5));

        return view('user.index', [
            'datas' => Transaction::where('students_id', $studentId->id)->latest()->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('user.add-form',
        [
            'data'  => Student::where('nis', Auth::user()->username)->first(),
            'books' => Book::where('qty', '>', '0')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = [
            'students_id'   => $request->students_id,
            'books_id'      => $request->books_id
        ];

        // Get Last Id Data
        $lastTransaction = Transaction::whereDate('created_at', Carbon::today())->latest()->first();
        $transaction_date = Carbon::now();

        // Set ID Transaction
        $input['transaction_id'] = $transaction_date->isoFormat('YYYYMMDD')."-001";
        if (!empty($lastTransaction)){
            $dataSplit = explode('-', $lastTransaction->transaction_id);
            $lastId = (int)$dataSplit[1];
            $nextId = $lastId + 1;

            $transaction_id = $transaction_date->isoFormat('YYYYMMDD')."-".$nextId;
            if (strlen($nextId) < 3) {
                if (strlen($nextId) < 2) {
                    $transaction_id = $transaction_date->isoFormat('YYYYMMDD')."-00".$nextId;
                } else {
                    $transaction_id = $transaction_date->isoFormat('YYYYMMDD')."-0".$nextId;
                }
            }

            $input['transaction_id'] = $transaction_id;
        }

        // Set Format Data Tanggal Peminjaman
        $date = explode('-', $request['datefilter']);
        $date = preg_replace('/\s+/', '', $date);
        $time_start = strtotime($date[0]);
        $time_return = strtotime($date[1]);
        $date_start = date('Y/m/d', $time_start);
        $date_return = date('Y/m/d', $time_return);
        $input['date_start'] = $date_start;
        $input['date_return'] = $date_return;

        // Pengurangan Jumlah Buku
        $book = Book::findOrFail($input['books_id']);
        $book->qty = $book->qty - 1;
        $book->save();

        // Create Transaction
        Transaction::create($input);

        return redirect('user-transactions/list')
            ->withSuccess(__('Berhasil melakukan peminjaman.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
