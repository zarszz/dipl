<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;

class GudangController extends Controller
{
    /**
     * Display a listing of the gudang.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $gudangs = Gudang::all();
        return view('gudangs.index', compact('gudangs'));
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
            'alamat'       => 'required'
        ]);

        Gudang::create($newGudang);

        return redirect()->route('gudangs.index');
    }

    /**
     * Update the specified gudang in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gudang  $gudang
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Gudang $gudang)
    {
        $this->authorize('update', $gudang);

        $gudangData = $request->validate([
            'alamat' => 'required'
        ]);
        $gudang->update($gudangData);

        $routeParam = request()->only('page', 'q');

        return redirect()->route('gudangs.index', $routeParam);
    }

    /**
     * Remove the specified gudang from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gudang  $gudang
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Gudang $gudang)
    {
        $this->authorize('delete', $gudang);

        $request->validate(['id' => 'required']);

        if ($request->get('id') == $gudang->id && $gudang->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('gudangs.index', $routeParam);
        }

        return back();
    }
}
