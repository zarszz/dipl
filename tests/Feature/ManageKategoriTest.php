<?php

namespace Tests\Feature;

use App\Models\Kategori;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageKategoriTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_kategori_list_in_kategori_index_page()
    {
        $kategori = Kategori::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('kategoris.index');
        $this->see($kategori->title);
    }

    /** @test */
    public function user_can_create_a_kategori()
    {
        $this->loginAsUser();
        $this->visitRoute('kategoris.index');

        $this->click(__('kategori.create'));
        $this->seeRouteIs('kategoris.index', ['action' => 'create']);

        $this->submitForm(__('kategori.create'), [
            'title'       => 'Kategori 1 title',
            'description' => 'Kategori 1 description',
        ]);

        $this->seeRouteIs('kategoris.index');

        $this->seeInDatabase('kategoris', [
            'title'       => 'Kategori 1 title',
            'description' => 'Kategori 1 description',
        ]);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Kategori 1 title',
            'description' => 'Kategori 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_kategori_title_is_required()
    {
        $this->loginAsUser();

        // title empty
        $this->post(route('kategoris.store'), $this->getCreateFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_kategori_title_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // title 70 characters
        $this->post(route('kategoris.store'), $this->getCreateFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_kategori_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('kategoris.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_edit_a_kategori_within_search_query()
    {
        $this->loginAsUser();
        $kategori = Kategori::factory()->create(['title' => 'Testing 123']);

        $this->visitRoute('kategoris.index', ['q' => '123']);
        $this->click('edit-kategori-'.$kategori->id);
        $this->seeRouteIs('kategoris.index', ['action' => 'edit', 'id' => $kategori->id, 'q' => '123']);

        $this->submitForm(__('kategori.update'), [
            'title'       => 'Kategori 1 title',
            'description' => 'Kategori 1 description',
        ]);

        $this->seeRouteIs('kategoris.index', ['q' => '123']);

        $this->seeInDatabase('kategoris', [
            'title'       => 'Kategori 1 title',
            'description' => 'Kategori 1 description',
        ]);
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Kategori 1 title',
            'description' => 'Kategori 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_kategori_title_update_is_required()
    {
        $this->loginAsUser();
        $kategori = Kategori::factory()->create(['title' => 'Testing 123']);

        // title empty
        $this->patch(route('kategoris.update', $kategori), $this->getEditFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_kategori_title_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $kategori = Kategori::factory()->create(['title' => 'Testing 123']);

        // title 70 characters
        $this->patch(route('kategoris.update', $kategori), $this->getEditFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_kategori_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $kategori = Kategori::factory()->create(['title' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('kategoris.update', $kategori), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_kategori()
    {
        $this->loginAsUser();
        $kategori = Kategori::factory()->create();
        Kategori::factory()->create();

        $this->visitRoute('kategoris.index', ['action' => 'edit', 'id' => $kategori->id]);
        $this->click('del-kategori-'.$kategori->id);
        $this->seeRouteIs('kategoris.index', ['action' => 'delete', 'id' => $kategori->id]);

        $this->seeInDatabase('kategoris', [
            'id' => $kategori->id,
        ]);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('kategoris', [
            'id' => $kategori->id,
        ]);
    }
}
