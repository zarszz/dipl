<?php

namespace Tests\Feature;

use App\Models\Gudang;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageGudangTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_gudang_list_in_gudang_index_page()
    {
        $gudang = Gudang::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('gudangs.index');
        $this->see($gudang->title);
    }

    /** @test */
    public function user_can_create_a_gudang()
    {
        $this->loginAsUser();
        $this->visitRoute('gudangs.index');

        $this->click(__('gudang.create'));
        $this->seeRouteIs('gudangs.index', ['action' => 'create']);

        $this->submitForm(__('gudang.create'), [
            'title'       => 'Gudang 1 title',
            'description' => 'Gudang 1 description',
        ]);

        $this->seeRouteIs('gudangs.index');

        $this->seeInDatabase('gudangs', [
            'title'       => 'Gudang 1 title',
            'description' => 'Gudang 1 description',
        ]);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Gudang 1 title',
            'description' => 'Gudang 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_gudang_title_is_required()
    {
        $this->loginAsUser();

        // title empty
        $this->post(route('gudangs.store'), $this->getCreateFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_gudang_title_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // title 70 characters
        $this->post(route('gudangs.store'), $this->getCreateFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_gudang_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('gudangs.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_edit_a_gudang_within_search_query()
    {
        $this->loginAsUser();
        $gudang = Gudang::factory()->create(['title' => 'Testing 123']);

        $this->visitRoute('gudangs.index', ['q' => '123']);
        $this->click('edit-gudang-'.$gudang->id);
        $this->seeRouteIs('gudangs.index', ['action' => 'edit', 'id' => $gudang->id, 'q' => '123']);

        $this->submitForm(__('gudang.update'), [
            'title'       => 'Gudang 1 title',
            'description' => 'Gudang 1 description',
        ]);

        $this->seeRouteIs('gudangs.index', ['q' => '123']);

        $this->seeInDatabase('gudangs', [
            'title'       => 'Gudang 1 title',
            'description' => 'Gudang 1 description',
        ]);
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Gudang 1 title',
            'description' => 'Gudang 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_gudang_title_update_is_required()
    {
        $this->loginAsUser();
        $gudang = Gudang::factory()->create(['title' => 'Testing 123']);

        // title empty
        $this->patch(route('gudangs.update', $gudang), $this->getEditFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_gudang_title_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $gudang = Gudang::factory()->create(['title' => 'Testing 123']);

        // title 70 characters
        $this->patch(route('gudangs.update', $gudang), $this->getEditFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_gudang_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $gudang = Gudang::factory()->create(['title' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('gudangs.update', $gudang), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_gudang()
    {
        $this->loginAsUser();
        $gudang = Gudang::factory()->create();
        Gudang::factory()->create();

        $this->visitRoute('gudangs.index', ['action' => 'edit', 'id' => $gudang->id]);
        $this->click('del-gudang-'.$gudang->id);
        $this->seeRouteIs('gudangs.index', ['action' => 'delete', 'id' => $gudang->id]);

        $this->seeInDatabase('gudangs', [
            'id' => $gudang->id,
        ]);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('gudangs', [
            'id' => $gudang->id,
        ]);
    }
}
