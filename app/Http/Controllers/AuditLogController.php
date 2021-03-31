<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the auditLog.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $auditLogs = AuditLog::all();
        return view('audit_logs.index', compact('auditLogs'));
    }

    /**
     * Store a newly created auditLog in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new AuditLog);

        $newAuditLog = $request->validate([
            'keterangan'       => 'required',
            'aksi' => 'required',
            'kode_gudang' => 'required',
            'kode_barang' => 'required'
        ]);
        $newAuditLog['user_id'] = auth()->id();

        AuditLog::create($newAuditLog);

        return redirect()->route('audit_logs.index');
    }

    /**
     * Update the specified auditLog in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AuditLog  $auditLog
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, AuditLog $auditLog)
    {
        $this->authorize('update', $auditLog);

        $auditLogData = $request->validate([
            'keterangan'       => 'required',
            'aksi' => 'required',
            'kode_gudang' => 'required',
            'kode_barang' => 'required'
        ]);
        $auditLog->update($auditLogData);

        $routeParam = request()->only('page', 'q');

        return redirect()->route('audit_logs.index', $routeParam);
    }

    /**
     * Remove the specified auditLog from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AuditLog  $auditLog
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, AuditLog $auditLog)
    {
        $this->authorize('delete', $auditLog);

        $request->validate(['id' => 'required']);

        if ($request->get('id') == $auditLog->id && $auditLog->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('audit_logs.index', $routeParam);
        }

        return back();
    }
}
