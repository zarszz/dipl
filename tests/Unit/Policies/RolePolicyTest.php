<?php

namespace Tests\Unit\Policies;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class RolePolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_role()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Role));
    }

    /** @test */
    public function user_can_view_role()
    {
        $user = $this->createUser();
        $role = Role::factory()->create();
        $this->assertTrue($user->can('view', $role));
    }

    /** @test */
    public function user_can_update_role()
    {
        $user = $this->createUser();
        $role = Role::factory()->create();
        $this->assertTrue($user->can('update', $role));
    }

    /** @test */
    public function user_can_delete_role()
    {
        $user = $this->createUser();
        $role = Role::factory()->create();
        $this->assertTrue($user->can('delete', $role));
    }
}
