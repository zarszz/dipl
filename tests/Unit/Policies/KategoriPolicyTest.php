<?php

namespace Tests\Unit\Policies;

use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class KategoriPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_kategori()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Kategori));
    }

    /** @test */
    public function user_can_view_kategori()
    {
        $user = $this->createUser();
        $kategori = Kategori::factory()->create();
        $this->assertTrue($user->can('view', $kategori));
    }

    /** @test */
    public function user_can_update_kategori()
    {
        $user = $this->createUser();
        $kategori = Kategori::factory()->create();
        $this->assertTrue($user->can('update', $kategori));
    }

    /** @test */
    public function user_can_delete_kategori()
    {
        $user = $this->createUser();
        $kategori = Kategori::factory()->create();
        $this->assertTrue($user->can('delete', $kategori));
    }
}
