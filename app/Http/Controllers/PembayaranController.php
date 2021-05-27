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
        $params = [
            'limit' => request()->input('length'),
            'offset' => request()->input('start')
        ];
        $user = auth()->user();
        $pembayarans = Pembayaran::select('id', 'tgl_bayar', 'no_bayar', 'status', 'jumlah_bayar', 'bukti_bayar', 'user_id');
        $count = Pembayaran::count();

        if ($user->role_id == 3) $pembayarans->where('user_id', $user->id);

        // perform pagination
        $pembayarans->limit($params['limit'])->offset($params['offset']);

        return datatables()
            ->of($pembayarans)
            ->setTotalRecords($count)
            ->addColumn('Actions', function ($pembayaran) use ($user) {
                if (!($user->isAdmin())) {
                    if ($pembayaran->bukti_bayar) {
                        return '<a type="button" href="/dashboard/pembayaran/' . $pembayaran->id . '/edit_bukti" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>';
                    }
                    return '<a type="button" href="/dashboard/pembayaran/' . $pembayaran->id . '/edit_bukti" class="btn btn-primary btn-sm">Upload bukti pembayaran</a>';
                }
                return '<a type="button" href="/dashboard/pembayaran/' . $pembayaran->id . '/edit_bukti" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>' .
                    ' <button type="button" class="btn btn-danger btn-sm" id="adminDeletePembayaran" value="' . $pembayaran->id . '"><i class="bi bi-trash"></i></button>';
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
        $statuses = ['verified', 'unverified', 'on-hold'];
        $this->authorize('update', $pembayaran);
        return view(
            'edit_bukti',
            [
                'pembayaran' => $pembayaran,
                'user' => auth()->user(),
                'statuses' => $statuses
            ]
        );
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

        if (auth()->user()->isAdmin()) {
            $pembayaran->status = $request['status'];
        } else {
            $pembayaran->status = "on-hold";
        }
        if ($request->file('bukti_pembayaran')) {
            $uploadedFileUrl = cloudinary()->upload($request->file('bukti_pembayaran')->getRealPath())->getSecurePath();
            $pembayaran->bukti_bayar = $uploadedFileUrl;
        }
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
