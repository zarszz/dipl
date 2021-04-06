<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manageGudang,App\Models\Gudang')->except(['index']);
    }

    /**
     * Display a listing of the gudang.
     * @return DataTables
     */
    public function index()
    {
        $gudangs = Gudang::all();
        $dataTables = datatables()->of($gudangs);
        if (auth()->user()->can('manageGudang')) {
            $dataTables->addColumn('Actions', function ($data) {
                return '<a type="button" href="/dashboard/admin/gudang/' . $data->id . '/edit" class="btn btn-primary btn-sm">Update</a>' .
                    '    <button type="button" class="btn btn-danger btn-sm" id="adminDeleteGudang" value="' . $data->id . '">Delete</button>';
            });
        } else {
            $dataTables->addColumn('Actions', function ($data) {
                return '<a type="button" href="/dashboard/admin/gudang/' . $data->id . '/edit" class="btn btn-primary btn-sm">Cek Barang</a>';
            });
        }
        return $dataTables->rawColumns(['Actions'])->make(true);
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
        $this->authorize('create', new Gudang);

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
