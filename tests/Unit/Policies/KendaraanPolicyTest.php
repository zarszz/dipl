<?php

namespace Tests\Unit\Policies;

use App\Models\Kendaraan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class KendaraanPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_kendaraan()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Kendaraan));
    }

    /** @test */
    public function user_can_view_kendaraan()
    {
        $user = $this->createUser();
        $kendaraan = Kendaraan::factory()->create();
        $this->assertTrue($user->can('view', $kendaraan));
    }

    /** @test */
    public function user_can_update_kendaraan()
    {
        $user = $this->createUser();
        $kendaraan = Kendaraan::factory()->create();
        $this->assertTrue($user->can('update', $kendaraan));
    }

    /** @test */
    public function user_can_delete_kendaraan()
    {
        $user = $this->createUser();
        $kendaraan = Kendaraan::factory()->create();
        $this->assertTrue($user->can('delete', $kendaraan));
    }
}
