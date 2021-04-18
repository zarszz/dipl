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
        $params = [
            'limit' => request()->input('length'),
            'offset' => request()->input('start')
        ];
        $count = AuditLog::count();

        $auditLogs = AuditLog::select('id', 'keterangan', 'aksi', 'kode_gudang', 'kode_barang', 'user_id', 'created_at');
        if (! auth()->user()->isAdmin()) $auditLogs = $auditLogs->where('user_id', auth()->user()->id);
        $auditLogs->limit($params['limit'])->offset($params['offset']);

        return datatables()->of($auditLogs)->setTotalRecords($count)->make(true);
    }
}
