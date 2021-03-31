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
        $pembayarans = Pembayaran::all();
        return view('pembayarans.index', compact('pembayarans'));
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
            'tgl_bayar'       => 'required',
            'no_bayar'       => 'required',
            'status'       => 'required',
            'jumlah_bayar'       => 'required'
        ]);
        $newPembayaran['user_id'] = auth()->id();

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
            'tgl_bayar'       => 'required',
            'no_bayar'       => 'required',
            'status'       => 'required',
            'jumlah_bayar'       => 'required'
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

        $request->validate(['id' => 'required']);

        if ($request->get('id') == $pembayaran->id && $pembayaran->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('pembayarans.index', $routeParam);
        }

        return back();
    }
}
