<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the kendaraan.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $kendaraans = Kendaraan::all();
        return view('kendaraans.index', compact('kendaraans'));
    }

    /**
     * Store a newly created kendaraan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Kendaraan);

        $newKendaraan = $request->validate([
            'nama_kendaraan'       => 'required|max:60',
            'plat_nomor' => 'required|max:255',
            'kapasitas' => 'required|max:255',
            'kapasitas_terpakai' => 'required|max:255',
        ]);

        Kendaraan::create($newKendaraan);

        return redirect()->route('kendaraans.index');
    }

    /**
     * Update the specified kendaraan in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $this->authorize('update', $kendaraan);

        $kendaraanData = $request->validate([
            'nama_kendaraan'       => 'required|max:60',
            'plat_nomor' => 'required|max:255',
            'kapasitas' => 'required|max:255',
            'kapasitas_terpakai' => 'required|max:255',
        ]);
        $kendaraan->update($kendaraanData);

        $routeParam = request()->only('page', 'q');

        return redirect()->route('kendaraans.index', $routeParam);
    }

    /**
     * Remove the specified kendaraan from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Kendaraan $kendaraan)
    {
        $this->authorize('delete', $kendaraan);

        $request->validate(['id' => 'required']);

        if ($request->get('id') == $kendaraan->id && $kendaraan->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('kendaraans.index', $routeParam);
        }

        return back();
    }
}
