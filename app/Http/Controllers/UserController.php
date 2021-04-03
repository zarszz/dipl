<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        try {
            $user = User::find($id);
            $user->status = "verified";
            $user->save();
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                return view('user', ['error' => 'User Not found !!']);
            }
            return view('user', ['error' => $e->getMessage()]);
        }
    }

    public function getRegisteredUserByTime()
    {
        $data = [];
        // $result = User::selectRaw("created_at, date_part('year', created_at) as year, date_part('month', created_at) as month, count(*) AS data")
        //     ->groupBy('year', 'month')
        //     ->orderBy('year', 'asc')
        //     ->get();
        $users = User::orderBy('created_at')->get()->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $i = 0;
        foreach ($users as $key => $post) {
            // $day = $key;
            // $totalCount = $post->count();
            $data[$i]['x'] = $key;
            $data[$i]['y'] = $post->count();
            $i++;
        }

        // for ($i = 0; $i < sizeof($result); $i++) {
        //     // $data[$i]['x'] = $result[$i]['month'] . '-' .$result[$i]['year'];
        //     // $data[$i]['x'] = intVal($result[$i]['month'] . $result[$i]['year']);
        //     $data[$i]['x'] = $result[$i]['created_at'];
        //     $data[$i]['y'] = $result[$i]['data'];
        // }
        return response($data, 200);
    }
}
