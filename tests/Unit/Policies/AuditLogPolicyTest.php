<?php

namespace Tests\Unit\Policies;

use App\Models\AuditLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class AuditLogPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_audit_log()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new AuditLog));
    }

    /** @test */
    public function user_can_view_audit_log()
    {
        $user = $this->createUser();
        $auditLog = AuditLog::factory()->create();
        $this->assertTrue($user->can('view', $auditLog));
    }

    /** @test */
    public function user_can_update_audit_log()
    {
        $user = $this->createUser();
        $auditLog = AuditLog::factory()->create();
        $this->assertTrue($user->can('update', $auditLog));
    }

    /** @test */
    public function user_can_delete_audit_log()
    {
        $user = $this->createUser();
        $auditLog = AuditLog::factory()->create();
        $this->assertTrue($user->can('delete', $auditLog));
    }
}
