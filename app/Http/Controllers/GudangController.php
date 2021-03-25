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
        $editableGudang = null;
        $gudangQuery = Gudang::query();
        $gudangQuery->where('title', 'like', '%'.$request->get('q').'%');
        $gudangQuery->orderBy('title');
        $gudangs = $gudangQuery->paginate(25);

        if (in_array(request('action'), ['edit', 'delete']) && request('id') != null) {
            $editableGudang = Gudang::find(request('id'));
        }

        return view('gudangs.index', compact('gudangs', 'editableGudang'));
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
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newGudang['creator_id'] = auth()->id();

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
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
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

        $request->validate(['gudang_id' => 'required']);

        if ($request->get('gudang_id') == $gudang->id && $gudang->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('gudangs.index', $routeParam);
        }

        return back();
    }
}
