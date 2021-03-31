<?php

namespace Tests\Feature;

use App\Models\AuditLog;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageAuditLogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_audit_log_list_in_audit_log_index_page()
    {
        $auditLog = AuditLog::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('audit_logs.index');
        $this->see($auditLog->title);
    }

    /** @test */
    public function user_can_create_a_audit_log()
    {
        $this->loginAsUser();
        $this->visitRoute('audit_logs.index');

        $this->click(__('audit_log.create'));
        $this->seeRouteIs('audit_logs.index', ['action' => 'create']);

        $this->submitForm(__('audit_log.create'), [
            'title'       => 'AuditLog 1 title',
            'description' => 'AuditLog 1 description',
        ]);

        $this->seeRouteIs('audit_logs.index');

        $this->seeInDatabase('audit_logs', [
            'title'       => 'AuditLog 1 title',
            'description' => 'AuditLog 1 description',
        ]);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'AuditLog 1 title',
            'description' => 'AuditLog 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_audit_log_title_is_required()
    {
        $this->loginAsUser();

        // title empty
        $this->post(route('audit_logs.store'), $this->getCreateFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_audit_log_title_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // title 70 characters
        $this->post(route('audit_logs.store'), $this->getCreateFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_audit_log_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('audit_logs.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_edit_a_audit_log_within_search_query()
    {
        $this->loginAsUser();
        $auditLog = AuditLog::factory()->create(['title' => 'Testing 123']);

        $this->visitRoute('audit_logs.index', ['q' => '123']);
        $this->click('edit-audit_log-'.$auditLog->id);
        $this->seeRouteIs('audit_logs.index', ['action' => 'edit', 'id' => $auditLog->id, 'q' => '123']);

        $this->submitForm(__('audit_log.update'), [
            'title'       => 'AuditLog 1 title',
            'description' => 'AuditLog 1 description',
        ]);

        $this->seeRouteIs('audit_logs.index', ['q' => '123']);

        $this->seeInDatabase('audit_logs', [
            'title'       => 'AuditLog 1 title',
            'description' => 'AuditLog 1 description',
        ]);
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'AuditLog 1 title',
            'description' => 'AuditLog 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_audit_log_title_update_is_required()
    {
        $this->loginAsUser();
        $audit_log = AuditLog::factory()->create(['title' => 'Testing 123']);

        // title empty
        $this->patch(route('audit_logs.update', $audit_log), $this->getEditFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_audit_log_title_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $audit_log = AuditLog::factory()->create(['title' => 'Testing 123']);

        // title 70 characters
        $this->patch(route('audit_logs.update', $audit_log), $this->getEditFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_audit_log_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $audit_log = AuditLog::factory()->create(['title' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('audit_logs.update', $audit_log), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_audit_log()
    {
        $this->loginAsUser();
        $auditLog = AuditLog::factory()->create();
        AuditLog::factory()->create();

        $this->visitRoute('audit_logs.index', ['action' => 'edit', 'id' => $auditLog->id]);
        $this->click('del-audit_log-'.$auditLog->id);
        $this->seeRouteIs('audit_logs.index', ['action' => 'delete', 'id' => $auditLog->id]);

        $this->seeInDatabase('audit_logs', [
            'id' => $auditLog->id,
        ]);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('audit_logs', [
            'id' => $auditLog->id,
        ]);
    }
}
