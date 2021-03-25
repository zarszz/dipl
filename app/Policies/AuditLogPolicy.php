<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Auth\Access\HandlesAuthorization;

class AuditLogPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the audit_log.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AuditLog  $auditLog
     * @return mixed
     */
    public function view(User $user, AuditLog $auditLog)
    {
        // Update $user authorization to view $auditLog here.
        return true;
    }

    /**
     * Determine whether the user can create audit_log.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AuditLog  $auditLog
     * @return mixed
     */
    public function create(User $user, AuditLog $auditLog)
    {
        // Update $user authorization to create $auditLog here.
        return true;
    }

    /**
     * Determine whether the user can update the audit_log.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AuditLog  $auditLog
     * @return mixed
     */
    public function update(User $user, AuditLog $auditLog)
    {
        // Update $user authorization to update $auditLog here.
        return true;
    }

    /**
     * Determine whether the user can delete the audit_log.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AuditLog  $auditLog
     * @return mixed
     */
    public function delete(User $user, AuditLog $auditLog)
    {
        // Update $user authorization to delete $auditLog here.
        return true;
    }
}
