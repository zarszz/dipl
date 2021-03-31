<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the pembayaran.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $editablePembayaran = null;
        $pembayaranQuery = Pembayaran::query();
        $pembayaranQuery->where('title', 'like', '%'.$request->get('q').'%');
        $pembayaranQuery->orderBy('title');
        $pembayarans = $pembayaranQuery->paginate(25);

        if (in_array(request('action'), ['edit', 'delete']) && request('id') != null) {
            $editablePembayaran = Pembayaran::find(request('id'));
        }

        return view('pembayarans.index', compact('pembayarans', 'editablePembayaran'));
    }

    /**
     * Store a newly created pembayaran in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Pembayaran);

        $newPembayaran = $request->validate([
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newPembayaran['creator_id'] = auth()->id();

        Pembayaran::create($newPembayaran);

        return redirect()->route('pembayarans.index');
    }

    /**
     * Update the specified pembayaran in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        $this->authorize('update', $pembayaran);

        $pembayaranData = $request->validate([
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $pembayaran->update($pembayaranData);

        $routeParam = request()->only('page', 'q');

        return redirect()->route('pembayarans.index', $routeParam);
    }

    /**
     * Remove the specified pembayaran from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Pembayaran $pembayaran)
    {
        $this->authorize('delete', $pembayaran);

        $request->validate(['pembayaran_id' => 'required']);

        if ($request->get('pembayaran_id') == $pembayaran->id && $pembayaran->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('pembayarans.index', $routeParam);
        }

        return back();
    }
}
