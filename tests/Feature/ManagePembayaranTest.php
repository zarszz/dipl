<?php

namespace Tests\Feature;

use App\Models\Pembayaran;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManagePembayaranTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_pembayaran_list_in_pembayaran_index_page()
    {
        $pembayaran = Pembayaran::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('pembayarans.index');
        $this->see($pembayaran->title);
    }

    /** @test */
    public function user_can_create_a_pembayaran()
    {
        $this->loginAsUser();
        $this->visitRoute('pembayarans.index');

        $this->click(__('pembayaran.create'));
        $this->seeRouteIs('pembayarans.index', ['action' => 'create']);

        $this->submitForm(__('pembayaran.create'), [
            'title'       => 'Pembayaran 1 title',
            'description' => 'Pembayaran 1 description',
        ]);

        $this->seeRouteIs('pembayarans.index');

        $this->seeInDatabase('pembayarans', [
            'title'       => 'Pembayaran 1 title',
            'description' => 'Pembayaran 1 description',
        ]);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Pembayaran 1 title',
            'description' => 'Pembayaran 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_pembayaran_title_is_required()
    {
        $this->loginAsUser();

        // title empty
        $this->post(route('pembayarans.store'), $this->getCreateFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_pembayaran_title_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // title 70 characters
        $this->post(route('pembayarans.store'), $this->getCreateFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_pembayaran_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('pembayarans.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_edit_a_pembayaran_within_search_query()
    {
        $this->loginAsUser();
        $pembayaran = Pembayaran::factory()->create(['title' => 'Testing 123']);

        $this->visitRoute('pembayarans.index', ['q' => '123']);
        $this->click('edit-pembayaran-'.$pembayaran->id);
        $this->seeRouteIs('pembayarans.index', ['action' => 'edit', 'id' => $pembayaran->id, 'q' => '123']);

        $this->submitForm(__('pembayaran.update'), [
            'title'       => 'Pembayaran 1 title',
            'description' => 'Pembayaran 1 description',
        ]);

        $this->seeRouteIs('pembayarans.index', ['q' => '123']);

        $this->seeInDatabase('pembayarans', [
            'title'       => 'Pembayaran 1 title',
            'description' => 'Pembayaran 1 description',
        ]);
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Pembayaran 1 title',
            'description' => 'Pembayaran 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_pembayaran_title_update_is_required()
    {
        $this->loginAsUser();
        $pembayaran = Pembayaran::factory()->create(['title' => 'Testing 123']);

        // title empty
        $this->patch(route('pembayarans.update', $pembayaran), $this->getEditFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_pembayaran_title_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $pembayaran = Pembayaran::factory()->create(['title' => 'Testing 123']);

        // title 70 characters
        $this->patch(route('pembayarans.update', $pembayaran), $this->getEditFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_pembayaran_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $pembayaran = Pembayaran::factory()->create(['title' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('pembayarans.update', $pembayaran), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_pembayaran()
    {
        $this->loginAsUser();
        $pembayaran = Pembayaran::factory()->create();
        Pembayaran::factory()->create();

        $this->visitRoute('pembayarans.index', ['action' => 'edit', 'id' => $pembayaran->id]);
        $this->click('del-pembayaran-'.$pembayaran->id);
        $this->seeRouteIs('pembayarans.index', ['action' => 'delete', 'id' => $pembayaran->id]);

        $this->seeInDatabase('pembayarans', [
            'id' => $pembayaran->id,
        ]);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('pembayarans', [
            'id' => $pembayaran->id,
        ]);
    }
}
