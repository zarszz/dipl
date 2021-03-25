<?php

namespace Tests\Unit\Policies;

use App\Models\Pembayaran;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class PembayaranPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_pembayaran()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Pembayaran));
    }

    /** @test */
    public function user_can_view_pembayaran()
    {
        $user = $this->createUser();
        $pembayaran = Pembayaran::factory()->create();
        $this->assertTrue($user->can('view', $pembayaran));
    }

    /** @test */
    public function user_can_update_pembayaran()
    {
        $user = $this->createUser();
        $pembayaran = Pembayaran::factory()->create();
        $this->assertTrue($user->can('update', $pembayaran));
    }

    /** @test */
    public function user_can_delete_pembayaran()
    {
        $user = $this->createUser();
        $pembayaran = Pembayaran::factory()->create();
        $this->assertTrue($user->can('delete', $pembayaran));
    }
}
