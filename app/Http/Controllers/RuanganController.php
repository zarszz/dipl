<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the ruangan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $ruangans = Ruangan::all();
        return view('ruangans.index', compact('ruangans', 'editableRuangan'));
    }

    /**
     * Store a newly created ruangan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Ruangan);

        $newRuangan = $request->validate([
            'nama_ruangan'       => 'required|max:60',
            'kode_ruangan' => 'required|max:60',
            'kode_gudang' => 'required|integer'
        ]);

        Ruangan::create($newRuangan);

        return redirect()->route('ruangans.index');
    }

    /**
     * Update the specified ruangan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        $this->authorize('update', $ruangan);

        $ruanganData = $request->validate([
            'nama_ruangan' => 'required|max:60',
            'kode_ruangan' => 'required|max:60',
            'kode_gudang'  => 'required|integer'
        ]);
        $ruangan->update($ruanganData);

        $routeParam = request()->only('page', 'q');

        return redirect()->route('ruangans.index', $routeParam);
    }

    /**
     * Remove the specified ruangan from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Ruangan $ruangan)
    {
        $this->authorize('delete', $ruangan);

        $request->validate(['id' => 'required']);

        if ($request->get('id') == $ruangan->id && $ruangan->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('ruangans.index', $routeParam);
        }

        return back();
    }
}
