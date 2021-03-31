<?php

namespace Tests\Unit\Policies;

use App\Models\Gudang;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class GudangPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_gudang()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Gudang));
    }

    /** @test */
    public function user_can_view_gudang()
    {
        $user = $this->createUser();
        $gudang = Gudang::factory()->create();
        $this->assertTrue($user->can('view', $gudang));
    }

    /** @test */
    public function user_can_update_gudang()
    {
        $user = $this->createUser();
        $gudang = Gudang::factory()->create();
        $this->assertTrue($user->can('update', $gudang));
    }

    /** @test */
    public function user_can_delete_gudang()
    {
        $user = $this->createUser();
        $gudang = Gudang::factory()->create();
        $this->assertTrue($user->can('delete', $gudang));
    }
}
