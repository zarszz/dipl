<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the auditLog.
     *
     * @return DataTables
     */
    public function index()
    {
        $auditLogs = null;
        if (auth()->user()->isAdmin()) {
            $auditLogs = AuditLog::all();
        } else {
            $auditLogs = AuditLog::where('user_id', auth()->user()->id);
        }
        return datatables()->of($auditLogs)->make(true);
    }
}
