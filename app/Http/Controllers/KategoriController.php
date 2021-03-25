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
        $editableKategori = null;
        $kategoriQuery = Kategori::query();
        $kategoriQuery->where('title', 'like', '%'.$request->get('q').'%');
        $kategoriQuery->orderBy('title');
        $kategoris = $kategoriQuery->paginate(25);

        if (in_array(request('action'), ['edit', 'delete']) && request('id') != null) {
            $editableKategori = Kategori::find(request('id'));
        }

        return view('kategoris.index', compact('kategoris', 'editableKategori'));
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
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newKategori['creator_id'] = auth()->id();

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

        $kategoriData = $request->validate([
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $kategori->update($kategoriData);

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

        $request->validate(['kategori_id' => 'required']);

        if ($request->get('kategori_id') == $kategori->id && $kategori->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('kategoris.index', $routeParam);
        }

        return back();
    }
}
