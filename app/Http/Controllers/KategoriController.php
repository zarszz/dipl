<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**`
     * Display a listing of the kategori.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('view', Kategori::class);
        $kategories = Kategori::all();
        return datatables()->of($kategories)
            ->addColumn('Actions', function ($data) {
                return '<a type="button" href="/dashboard/admin/kategori/' . $data->id . '/edit" class="btn btn-primary btn-sm">Update</a>' .
                    '    <button type="button" class="btn btn-danger btn-sm" id="adminDeleteKategori" value="' . $data->id . '">Delete</button>';
            })
            ->rawColumns(['Actions'])
            ->make(true);
    }

    /**
     * Open kategories input form
     *
     */
    public function create()
    {
        $this->authorize('create', Kategori::class);
        return view('admin.kategoris.create');
    }

    /**
     * Store a newly created kategori in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', Kategori::class);
        $newKategori = $request->validate([
            'kategori'  => 'required',
            'deskripsi' => 'required',
        ]);

        Kategori::create($newKategori);

        return redirect()->route('dashboard.kategories');
    }

    /**
     * Update the specified kategori in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function edit($id)
    {
        $this->authorize('update', Kategori::class);
        return view('admin.kategoris.edit', ['kategori' => Kategori::findOrFail($id)]);
    }

    /**
     * Update the specified kategori in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $this->authorize('update', Kategori::class);
        $kategori = Kategori::findorFail($request->id);
        $newKategori = $request->validate([
            'kategori'  => 'required',
            'deskripsi' => 'required',
        ]);
        $kategori->update($newKategori);
        $request->session()->put('status', 'success_update');
        return redirect()->route('dashboard.kategories');
    }

    /**
     * Remove the specified kategori from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        $this->authorize('delete', Kategori::class);
        return Kategori::findOrFail($id)->delete();
    }
}
