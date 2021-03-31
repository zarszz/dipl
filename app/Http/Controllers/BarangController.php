<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the barang.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $barangs = Barang::all();
        return view('barangs.index', compact('barangs'));
    }

    /**
     * Store a newly created barang in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Barang);

        $newBarang = $request->validate([
            'user_id'       => 'required',
            'kode_gudang' => 'required',
            'kode_ruangan' => 'required',
            'kode_kategori' => 'required',
            'nama_brg' => 'required',
            'jumlah_brg' => 'required'
        ]);
        $newBarang['user_id'] = auth()->id();

        Barang::create($newBarang);

        return redirect()->route('barangs.index');
    }

    /**
     * Update the specified barang in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Barang $barang)
    {
        $this->authorize('update', $barang);

        $barangData = $request->validate([
            'user_id'       => 'required',
            'kode_gudang' => 'required',
            'kode_ruangan' => 'required',
            'kode_kategori' => 'required',
            'nama_brg' => 'required',
            'jumlah_brg' => 'required'
        ]);
        $barang->update($barangData);

        $routeParam = request()->only('page', 'q');

        return redirect()->route('barangs.index', $routeParam);
    }

    /**
     * Remove the specified barang from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Barang $barang)
    {
        $this->authorize('delete', $barang);

        $request->validate(['id' => 'required']);

        if ($request->get('id') == $barang->id && $barang->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('barangs.index', $routeParam);
        }

        return back();
    }
}
