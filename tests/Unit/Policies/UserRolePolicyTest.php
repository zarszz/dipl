<?php

namespace Tests\Unit\Policies;

use App\Models\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class UserRolePolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_user_role()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new UserRole));
    }

    /** @test */
    public function user_can_view_user_role()
    {
        $user = $this->createUser();
        $userRole = UserRole::factory()->create();
        $this->assertTrue($user->can('view', $userRole));
    }

    /** @test */
    public function user_can_update_user_role()
    {
        $user = $this->createUser();
        $userRole = UserRole::factory()->create();
        $this->assertTrue($user->can('update', $userRole));
    }

    /** @test */
    public function user_can_delete_user_role()
    {
        $user = $this->createUser();
        $userRole = UserRole::factory()->create();
        $this->assertTrue($user->can('delete', $userRole));
    }
}
