<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Pembayaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the pembayaran.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = auth()->user();
        $pembayarans = $user->isAdmin() ? Pembayaran::all() : Pembayaran::where('user_id', auth()->user()->id);
        return datatables()
            ->of($pembayarans)
            ->addColumn('Actions', function ($pembayaran) use ($user) {
                if (!($user->isAdmin())) {
                    if ($pembayaran->bukti_bayar) {
                        return '<a type="button" href="/dashboard/user/pembayaran/' . $pembayaran->id . '/upload_bukti" class="btn btn-primary btn-sm">Edit bukti pembayaran</a>';
                    }
                    return '<a type="button" href="/dashboard/user/pembayaran/' . $pembayaran->id . '/upload_bukti" class="btn btn-primary btn-sm">Upload bukti pembayaran</a>';
                }
                return '<a type="button" href="/dashboard/admin/pembayaran/' . $pembayaran->id . '/edit" class="btn btn-primary btn-sm">Update</a>' .
                    ' <button type="button" class="btn btn-danger btn-sm" id="adminDeletePembayaran" value="' . $pembayaran->id . '">Delete</button>';
            })
            ->addColumn('Verifikasi', function ($pembayaran) use ($user) {
                if ($user->isAdmin()) {
                    if (!($pembayaran->status == "verified")) {
                        return ' <button type="button" class="btn btn-warning btn-sm" id="adminVerifPembayaran" value="' . $pembayaran->id . '">VERIFY</button>';
                    } else {
                        return ' <button type="button" class="btn btn-success btn-sm disabled">VERIFIED</button>';
                    }
                } else {
                    $status = $pembayaran->status == 'verified' ? ['VERIFIED', 'btn-success'] : ['UNVERIFIED', 'btn-warning'];
                    return ' <button type="button" class="btn ' . $status[1] . ' btn-sm disabled">' . $status[0] . '</button>';
                }
            })
            ->rawColumns(['Actions', 'Verifikasi'])
            ->make(true);
    }

    /**
     * Get one pembayaran data based on their id.
     *
     * @param  Integer  $id
     * @return \Illuminate\Routing\Redirector
     */
    public function view($id)
    {
        return Pembayaran::find($id);
    }

    /**
     * Verificate pembayaran data based on their id.
     *
     * @param  Integer  $id
     * @return \Illuminate\Routing\Redirector
     */
    public function verify($id)
    {
        $this->authorize('verify', Pembayaran::class);
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->status = "verified";
        $pembayaran->save();
        AuditLog::create([
            'keterangan' => 'Verifikasi pembayaran dengan nomor ' . $pembayaran->no_bayar,
            'aksi' => 'verifikasi-pembayaran',
            'user_id' => auth()->user()->id
        ]);
        return response()->json(['status' => 'oke'], 200);
    }

    /**
     * Store a newly created pembayaran in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', Pembayaran::class);
        $newPembayaran = $request->validate([
            'jumlah_bayar'       => 'required'
        ]);
        $newPembayaran['user_id'] = auth()->id();
        $newPembayaran['tgl_bayar'] = Carbon::now();
        $newPembayaran['no_bayar'] =  Str::uuid();
        $newPembayaran['status'] = 'unverified';
        Pembayaran::create($newPembayaran);
        return redirect()->route('dashboard.pembayaran');
    }

    /**
     * Open upload bukti pembayaran form.
     *
     * @param  Integer id
     * @return \Illuminate\Routing\Redirector
     */
    public function editBukti($id)
    {
        $pembayaran = Pembayaran::where('id', $id)->first();
        $this->authorize('update', $pembayaran);
        return view('user.upload_bukti', ['pembayaran' => $pembayaran, 'user' => auth()->user()]);
    }

    /**
     * Update the specified pembayaran in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Routing\Redirector
     */
    public function updateBukti(Request $request)
    {
        $pembayaran = Pembayaran::where('id', $request['id'])->first();
        $this->authorize('update', $pembayaran);

        $pembayaran->status = "on-hold";
        $filename = $pembayaran->no_bayar . '.jpg';
        $request->file('bukti_pembayaran')->storeAs('public/pembayaran', $filename);
        $pembayaran->bukti_bayar = env('APP_URL') . '/storage/pembayaran/' . $filename;
        $pembayaran->save();

        return redirect(route('dashboard.pembayaran'));
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
        $request->session()->put('status', 'success_update');
        return redirect()->route('pembayarans.index', $routeParam);
    }

    /**
     * Remove the specified pembayaran from storage.
     *
     * @param  Integer  $id
     * @return \Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $this->authorize('delete', $pembayaran);
        return $pembayaran->delete();
    }
}
