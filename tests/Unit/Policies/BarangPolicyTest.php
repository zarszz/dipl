<?php

namespace Tests\Unit\Policies;

use App\Models\Barang;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class BarangPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_barang()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Barang));
    }

    /** @test */
    public function user_can_view_barang()
    {
        $user = $this->createUser();
        $barang = Barang::factory()->create();
        $this->assertTrue($user->can('view', $barang));
    }

    /** @test */
    public function user_can_update_barang()
    {
        $user = $this->createUser();
        $barang = Barang::factory()->create();
        $this->assertTrue($user->can('update', $barang));
    }

    /** @test */
    public function user_can_delete_barang()
    {
        $user = $this->createUser();
        $barang = Barang::factory()->create();
        $this->assertTrue($user->can('delete', $barang));
    }
}
