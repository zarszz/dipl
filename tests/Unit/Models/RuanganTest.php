<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Ruangan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class RuanganTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_ruangan_has_title_link_attribute()
    {
        $ruangan = Ruangan::factory()->create();

        $title = __('app.show_detail_title', [
            'title' => $ruangan->title, 'type' => __('ruangan.ruangan'),
        ]);
        $link = '<a href="'.route('ruangans.show', $ruangan).'"';
        $link .= ' title="'.$title.'">';
        $link .= $ruangan->title;
        $link .= '</a>';

        $this->assertEquals($link, $ruangan->title_link);
    }

    /** @test */
    public function a_ruangan_has_belongs_to_creator_relation()
    {
        $ruangan = Ruangan::factory()->make();

        $this->assertInstanceOf(User::class, $ruangan->creator);
        $this->assertEquals($ruangan->creator_id, $ruangan->creator->id);
    }
}
