<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create,App\Models\User')->only(['create', 'store']);
        $this->middleware('can:viewAll,App\Models\User')->only('index');
    }
    public function index() {
        $users = User::all('id', 'email', 'jenis_kelamin', 'nama');
        return datatables()->of($users)
            ->addColumn('Actions', function ($data) {
                return '<a type="button" href="/dashboard/admin/user/edit/'.$data->id.'" class="btn btn-primary btn-sm" id="getDeleteId">Update</a>
                        <button type="button" class="btn btn-danger btn-sm" id="adminDeleteUser" value="' . $data->id . '">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    public function create() {
        return view('admin.user.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'tgl_lahir' => ['required'],
            'alamat' => ['required'],
            'jenis_kelamin' => ['required']
        ]);

        User::create([
            'nama' => $request['nama'],
            'email' => $request['email'],
            'tgl_lahir' => $request['tgl_lahir'],
            'alamat' => $request['alamat'],
            'jenis_kelamin' => $request['jenis_kelamin'],
            'role_id' => 3,
            'password' => Hash::make($request['password']),
        ]);
        return redirect(route('dashboard.user'));
    }

    public function edit(Request $request, $id) {
        return view('admin.user.edit', ['user' => User::find($id), 'roles' => Role::all()]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'tgl_lahir' => ['required'],
            'alamat' => ['required'],
            'jenis_kelamin' => ['required']
        ]);

        $user = User::find($request['id']);
        $user->nama = $request['nama'];
        if ($user->email != $request['email']) {
            $user->email = $request['email'];
        }
        $user->tgl_lahir = $request['tgl_lahir'];
        $user->jenis_kelamin = $request['jenis_kelamin'];
        $user->role_id = $request['role_id'];

        $user->save();

        return redirect(route('dashboard.user'));
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);
            $this->authorize('destroy', $user);
            return $user->delete();
        } catch (\Exception $e) {
            return view('dashboard', ['error' => 'User Not found !!']);
        }
    }
}
