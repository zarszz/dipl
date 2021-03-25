<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_role_has_title_link_attribute()
    {
        $role = Role::factory()->create();

        $title = __('app.show_detail_title', [
            'title' => $role->title, 'type' => __('role.role'),
        ]);
        $link = '<a href="'.route('roles.show', $role).'"';
        $link .= ' title="'.$title.'">';
        $link .= $role->title;
        $link .= '</a>';

        $this->assertEquals($link, $role->title_link);
    }

    /** @test */
    public function a_role_has_belongs_to_creator_relation()
    {
        $role = Role::factory()->make();

        $this->assertInstanceOf(User::class, $role->creator);
        $this->assertEquals($role->creator_id, $role->creator->id);
    }
}
