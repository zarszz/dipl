<?php

namespace Tests\Unit\Policies;

use App\Models\Ticketing;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class TicketingPolicyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_ticketing()
    {
        $user = $this->createUser();
        $this->assertTrue($user->can('create', new Ticketing));
    }

    /** @test */
    public function user_can_view_ticketing()
    {
        $user = $this->createUser();
        $ticketing = Ticketing::factory()->create();
        $this->assertTrue($user->can('view', $ticketing));
    }

    /** @test */
    public function user_can_update_ticketing()
    {
        $user = $this->createUser();
        $ticketing = Ticketing::factory()->create();
        $this->assertTrue($user->can('update', $ticketing));
    }

    /** @test */
    public function user_can_delete_ticketing()
    {
        $user = $this->createUser();
        $ticketing = Ticketing::factory()->create();
        $this->assertTrue($user->can('delete', $ticketing));
    }
}
