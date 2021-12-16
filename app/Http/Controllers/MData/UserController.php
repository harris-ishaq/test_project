<?php

namespace App\Http\Controllers\MData;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:permission-user', ['only' => ['index','create','store','edit','update','destroy','search','addStudentAsUser']]);
        // $this->middleware('permission:user-create', ['only' => ['create','store']]);
        // $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('username', '!=', 'Admin')->with('roles')->latest()->paginate(5);
        // dd($users);
        return view('mdata.user.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(Role::select(['id', 'name'])->get());
        return view('mdata.user.add-edit',
        [
            'edit' => false,
            'roles' => Role::select(['id', 'name'])->where('name', '!=', 'Pengguna')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {

        $request['password'] = Hash::make($request['password']);
        $user = User::create($request->all());
        $user->assignRole([$request->role]);

        return redirect('users/')
            ->withSuccess(__('Data Pengguna berhasil ditambahkan.'));
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
        $user = User::where('id', $id)->with('roles')->first();
        return view('mdata.user.add-edit',
        [
            'edit' => true,
            'data' => $user,
            'roles' => Role::select(['id', 'name'])->where('name', '!=', 'Pengguna')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $oldRole = $user->roles->first()->id;
        $newRole = $request['role'];

        if ($request['username'] == $user->username) {
            $request = Arr::except($request,array('username'));
        }

        if(!empty($request['password'])){
            $request['password'] = Hash::make($request['password']);
        }else{
            $request = Arr::except($request,array('password'));
        }

        $input = $request->validate([
            'name'      => 'required|max:255',
            'username'  => 'sometimes|min:5|unique:users,username',
            'password'  => 'sometimes|min:5',
            'role'      => 'required|exists:roles,id',
        ],
        [
            'name.required' => 'Nama wajib diisi.',
        ]);

        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        $user->assignRole($request->input('role'));

        if (Auth::user()->name != 'Admin') {
            if ($oldRole != $newRole) {
                return redirect('home/');
            }
        }

        return redirect('users/')
            ->withSuccess(__('Data Pengguna berhasil diperbarui.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('users/')
            ->withSuccess(__('Data Pengguna berhasil dihapus.'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addStudentAsUser(Student $data)
    {
        return view('mdata.siswa.add-users',
        [
            'data' => $data,
            'role' => Role::where('name', 'Pengguna')->first()
        ]);
    }
}
