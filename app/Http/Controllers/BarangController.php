<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Kategori;
use App\Models\Kendaraan;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;

class BarangController extends Controller
{

    /**
     * Display a listing of the gudang.
     * @return DataTables
     */
    public function index()
    {
        $user = auth()->user();
        $barangs = $user->isAdmin() || $user->isDriver() ? Barang::all() : Barang::where('user_id', auth()->user()->id);
        return datatables()
            ->of($barangs)
            ->addColumn('Actions', function ($data) use ($user) {
                if ($user->isDriver()) {
                    return '<a type="button" href="/dashboard/admin/barang/' . $data->id . '/edit" class="btn btn-primary btn-sm">Cek Barang</a>';
                } else if ($user->isAdmin()){
                    return '<a type="button" href="/dashboard/admin/barang/' . $data->id . '/edit" class="btn btn-primary btn-sm">Update</a>' .
                    ' <button type="button" class="btn btn-danger btn-sm" id="deleteBarang" value="' . $data->id . '">Delete</button>';
                } else {
                    return '<button type="button" class="btn btn-primary btn-sm" id="userTarikBarang" value="' . $data->id . '">Tarik</a>' .
                    ' <button type="button" class="btn btn-danger btn-sm" id="deleteBarang" value="' . $data->id . '">Delete</button>';
                }
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    public function detail(Request $request, $id)
    {
        $this->authorize('view', Barang::find($id));
        $request = $request->all();
        // dd(request());
        return [
            'gudang' => Gudang::select('nama_gudang')->where('id', $request['kode_gudang'])->first(),
            'user' => User::select('nama')->where('id', $request['user_id'])->first(),
            'kategori' => Kategori::select('kategori')->where('id', $request['kode_kategori'])->first(),
            'ruangan' => Ruangan::select('nama_ruangan')->where('id', $request['kode_ruangan'])->first(),
        ];
    }

    public function create()
    {
        return view('admin.barang.create', ['gudangs' => Gudang::all(), 'kendaraans' => Kendaraan::all(), 'kategories' => Kategori::all()]);
    }

    /**
     * Store a newly created barang in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', Barang::class);
        $newBarang = $request->validate([
            'kode_gudang' => 'required',
            'kode_ruangan' => 'required',
            'kode_kategori' => 'required',
            'kode_kendaraan' => 'string',
            'nama_brg' => 'required',
            'jumlah_brg' => 'required'
        ]);
        $newBarang['user_id'] = auth()->user()->id;
        $barang = Barang::create($newBarang);
        if(auth()->user()->isAdmin()) return redirect()->route('dashboard.barang');
        $harga = 100000 * $barang->jumlah_brg;
        $dibayar = [
            'harga' => $harga,
            'ppn' => $harga * 0.10,
            'total' => $harga + ($harga * 0.10)
        ];
        AuditLog::create([
            'keterangan' => 'Menyimpan barang dengan nama ' . $barang->nama_brg . ' sebanyak ' . $barang->jumlah_brg . ' buah',
            'aksi' => 'simpan-barang',
            'user_id' => auth()->user()->id,
            'kode_gudang' => $barang->kode_gudang,
            'kode_barang' => $barang->id
        ]);
        return view('user.barang.create_pembayaran', ['dibayar' => $dibayar, 'barang' => $barang, 'user' => auth()->user()]);
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $this->authorize('update', $barang);
        $ruangan = Ruangan::findOrFail($barang->kode_ruangan);
        return view('admin.barang.edit', ['barang' => $barang, 'ruangan' => $ruangan, 'gudangs' => Gudang::all(), 'kendaraans' => Kendaraan::all(), 'kategories' => Kategori::all()]);
    }
    /**
     * Tarik the specified barang in storage.
     * Ajax !!
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function tarik(Request $request, $id)
    {
        $barang = Barang::find($id);
        $this->authorize('update', $barang);
        $request = $request->all();

        $amount = $request['jumlah_brg'];
        if ($amount > $barang->jumlah_brg) {
            return response()->json([
                'status' => 'error',
                'message' => 'jumlah barang yang ditarik lebih dari yang tersimpan !!'
            ], 400);
        }
        $barang->jumlah_brg = $barang->jumlah_brg - $amount;
        $barang->save();
        AuditLog::create([
            'keterangan' => 'Mengambil barang dengan id ' . $barang->id . ' sebanyak ' . $amount . ' buah',
            'aksi' => 'tarik-barang',
            'user_id' => auth()->user()->id,
            'kode_gudang' => $barang->kode_gudang,
            'kode_barang' => $barang->id
        ]);
        return response()->json(['status' => 'success'], 200);
    }

    /**
     * Update the specified barang in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $barang = Barang::find($request->input('id'));
        $this->authorize('update', $barang);
        $barangData = $request->validate([
            'user_id'       => 'required',
            'kode_gudang' => 'required',
            'kode_ruangan' => 'required',
            'kode_kategori' => 'string',
            'nama_brg' => 'required',
            'jumlah_brg' => 'required'
        ]);
        $barang->update($barangData);

        return redirect()->route('dashboard.barang');
    }

    /**
     * Remove the specified barang from storage.
     *
     * @param  Ineteger - id of barang
     * @return \Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        $barang = Barang::findOrFail($id);
        $this->authorize('delete', $barang);
        return $barang->delete();
    }
}
