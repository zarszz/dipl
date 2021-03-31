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
        $editableRuangan = null;
        $ruanganQuery = Ruangan::query();
        $ruanganQuery->where('title', 'like', '%'.$request->get('q').'%');
        $ruanganQuery->orderBy('title');
        $ruangans = $ruanganQuery->paginate(25);

        if (in_array(request('action'), ['edit', 'delete']) && request('id') != null) {
            $editableRuangan = Ruangan::find(request('id'));
        }

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
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newRuangan['creator_id'] = auth()->id();

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
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
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

        $request->validate(['ruangan_id' => 'required']);

        if ($request->get('ruangan_id') == $ruangan->id && $ruangan->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('ruangans.index', $routeParam);
        }

        return back();
    }
}
