<?php

namespace App\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateTransactionRequest;
use App\Models\Transaction;
use App\Models\Book;
use App\Models\Student;
use Carbon\Carbon;
use DB;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:permission-transaction', ['only' => ['index','create','store','edit','update','destroy','search','returnBook','saveReturned','cancel','indexDenda','bayar']]);
        // $this->middleware('permission:transaction-create', ['only' => ['create','store']]);
        // $this->middleware('permission:transaction-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:transaction-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$transaksi = Transaction::where('status', 'aktif')->latest()->paginate(5);
        return view('transaksi.index', [
            'datas' => Transaction::where('status', 'aktif')->latest()->paginate(5)
        ]);
    }

    public function indexKembali()
    {
        //$transaksi = Transaction::where('status', 'aktif')->latest()->paginate(5);
        return view('transaksi.index-kembali', [
            'datas' => Transaction::where('status', '!=', 'aktif')->latest()->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('transaksi.form',
        [
            'edit' => false,
            'books' => Book::where('qty', '>', '0')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTransactionRequest $request)
    {
        // Set input variable
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

        return redirect('transactions/')
            ->withSuccess(__('Berhasil melakukan peminjaman.'));
    }

    /**
     * Show the form for returning book.
     *
     * @return \Illuminate\Http\Response
     */
    public function returnBook(Transaction $transaction)
    {
        $transaction->date_returned = Carbon::today()->format('Y-m-d');
        $transaction->book = $transaction->bookInformation->title.', oleh '.$transaction->bookInformation->author;
        $transaction->datefilter = $transaction->date_start->format('m/d/Y').' - '.$transaction->date_return->format('m/d/Y');

        return view('transaksi.return-form',
        [
            'data' => $transaction
        ]);
    }

    /**
     * Update Transaction Data after Returned Book Transaction.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveReturned(Request $request, Transaction $transaction)
    {
        // Cek Apakah tanggal pengembalian melebihi batas peminjaman
        if ($request->date_returned > $transaction->date_return) {
            $transaction->status = 'denda';
        } else {
            $transaction->status = 'selesai';
        }

        // Set tanggal pengembalian
        $transaction->date_returned = $request['date_returned'];

        // Pengembalian Stok Buku
        $book = Book::findOrFail($transaction->books_id);
        $book->qty = $book->qty + 1;
        $book->save();

        // Save Transaction
        $transaction->save();

        return redirect('transactions/')
            ->withSuccess(__('Berhasil melakukan pengembalian buku.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        // Cek status buku untuk pengembalian stok
        if ($transaction->status == 'aktif') {
            $book = Book::findOrFail($transaction->books_id);
            $book->qty = $book->qty + 1;
            $book->save();
        }

        // Delete transaction
        $transaction->delete();

        return redirect('transactions/')
            ->withSuccess(__('Data Transaksi berhasil dihapus.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $transaction->datefilter = $transaction->date_start->format('m/d/Y').' - '.$transaction->date_return->format('m/d/Y');

        return view('transaksi.form',
        [
            'edit'  => true,
            'data'  => $transaction,
            'books' => Book::where('qty', '>', '0')->orWhere('id', $transaction->books_id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTransactionRequest $request, Transaction $transaction)
    {
        // Set input variable
        $transaction->students_id = $request->students_id;

        // dd($request);
        // Cek jika data buku yang baru tidak sama dengan data buku yang lama untuk memperbarui stok buku
        if ($transaction->books_id != $request->books_id) {
            $oldBook = Book::where('id', $transaction->books_id)->first();
            $oldBook->qty = $oldBook->qty + 1;
            $oldBook->save();

            $newBook = Book::where('id', $request['books_id'])->first();
            $newBook->qty = $newBook->qty - 1;
            $newBook->save();
        }

        $transaction->books_id = $request->books_id;


        // Set Format Data Tanggal Peminjaman
        $date = explode('-', $request['datefilter']);
        $date = preg_replace('/\s+/', '', $date);
        $time_start = strtotime($date[0]);
        $time_return = strtotime($date[1]);
        $date_start = date('Y/m/d', $time_start);
        $date_return = date('Y/m/d', $time_return);
        $transaction->date_start = $date_start;
        $transaction->date_return = $date_return;

        // Save update data
        $transaction->save();

        return redirect('transactions/')
            ->withSuccess(__('Data Transaksi berhasil diperbarui.'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel(Transaction $transaction)
    {
        // Update variable untuk kondisi batal
        $transaction->status = 'aktif';
        $transaction->date_returned = null;

        // Cek stok buku
        $book = Book::where('id', $transaction->books_id)->first();
        if ($book->qty != 0){
            $book->qty = $book->qty - 1;
            $book->save();
        }

        // Save update data
        $transaction->save();

        return redirect('transactions/')
            ->withSuccess(__('Data Transaksi berhasil dikembalikan.'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexDenda()
    {
        //$transaksi = Transaction::where('status', 'aktif')->latest()->paginate(5);
        return view('transaksi.index-denda', [
            'datas' => Transaction::where('status', 'denda')->orderBy('updated_at', 'desc')->paginate(5)
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bayar(Transaction $transaction)
    {
        // Update variable untuk kondisi batal
        $transaction->status = 'selesai';

        // Save update data
        $transaction->save();

        return view('transaksi.index-denda', [
            'datas' => Transaction::where('status', 'denda')->orderBy('updated_at', 'desc')->paginate(5)
        ]);
    }

    public function search(Request $request)
    {
        // dd($request);
        $search = $request->validate([
            'name' => 'required|max:255',
        ],[
            'name.required' => 'Field harus diisi.',
        ]);


        $student = Student::select('id')->where('name', 'LIKE', '%'.$search['name'].'%')->get()->pluck('id');
        $listTransaction = Transaction::where('status', 'aktif')->whereIn('students_id', $student)->paginate(5);
        // dd($listTransaction);
        return view('transaksi.index', [
            'datas' => $listTransaction
        ]);
    }

    public function searchKembali(Request $request)
    {
        // dd($request);
        $search = $request->validate([
            'name' => 'required|max:255',
        ],[
            'name.required' => 'Field harus diisi.',
        ]);


        $student = Student::select('id')->where('name', 'LIKE', '%'.$search['name'].'%')->get()->pluck('id');
        $listTransaction = Transaction::where('status', '!=', 'aktif')->whereIn('students_id', $student)->paginate(5);
        // dd($listTransaction);
        return view('transaksi.index', [
            'datas' => $listTransaction
        ]);
    }
}
