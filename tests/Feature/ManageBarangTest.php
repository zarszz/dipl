<?php

namespace Tests\Feature;

use App\Models\Barang;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageBarangTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_barang_list_in_barang_index_page()
    {
        $barang = Barang::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('barangs.index');
        $this->see($barang->title);
    }

    /** @test */
    public function user_can_create_a_barang()
    {
        $this->loginAsUser();
        $this->visitRoute('barangs.index');

        $this->click(__('barang.create'));
        $this->seeRouteIs('barangs.index', ['action' => 'create']);

        $this->submitForm(__('barang.create'), [
            'title'       => 'Barang 1 title',
            'description' => 'Barang 1 description',
        ]);

        $this->seeRouteIs('barangs.index');

        $this->seeInDatabase('barangs', [
            'title'       => 'Barang 1 title',
            'description' => 'Barang 1 description',
        ]);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Barang 1 title',
            'description' => 'Barang 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_barang_title_is_required()
    {
        $this->loginAsUser();

        // title empty
        $this->post(route('barangs.store'), $this->getCreateFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_barang_title_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // title 70 characters
        $this->post(route('barangs.store'), $this->getCreateFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_barang_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('barangs.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_edit_a_barang_within_search_query()
    {
        $this->loginAsUser();
        $barang = Barang::factory()->create(['title' => 'Testing 123']);

        $this->visitRoute('barangs.index', ['q' => '123']);
        $this->click('edit-barang-'.$barang->id);
        $this->seeRouteIs('barangs.index', ['action' => 'edit', 'id' => $barang->id, 'q' => '123']);

        $this->submitForm(__('barang.update'), [
            'title'       => 'Barang 1 title',
            'description' => 'Barang 1 description',
        ]);

        $this->seeRouteIs('barangs.index', ['q' => '123']);

        $this->seeInDatabase('barangs', [
            'title'       => 'Barang 1 title',
            'description' => 'Barang 1 description',
        ]);
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Barang 1 title',
            'description' => 'Barang 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_barang_title_update_is_required()
    {
        $this->loginAsUser();
        $barang = Barang::factory()->create(['title' => 'Testing 123']);

        // title empty
        $this->patch(route('barangs.update', $barang), $this->getEditFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_barang_title_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $barang = Barang::factory()->create(['title' => 'Testing 123']);

        // title 70 characters
        $this->patch(route('barangs.update', $barang), $this->getEditFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_barang_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $barang = Barang::factory()->create(['title' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('barangs.update', $barang), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_barang()
    {
        $this->loginAsUser();
        $barang = Barang::factory()->create();
        Barang::factory()->create();

        $this->visitRoute('barangs.index', ['action' => 'edit', 'id' => $barang->id]);
        $this->click('del-barang-'.$barang->id);
        $this->seeRouteIs('barangs.index', ['action' => 'delete', 'id' => $barang->id]);

        $this->seeInDatabase('barangs', [
            'id' => $barang->id,
        ]);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('barangs', [
            'id' => $barang->id,
        ]);
    }
}
