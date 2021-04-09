<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:create,App\Models\User')->only(['create', 'store']);
        $this->middleware('can:verifyUser,App\Models\User')->only('verify');
        $this->middleware('can:viewAll,App\Models\User')->only(['index', 'getRegisteredUserByTime']);
    }
    public function index()
    {
        $params = [
            'limit' => request()->input('length'),
            'offset' => request()->input('start')
        ];
        // $users = User::select('id', 'email', 'jenis_kelamin', 'nama')->limit($params['limit'])->offset($params['offset'])->get();
        $users = User::all();
        // $count = User::count();
        return datatables()->of($users)
            // ->setTotalRecords($count)
            ->addColumn('Status', function ($user) {
                if ($user->status == "unverified") {
                    return ' <button type="button" class="btn btn-warning btn-sm" id="adminVerifUser" value="' . $user->id . '">VERIFY</button>';
                } else {
                    return ' <button type="button" class="btn btn-success btn-sm disabled">VERIFIED</button>';
                }
            })
            ->addColumn('Actions', function ($data) {
                return '<a type="button" href="/dashboard/admin/user/edit/' . $data->id . '" class="btn btn-primary btn-sm" id="getDeleteId">Update</a>' .
                    '    <button type="button" class="btn btn-danger btn-sm" id="adminDeleteUser" value="' . $data->id . '">Delete</button>';
            })
            ->rawColumns(['Status', 'Actions'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
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

    public function edit(Request $request, $id)
    {
        return view('admin.user.edit', ['user' => User::find($id), 'roles' => Role::all()]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
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

    public function verify($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('create', User::class);
        $user->status = "verified";
        $user->save();
        AuditLog::create([
            'keterangan' => 'Berhasil Melakukan verifikasi user dengan id ' . $id,
            'aksi' => 'verifikasi-user',
            'user_id' => auth()->user()->id
        ]);
    }

    public function getRegisteredUserByTime()
    {
        $data = [];
        $users = User::orderBy('created_at')->get()->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $i = 0;
        foreach ($users as $key => $post) {
            $data[$i]['x'] = $key;
            $data[$i]['y'] = $post->count();
            $i++;
        }
        return response($data, 200);
    }
}
