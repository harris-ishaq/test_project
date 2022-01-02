<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Book;
use App\Models\Student;
use App\Models\User;
Use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // if (Auth::user()->hasRole('Pengguna')) {
        //     $students = Student::where('nis', Auth::user()->username)->first();
        //     return view('home', [
        //         'transaction'   => Transaction::where('students_id', $students->id)->count(),
        //         'book'          => Book::where('qty', '>', 0)->count(),
        //     ]);
        if (Auth::user()->hasRole('Kepala Sekolah')) {
            return view('home', [
                'transaction'   => Transaction::whereYear('date_start', Carbon::now()->year)->count(),
                'book'          => Book::count(),
                'student'       => Student::count(),
            ]);
        } else {
            return view('home', [
                'transaction'   => Transaction::whereYear('date_start', Carbon::now()->year)->count(),
                'book'          => Book::count(),
                'student'       => Student::count(),
                'user'          => User::count(),
                'denda'         => Transaction::where('status', 'denda')->count()
            ]);
        }
    }
}
