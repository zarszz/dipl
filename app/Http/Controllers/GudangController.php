<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manageGudang,App\Models\Gudang')->except(['index', 'getBarangByUserData', 'getBarangByUser']);
    }

    /**
     * Display a listing of the gudang.
     * @return DataTables
     */
    public function index()
    {
        $gudangs = Gudang::all();
        $dataTables = datatables()->of($gudangs);
        if (auth()->user()->isAdmin()) {
            $dataTables->addColumn('Actions', function ($data) {
                return '<a type="button" href="/dashboard/admin/gudang/' . $data->id . '/edit" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>' .
                    ' | <button type="button" class="btn btn-danger btn-sm" id="adminDeleteGudang" value="' . $data->id . '"><i class="bi bi-trash"></i></button>';
            });
        } else {
            $dataTables->addColumn('Actions', function ($data) {
                return '<a type="button" href="/dashboard/' . auth()->user()->id . '/gudang/' . $data->id . '/cek-barang" class="btn btn-primary btn-sm">Cek Barang</a>';
            });
        }
        return $dataTables->rawColumns(['Actions'])->make(true);
    }

    /**
     * Display a listing of barang in the gudang based on user id.
     * @return DataTables
     */
    public function getBarangByUserData($user_id, $id)
    {
        abort_if($user_id != auth()->user()->id, 403, 'You are not authorize to perform this action !!');
        $barang = Gudang::find($id)->barang->where('user_id', $user_id);
        return datatables()->of($barang)
                ->addColumn('Actions', function ($data) {
                    return '<button type="button" class="btn btn-primary btn-sm" id="userTarikBarangOnGudang" value="' . $data->id . '">Tarik</a>' .
                    '<button type="button" class="btn btn-danger btn-sm" id="deleteBarang" value="' . $data->id . '"><i class="bi bi-trash"></i></button>';
                })
                ->rawColumns(['Actions'])
                ->make(true);
    }

    public function getBarangOnGudang()
    {
        $data = [];
        $barangsOnGudang = Gudang::with('barang')->get();
        foreach ($barangsOnGudang as $gudang) {
            array_push($data, [
                'y' => sizeof($gudang->barang),
                'x' => $gudang->nama_gudang
            ]);
        }
        return response()->json($data, 200);
    }

        /**
     * Display a listing of barang in the gudang based on user id.
     * @return view
     */
    public function getBarangByUser()
    {
        return view('gudang.list_barang');
    }

    /**
     * Open gudang input form
     *
     */
    public function create()
    {
        return view('admin.gudang.create');
    }

    /**
     * Store a newly created gudang in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $newGudang = $request->validate([
            'nama_gudang' => 'required',
            'alamat' => 'required'
        ]);

        Gudang::create($newGudang);

        return redirect()->route('dashboard.gudang');
    }

    /**
     * Update the specified gudang in storage.
     *
     * @param  Integer  $id - id of gudang
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // $this->authorize('update', $kategori);
        return view('admin.gudang.edit', ['gudang' => Gudang::findOrFail($id)]);
    }

    /**
     * Update the specified gudang in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer $id - id of gudang
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $gudang = Gudang::findOrFail($id);
        $gudangData = $request->validate([
            'nama_gudang' => 'required',
            'alamat' => 'required'
        ]);
        $gudang->update($gudangData);
        $request->session()->put('status', 'success_update');
        return redirect()->route('dashboard.gudang');
    }

    /**
     * Remove the specified gudang from storage.
     *
     * @param  Integer $id - Id of gudang
     * @return \Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        return Gudang::findOrFail($id)->delete();
    }
}
