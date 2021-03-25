<?php

namespace Tests\Feature;

use App\Models\Kendaraan;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageKendaraanTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_kendaraan_list_in_kendaraan_index_page()
    {
        $kendaraan = Kendaraan::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('kendaraans.index');
        $this->see($kendaraan->title);
    }

    /** @test */
    public function user_can_create_a_kendaraan()
    {
        $this->loginAsUser();
        $this->visitRoute('kendaraans.index');

        $this->click(__('kendaraan.create'));
        $this->seeRouteIs('kendaraans.index', ['action' => 'create']);

        $this->submitForm(__('kendaraan.create'), [
            'title'       => 'Kendaraan 1 title',
            'description' => 'Kendaraan 1 description',
        ]);

        $this->seeRouteIs('kendaraans.index');

        $this->seeInDatabase('kendaraans', [
            'title'       => 'Kendaraan 1 title',
            'description' => 'Kendaraan 1 description',
        ]);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Kendaraan 1 title',
            'description' => 'Kendaraan 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_kendaraan_title_is_required()
    {
        $this->loginAsUser();

        // title empty
        $this->post(route('kendaraans.store'), $this->getCreateFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_kendaraan_title_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // title 70 characters
        $this->post(route('kendaraans.store'), $this->getCreateFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_kendaraan_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('kendaraans.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_edit_a_kendaraan_within_search_query()
    {
        $this->loginAsUser();
        $kendaraan = Kendaraan::factory()->create(['title' => 'Testing 123']);

        $this->visitRoute('kendaraans.index', ['q' => '123']);
        $this->click('edit-kendaraan-'.$kendaraan->id);
        $this->seeRouteIs('kendaraans.index', ['action' => 'edit', 'id' => $kendaraan->id, 'q' => '123']);

        $this->submitForm(__('kendaraan.update'), [
            'title'       => 'Kendaraan 1 title',
            'description' => 'Kendaraan 1 description',
        ]);

        $this->seeRouteIs('kendaraans.index', ['q' => '123']);

        $this->seeInDatabase('kendaraans', [
            'title'       => 'Kendaraan 1 title',
            'description' => 'Kendaraan 1 description',
        ]);
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Kendaraan 1 title',
            'description' => 'Kendaraan 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_kendaraan_title_update_is_required()
    {
        $this->loginAsUser();
        $kendaraan = Kendaraan::factory()->create(['title' => 'Testing 123']);

        // title empty
        $this->patch(route('kendaraans.update', $kendaraan), $this->getEditFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_kendaraan_title_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $kendaraan = Kendaraan::factory()->create(['title' => 'Testing 123']);

        // title 70 characters
        $this->patch(route('kendaraans.update', $kendaraan), $this->getEditFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_kendaraan_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $kendaraan = Kendaraan::factory()->create(['title' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('kendaraans.update', $kendaraan), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_kendaraan()
    {
        $this->loginAsUser();
        $kendaraan = Kendaraan::factory()->create();
        Kendaraan::factory()->create();

        $this->visitRoute('kendaraans.index', ['action' => 'edit', 'id' => $kendaraan->id]);
        $this->click('del-kendaraan-'.$kendaraan->id);
        $this->seeRouteIs('kendaraans.index', ['action' => 'delete', 'id' => $kendaraan->id]);

        $this->seeInDatabase('kendaraans', [
            'id' => $kendaraan->id,
        ]);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('kendaraans', [
            'id' => $kendaraan->id,
        ]);
    }
}
