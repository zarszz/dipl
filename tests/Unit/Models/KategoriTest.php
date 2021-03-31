<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class KategoriTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_kategori_has_title_link_attribute()
    {
        $kategori = Kategori::factory()->create();

        $title = __('app.show_detail_title', [
            'title' => $kategori->title, 'type' => __('kategori.kategori'),
        ]);
        $link = '<a href="'.route('kategoris.show', $kategori).'"';
        $link .= ' title="'.$title.'">';
        $link .= $kategori->title;
        $link .= '</a>';

        $this->assertEquals($link, $kategori->title_link);
    }

    /** @test */
    public function a_kategori_has_belongs_to_creator_relation()
    {
        $kategori = Kategori::factory()->make();

        $this->assertInstanceOf(User::class, $kategori->creator);
        $this->assertEquals($kategori->creator_id, $kategori->creator->id);
    }
}
