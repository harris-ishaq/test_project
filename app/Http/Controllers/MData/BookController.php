<?php

namespace App\Http\Controllers\MData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Requests\CreateBookRequest;
use Illuminate\Support\Arr;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:permission-books', ['only' => ['index','create','store','edit','update','destroy','search']]);
        // $this->middleware('permission:book-create', ['only' => ['create','store']]);
        // $this->middleware('permission:book-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:book-delete', ['only' => ['destroy']]);
        // $this->middleware('permission:book-search', ['only' => ['search']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::latest()->paginate(3);
        return view('mdata.buku.index', [
            'datas' => $book
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mdata.buku.add-edit',
        [
            'edit' => false
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request)
    {
        // $input = $request->all();
        Book::create($request->all());
        return redirect('books/')
            ->withSuccess(__('Data Buku berhasil ditambahkan.'));
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
    public function edit(Book $book)
    {
        return view('mdata.buku.add-edit', ['edit' => true, 'data' => $book]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        if ($request['code_book'] == $book->code_book) {
            $request = Arr::except($request,array('code_book'));
        }

        $input = $request->validate([
            'code_book' => 'sometimes|integer|digits_between:1,255|unique:books,code_book',
            'title'     => 'required|max:255',
            'publisher' => 'required|max:255',
            'author'    => 'required|max:255',
            'qty'       => 'required|integer|min:0',
        ]);

        $book->update($input);
        return redirect('books/')
            ->withSuccess(__('Data Buku berhasil diperbarui.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('books/')
            ->withSuccess(__('Data Buku berhasil dihapus.'));
    }

    /**
     * Search specified resource from storage by given keyword.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // dd($request);
        $search = $request->validate([
            'title' => 'required|max:255',
        ],[
            'title.required' => 'Field harus diisi.',
        ]);


        $result = Book::where('title', 'LIKE', '%'.$search['title'].'%')->paginate(3);
        return view('mdata.buku.index', [
            'datas' => $result
        ]);
    }
}
