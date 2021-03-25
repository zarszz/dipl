<?php

namespace Tests\Feature;

use App\Models\Role;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageRoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_role_list_in_role_index_page()
    {
        $role = Role::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('roles.index');
        $this->see($role->title);
    }

    /** @test */
    public function user_can_create_a_role()
    {
        $this->loginAsUser();
        $this->visitRoute('roles.index');

        $this->click(__('role.create'));
        $this->seeRouteIs('roles.index', ['action' => 'create']);

        $this->submitForm(__('role.create'), [
            'title'       => 'Role 1 title',
            'description' => 'Role 1 description',
        ]);

        $this->seeRouteIs('roles.index');

        $this->seeInDatabase('roles', [
            'title'       => 'Role 1 title',
            'description' => 'Role 1 description',
        ]);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Role 1 title',
            'description' => 'Role 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_role_title_is_required()
    {
        $this->loginAsUser();

        // title empty
        $this->post(route('roles.store'), $this->getCreateFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_role_title_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // title 70 characters
        $this->post(route('roles.store'), $this->getCreateFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_role_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('roles.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_edit_a_role_within_search_query()
    {
        $this->loginAsUser();
        $role = Role::factory()->create(['title' => 'Testing 123']);

        $this->visitRoute('roles.index', ['q' => '123']);
        $this->click('edit-role-'.$role->id);
        $this->seeRouteIs('roles.index', ['action' => 'edit', 'id' => $role->id, 'q' => '123']);

        $this->submitForm(__('role.update'), [
            'title'       => 'Role 1 title',
            'description' => 'Role 1 description',
        ]);

        $this->seeRouteIs('roles.index', ['q' => '123']);

        $this->seeInDatabase('roles', [
            'title'       => 'Role 1 title',
            'description' => 'Role 1 description',
        ]);
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Role 1 title',
            'description' => 'Role 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_role_title_update_is_required()
    {
        $this->loginAsUser();
        $role = Role::factory()->create(['title' => 'Testing 123']);

        // title empty
        $this->patch(route('roles.update', $role), $this->getEditFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_role_title_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $role = Role::factory()->create(['title' => 'Testing 123']);

        // title 70 characters
        $this->patch(route('roles.update', $role), $this->getEditFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_role_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $role = Role::factory()->create(['title' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('roles.update', $role), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_role()
    {
        $this->loginAsUser();
        $role = Role::factory()->create();
        Role::factory()->create();

        $this->visitRoute('roles.index', ['action' => 'edit', 'id' => $role->id]);
        $this->click('del-role-'.$role->id);
        $this->seeRouteIs('roles.index', ['action' => 'delete', 'id' => $role->id]);

        $this->seeInDatabase('roles', [
            'id' => $role->id,
        ]);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('roles', [
            'id' => $role->id,
        ]);
    }
}
