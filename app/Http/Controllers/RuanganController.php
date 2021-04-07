<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the ruangan.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('view', Ruangan::class);
        $ruangans = Ruangan::all();
        return datatables()->of($ruangans)
            ->addColumn('Actions', function ($data) {
                return '<a type="button" href="/dashboard/admin/ruangan/' . $data->id . '/edit" class="btn btn-primary btn-sm">Update</a>' .
                    ' <button type="button" class="btn btn-danger btn-sm" id="adminDeleteRuangan" value="' . $data->id . '">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    /**
     * Open ruangan input form
     *
     */
    public function create()
    {
        $this->authorize('create', Ruangan::class);
        return view('admin.ruangan.create', ['gudangs' => Gudang::all()]);
    }

    /**
     * Store a newly created ruangan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', Ruangan::class);
        $newRuangan = $request->validate([
            'nama_ruangan'  => 'required|max:60',
            'kode_ruangan' => 'required|max:60',
            'kode_gudang' => 'required|integer'
        ]);

        Ruangan::create($newRuangan);

        return redirect()->route('dashboard.ruangan');
    }

    public function getRuanganByGudang($kode_gudang)
    {
        return Ruangan::select('id', 'nama_ruangan')->where('kode_gudang', $kode_gudang)->get();
    }

    /**
     * Update the specified ruangan in storage.
     *
     * @param  Integer  $id - id of ruangan
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $this->authorize('update', Ruangan::class);
        return view('admin.ruangan.edit', ['ruangan' => Ruangan::findOrFail($id), 'gudangs' => Gudang::all()]);
    }

    /**
     * Update the specified ruangan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->authorize('update', Ruangan::class);
        $ruanganData = $request->validate([
            'nama_ruangan' => 'required|max:60',
            'kode_ruangan' => 'required|max:60',
            'kode_gudang'  => 'required|integer'
        ]);
        $ruangan = Ruangan::findOrFail($id);
        $ruangan->update($ruanganData);

        return redirect()->route('dashboard.ruangan');
    }

    /**
     * Remove the specified ruangan from storage.
     *
     * @param  Integer - id of ruangan
     * @return \Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        $this->authorize('delete', Ruangan::class);
        $ruangan = Ruangan::findOrFail($id);
        abort_if($ruangan->barang()->count() > 0, $code=400, $message='Masih terdapat barang pada ruangan tersebut');
        return $ruangan->delete();
    }
}
