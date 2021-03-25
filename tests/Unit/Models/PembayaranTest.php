<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\Pembayaran;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class PembayaranTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_pembayaran_has_title_link_attribute()
    {
        $pembayaran = Pembayaran::factory()->create();

        $title = __('app.show_detail_title', [
            'title' => $pembayaran->title, 'type' => __('pembayaran.pembayaran'),
        ]);
        $link = '<a href="'.route('pembayarans.show', $pembayaran).'"';
        $link .= ' title="'.$title.'">';
        $link .= $pembayaran->title;
        $link .= '</a>';

        $this->assertEquals($link, $pembayaran->title_link);
    }

    /** @test */
    public function a_pembayaran_has_belongs_to_creator_relation()
    {
        $pembayaran = Pembayaran::factory()->make();

        $this->assertInstanceOf(User::class, $pembayaran->creator);
        $this->assertEquals($pembayaran->creator_id, $pembayaran->creator->id);
    }
}
