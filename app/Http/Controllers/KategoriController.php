<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the kategori.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $kategoris = Kategori::all();
        return view('kategoris.index', compact('kategoris'));
    }

    /**
     * Store a newly created kategori in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Kategori);

        $newKategori = $request->validate([
            'kategori'       => 'required',
            'deskripsi' => 'required',
        ]);

        Kategori::create($newKategori);

        return redirect()->route('kategoris.index');
    }

    /**
     * Update the specified kategori in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Kategori $kategori)
    {
        $this->authorize('update', $kategori);

        $newKategori = $request->validate([
            'kategori'  => 'required',
            'deskripsi' => 'required',
        ]);
        $kategori->update($newKategori);

        $routeParam = request()->only('page', 'q');

        return redirect()->route('kategoris.index', $routeParam);
    }

    /**
     * Remove the specified kategori from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Kategori $kategori)
    {
        $this->authorize('delete', $kategori);

        $request->validate(['id' => 'required']);

        if ($request->get('id') == $kategori->id && $kategori->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('kategoris.index', $routeParam);
        }

        return back();
    }
}
