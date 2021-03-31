<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class BarangTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_barang_has_title_link_attribute()
    {
        $barang = Barang::factory()->create();

        $title = __('app.show_detail_title', [
            'title' => $barang->title, 'type' => __('barang.barang'),
        ]);
        $link = '<a href="'.route('barangs.show', $barang).'"';
        $link .= ' title="'.$title.'">';
        $link .= $barang->title;
        $link .= '</a>';

        $this->assertEquals($link, $barang->title_link);
    }

    /** @test */
    public function a_barang_has_belongs_to_creator_relation()
    {
        $barang = Barang::factory()->make();

        $this->assertInstanceOf(User::class, $barang->creator);
        $this->assertEquals($barang->creator_id, $barang->creator->id);
    }
}
