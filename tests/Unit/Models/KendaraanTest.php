<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Kendaraan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class KendaraanTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_kendaraan_has_title_link_attribute()
    {
        $kendaraan = Kendaraan::factory()->create();

        $title = __('app.show_detail_title', [
            'title' => $kendaraan->title, 'type' => __('kendaraan.kendaraan'),
        ]);
        $link = '<a href="'.route('kendaraans.show', $kendaraan).'"';
        $link .= ' title="'.$title.'">';
        $link .= $kendaraan->title;
        $link .= '</a>';

        $this->assertEquals($link, $kendaraan->title_link);
    }

    /** @test */
    public function a_kendaraan_has_belongs_to_creator_relation()
    {
        $kendaraan = Kendaraan::factory()->make();

        $this->assertInstanceOf(User::class, $kendaraan->creator);
        $this->assertEquals($kendaraan->creator_id, $kendaraan->creator->id);
    }
}
