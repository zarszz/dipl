<?php

namespace Tests\Feature;

use App\Models\UserRole;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageUserRoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_user_role_list_in_user_role_index_page()
    {
        $userRole = UserRole::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('user_roles.index');
        $this->see($userRole->title);
    }

    /** @test */
    public function user_can_create_a_user_role()
    {
        $this->loginAsUser();
        $this->visitRoute('user_roles.index');

        $this->click(__('user_role.create'));
        $this->seeRouteIs('user_roles.index', ['action' => 'create']);

        $this->submitForm(__('user_role.create'), [
            'title'       => 'UserRole 1 title',
            'description' => 'UserRole 1 description',
        ]);

        $this->seeRouteIs('user_roles.index');

        $this->seeInDatabase('user_roles', [
            'title'       => 'UserRole 1 title',
            'description' => 'UserRole 1 description',
        ]);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'UserRole 1 title',
            'description' => 'UserRole 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_user_role_title_is_required()
    {
        $this->loginAsUser();

        // title empty
        $this->post(route('user_roles.store'), $this->getCreateFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_user_role_title_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // title 70 characters
        $this->post(route('user_roles.store'), $this->getCreateFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_user_role_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('user_roles.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_edit_a_user_role_within_search_query()
    {
        $this->loginAsUser();
        $userRole = UserRole::factory()->create(['title' => 'Testing 123']);

        $this->visitRoute('user_roles.index', ['q' => '123']);
        $this->click('edit-user_role-'.$userRole->id);
        $this->seeRouteIs('user_roles.index', ['action' => 'edit', 'id' => $userRole->id, 'q' => '123']);

        $this->submitForm(__('user_role.update'), [
            'title'       => 'UserRole 1 title',
            'description' => 'UserRole 1 description',
        ]);

        $this->seeRouteIs('user_roles.index', ['q' => '123']);

        $this->seeInDatabase('user_roles', [
            'title'       => 'UserRole 1 title',
            'description' => 'UserRole 1 description',
        ]);
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'UserRole 1 title',
            'description' => 'UserRole 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_user_role_title_update_is_required()
    {
        $this->loginAsUser();
        $user_role = UserRole::factory()->create(['title' => 'Testing 123']);

        // title empty
        $this->patch(route('user_roles.update', $user_role), $this->getEditFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_user_role_title_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $user_role = UserRole::factory()->create(['title' => 'Testing 123']);

        // title 70 characters
        $this->patch(route('user_roles.update', $user_role), $this->getEditFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_user_role_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $user_role = UserRole::factory()->create(['title' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('user_roles.update', $user_role), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_user_role()
    {
        $this->loginAsUser();
        $userRole = UserRole::factory()->create();
        UserRole::factory()->create();

        $this->visitRoute('user_roles.index', ['action' => 'edit', 'id' => $userRole->id]);
        $this->click('del-user_role-'.$userRole->id);
        $this->seeRouteIs('user_roles.index', ['action' => 'delete', 'id' => $userRole->id]);

        $this->seeInDatabase('user_roles', [
            'id' => $userRole->id,
        ]);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('user_roles', [
            'id' => $userRole->id,
        ]);
    }
}
