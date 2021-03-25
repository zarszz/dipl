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
        $editableBarang = null;
        $barangQuery = Barang::query();
        $barangQuery->where('title', 'like', '%'.$request->get('q').'%');
        $barangQuery->orderBy('title');
        $barangs = $barangQuery->paginate(25);

        if (in_array(request('action'), ['edit', 'delete']) && request('id') != null) {
            $editableBarang = Barang::find(request('id'));
        }

        return view('barangs.index', compact('barangs', 'editableBarang'));
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
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newBarang['creator_id'] = auth()->id();

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
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
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

        $request->validate(['barang_id' => 'required']);

        if ($request->get('barang_id') == $barang->id && $barang->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('barangs.index', $routeParam);
        }

        return back();
    }
}
