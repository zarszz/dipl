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
        $editableKendaraan = null;
        $kendaraanQuery = Kendaraan::query();
        $kendaraanQuery->where('title', 'like', '%'.$request->get('q').'%');
        $kendaraanQuery->orderBy('title');
        $kendaraans = $kendaraanQuery->paginate(25);

        if (in_array(request('action'), ['edit', 'delete']) && request('id') != null) {
            $editableKendaraan = Kendaraan::find(request('id'));
        }

        return view('kendaraans.index', compact('kendaraans', 'editableKendaraan'));
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
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newKendaraan['creator_id'] = auth()->id();

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
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
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

        $request->validate(['kendaraan_id' => 'required']);

        if ($request->get('kendaraan_id') == $kendaraan->id && $kendaraan->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('kendaraans.index', $routeParam);
        }

        return back();
    }
}
