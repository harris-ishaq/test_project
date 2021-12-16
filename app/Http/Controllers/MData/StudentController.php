<?php

namespace App\Http\Controllers\MData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Requests\CreateStudentRequest;
use Illuminate\Support\Arr;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:permission-students', ['only' => ['index','create','store','edit','update','destroy','search','get']]);
        // $this->middleware('permission:student-create', ['only' => ['create','store']]);
        // $this->middleware('permission:student-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:student-delete', ['only' => ['destroy']]);
        // $this->middleware('permission:student-search', ['only' => ['search']]);
    }

    /**
     * Display a listing of the resource.
     *`
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = Student::latest()->paginate(5);
        return view('mdata.siswa.index', [
            'datas' => $student
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mdata.siswa.add-edit',
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
    public function store(CreateStudentRequest $request)
    {
        // dd($request);
        Student::create($request->all());
        return redirect('students/')
            ->withSuccess(__('Data Siswa berhasil ditambahkan.'));
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
    public function edit(Student $data)
    {
        return view('mdata.siswa.add-edit', ['edit' => true, 'data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $data)
    {
        if ($request['nis'] == $data->nis) {
            $request = Arr::except($request,array('nis'));
        }

        $input = $request->validate([
            'name' => 'required|max:225',
            'nis' => 'sometimes|max:15|unique:students,nis',
            'gender' => 'required|in:Laki - Laki,Perempuan',
        ]);

        $data->update($input);
        return redirect('students/')
            ->withSuccess(__('Data Siswa berhasil diperbarui.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $data)
    {
        $data->delete();
        return redirect('students/')
            ->withSuccess(__('Data Siswa berhasil dihapus.'));
    }

    /**
     * Search specified resource from storage by given keyword.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // dd($request);
        $search = $request->validate([
            'name' => 'required|max:225',
        ]);


        $result = Student::where('name', 'LIKE', '%'.$search['name'].'%')->paginate(3);
        return view('mdata.siswa.index', [
            'datas' => $result
        ]);
    }

    /**
     * Search specified resource from storage by given keyword and send back to where function called.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        // dd($request);
        $result = Student::where('nis', $request->nis)->first();

        if(!empty($result)){
            $resp = [
                'code' => 200,
                'data' => [
                        'id'    => $result->id,
                        'nama'  => $result->name
                    ]
                ];
            return json_encode($resp);
        } else {
            return json_encode([
                'code' => 404
            ]);
        }
    }
}
