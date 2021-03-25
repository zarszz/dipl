<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Ticketing;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class TicketingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_ticketing_has_title_link_attribute()
    {
        $ticketing = Ticketing::factory()->create();

        $title = __('app.show_detail_title', [
            'title' => $ticketing->title, 'type' => __('ticketing.ticketing'),
        ]);
        $link = '<a href="'.route('ticketings.show', $ticketing).'"';
        $link .= ' title="'.$title.'">';
        $link .= $ticketing->title;
        $link .= '</a>';

        $this->assertEquals($link, $ticketing->title_link);
    }

    /** @test */
    public function a_ticketing_has_belongs_to_creator_relation()
    {
        $ticketing = Ticketing::factory()->make();

        $this->assertInstanceOf(User::class, $ticketing->creator);
        $this->assertEquals($ticketing->creator_id, $ticketing->creator->id);
    }
}
