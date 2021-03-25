<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class AuditLogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_audit_log_has_title_link_attribute()
    {
        $auditLog = AuditLog::factory()->create();

        $title = __('app.show_detail_title', [
            'title' => $auditLog->title, 'type' => __('audit_log.audit_log'),
        ]);
        $link = '<a href="'.route('audit_logs.show', $auditLog).'"';
        $link .= ' title="'.$title.'">';
        $link .= $auditLog->title;
        $link .= '</a>';

        $this->assertEquals($link, $auditLog->title_link);
    }

    /** @test */
    public function a_audit_log_has_belongs_to_creator_relation()
    {
        $auditLog = AuditLog::factory()->make();

        $this->assertInstanceOf(User::class, $auditLog->creator);
        $this->assertEquals($auditLog->creator_id, $auditLog->creator->id);
    }
}
