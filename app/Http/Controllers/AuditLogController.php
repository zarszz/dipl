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
        $editableAuditLog = null;
        $auditLogQuery = AuditLog::query();
        $auditLogQuery->where('title', 'like', '%'.$request->get('q').'%');
        $auditLogQuery->orderBy('title');
        $auditLogs = $auditLogQuery->paginate(25);

        if (in_array(request('action'), ['edit', 'delete']) && request('id') != null) {
            $editableAuditLog = AuditLog::find(request('id'));
        }

        return view('audit_logs.index', compact('auditLogs', 'editableAuditLog'));
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
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
        ]);
        $newAuditLog['creator_id'] = auth()->id();

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
            'title'       => 'required|max:60',
            'description' => 'nullable|max:255',
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

        $request->validate(['audit_log_id' => 'required']);

        if ($request->get('audit_log_id') == $auditLog->id && $auditLog->delete()) {
            $routeParam = request()->only('page', 'q');

            return redirect()->route('audit_logs.index', $routeParam);
        }

        return back();
    }
}
