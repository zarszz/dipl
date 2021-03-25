<?php

namespace Tests\Unit\Policies;

use App\Models\Ruangan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class RuanganPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_ruangan()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Ruangan));
    }

    /** @test */
    public function user_can_view_ruangan()
    {
        $user = $this->createUser();
        $ruangan = Ruangan::factory()->create();
        $this->assertTrue($user->can('view', $ruangan));
    }

    /** @test */
    public function user_can_update_ruangan()
    {
        $user = $this->createUser();
        $ruangan = Ruangan::factory()->create();
        $this->assertTrue($user->can('update', $ruangan));
    }

    /** @test */
    public function user_can_delete_ruangan()
    {
        $user = $this->createUser();
        $ruangan = Ruangan::factory()->create();
        $this->assertTrue($user->can('delete', $ruangan));
    }
}
