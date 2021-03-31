<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Gudang;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class GudangTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_gudang_has_title_link_attribute()
    {
        $gudang = Gudang::factory()->create();

        $title = __('app.show_detail_title', [
            'title' => $gudang->title, 'type' => __('gudang.gudang'),
        ]);
        $link = '<a href="'.route('gudangs.show', $gudang).'"';
        $link .= ' title="'.$title.'">';
        $link .= $gudang->title;
        $link .= '</a>';

        $this->assertEquals($link, $gudang->title_link);
    }

    /** @test */
    public function a_gudang_has_belongs_to_creator_relation()
    {
        $gudang = Gudang::factory()->make();

        $this->assertInstanceOf(User::class, $gudang->creator);
        $this->assertEquals($gudang->creator_id, $gudang->creator->id);
    }
}
