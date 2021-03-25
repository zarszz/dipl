<?php

namespace Tests\Feature;

use App\Models\Ruangan;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageRuanganTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_ruangan_list_in_ruangan_index_page()
    {
        $ruangan = Ruangan::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('ruangans.index');
        $this->see($ruangan->title);
    }

    /** @test */
    public function user_can_create_a_ruangan()
    {
        $this->loginAsUser();
        $this->visitRoute('ruangans.index');

        $this->click(__('ruangan.create'));
        $this->seeRouteIs('ruangans.index', ['action' => 'create']);

        $this->submitForm(__('ruangan.create'), [
            'title'       => 'Ruangan 1 title',
            'description' => 'Ruangan 1 description',
        ]);

        $this->seeRouteIs('ruangans.index');

        $this->seeInDatabase('ruangans', [
            'title'       => 'Ruangan 1 title',
            'description' => 'Ruangan 1 description',
        ]);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Ruangan 1 title',
            'description' => 'Ruangan 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_ruangan_title_is_required()
    {
        $this->loginAsUser();

        // title empty
        $this->post(route('ruangans.store'), $this->getCreateFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_ruangan_title_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // title 70 characters
        $this->post(route('ruangans.store'), $this->getCreateFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_ruangan_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('ruangans.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_edit_a_ruangan_within_search_query()
    {
        $this->loginAsUser();
        $ruangan = Ruangan::factory()->create(['title' => 'Testing 123']);

        $this->visitRoute('ruangans.index', ['q' => '123']);
        $this->click('edit-ruangan-'.$ruangan->id);
        $this->seeRouteIs('ruangans.index', ['action' => 'edit', 'id' => $ruangan->id, 'q' => '123']);

        $this->submitForm(__('ruangan.update'), [
            'title'       => 'Ruangan 1 title',
            'description' => 'Ruangan 1 description',
        ]);

        $this->seeRouteIs('ruangans.index', ['q' => '123']);

        $this->seeInDatabase('ruangans', [
            'title'       => 'Ruangan 1 title',
            'description' => 'Ruangan 1 description',
        ]);
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Ruangan 1 title',
            'description' => 'Ruangan 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_ruangan_title_update_is_required()
    {
        $this->loginAsUser();
        $ruangan = Ruangan::factory()->create(['title' => 'Testing 123']);

        // title empty
        $this->patch(route('ruangans.update', $ruangan), $this->getEditFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_ruangan_title_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $ruangan = Ruangan::factory()->create(['title' => 'Testing 123']);

        // title 70 characters
        $this->patch(route('ruangans.update', $ruangan), $this->getEditFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_ruangan_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $ruangan = Ruangan::factory()->create(['title' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('ruangans.update', $ruangan), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_ruangan()
    {
        $this->loginAsUser();
        $ruangan = Ruangan::factory()->create();
        Ruangan::factory()->create();

        $this->visitRoute('ruangans.index', ['action' => 'edit', 'id' => $ruangan->id]);
        $this->click('del-ruangan-'.$ruangan->id);
        $this->seeRouteIs('ruangans.index', ['action' => 'delete', 'id' => $ruangan->id]);

        $this->seeInDatabase('ruangans', [
            'id' => $ruangan->id,
        ]);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('ruangans', [
            'id' => $ruangan->id,
        ]);
    }
}
