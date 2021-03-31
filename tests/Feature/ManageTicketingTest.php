<?php

namespace Tests\Feature;

use App\Models\Ticketing;
use Tests\BrowserKitTest as TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageTicketingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_ticketing_list_in_ticketing_index_page()
    {
        $ticketing = Ticketing::factory()->create();

        $this->loginAsUser();
        $this->visitRoute('ticketings.index');
        $this->see($ticketing->title);
    }

    /** @test */
    public function user_can_create_a_ticketing()
    {
        $this->loginAsUser();
        $this->visitRoute('ticketings.index');

        $this->click(__('ticketing.create'));
        $this->seeRouteIs('ticketings.index', ['action' => 'create']);

        $this->submitForm(__('ticketing.create'), [
            'title'       => 'Ticketing 1 title',
            'description' => 'Ticketing 1 description',
        ]);

        $this->seeRouteIs('ticketings.index');

        $this->seeInDatabase('ticketings', [
            'title'       => 'Ticketing 1 title',
            'description' => 'Ticketing 1 description',
        ]);
    }

    private function getCreateFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Ticketing 1 title',
            'description' => 'Ticketing 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_ticketing_title_is_required()
    {
        $this->loginAsUser();

        // title empty
        $this->post(route('ticketings.store'), $this->getCreateFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_ticketing_title_is_not_more_than_60_characters()
    {
        $this->loginAsUser();

        // title 70 characters
        $this->post(route('ticketings.store'), $this->getCreateFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_ticketing_description_is_not_more_than_255_characters()
    {
        $this->loginAsUser();

        // description 256 characters
        $this->post(route('ticketings.store'), $this->getCreateFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_edit_a_ticketing_within_search_query()
    {
        $this->loginAsUser();
        $ticketing = Ticketing::factory()->create(['title' => 'Testing 123']);

        $this->visitRoute('ticketings.index', ['q' => '123']);
        $this->click('edit-ticketing-'.$ticketing->id);
        $this->seeRouteIs('ticketings.index', ['action' => 'edit', 'id' => $ticketing->id, 'q' => '123']);

        $this->submitForm(__('ticketing.update'), [
            'title'       => 'Ticketing 1 title',
            'description' => 'Ticketing 1 description',
        ]);

        $this->seeRouteIs('ticketings.index', ['q' => '123']);

        $this->seeInDatabase('ticketings', [
            'title'       => 'Ticketing 1 title',
            'description' => 'Ticketing 1 description',
        ]);
    }

    private function getEditFields(array $overrides = [])
    {
        return array_merge([
            'title'       => 'Ticketing 1 title',
            'description' => 'Ticketing 1 description',
        ], $overrides);
    }

    /** @test */
    public function validate_ticketing_title_update_is_required()
    {
        $this->loginAsUser();
        $ticketing = Ticketing::factory()->create(['title' => 'Testing 123']);

        // title empty
        $this->patch(route('ticketings.update', $ticketing), $this->getEditFields(['title' => '']));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_ticketing_title_update_is_not_more_than_60_characters()
    {
        $this->loginAsUser();
        $ticketing = Ticketing::factory()->create(['title' => 'Testing 123']);

        // title 70 characters
        $this->patch(route('ticketings.update', $ticketing), $this->getEditFields([
            'title' => str_repeat('Test Title', 7),
        ]));
        $this->assertSessionHasErrors('title');
    }

    /** @test */
    public function validate_ticketing_description_update_is_not_more_than_255_characters()
    {
        $this->loginAsUser();
        $ticketing = Ticketing::factory()->create(['title' => 'Testing 123']);

        // description 256 characters
        $this->patch(route('ticketings.update', $ticketing), $this->getEditFields([
            'description' => str_repeat('Long description', 16),
        ]));
        $this->assertSessionHasErrors('description');
    }

    /** @test */
    public function user_can_delete_a_ticketing()
    {
        $this->loginAsUser();
        $ticketing = Ticketing::factory()->create();
        Ticketing::factory()->create();

        $this->visitRoute('ticketings.index', ['action' => 'edit', 'id' => $ticketing->id]);
        $this->click('del-ticketing-'.$ticketing->id);
        $this->seeRouteIs('ticketings.index', ['action' => 'delete', 'id' => $ticketing->id]);

        $this->seeInDatabase('ticketings', [
            'id' => $ticketing->id,
        ]);

        $this->press(__('app.delete_confirm_button'));

        $this->dontSeeInDatabase('ticketings', [
            'id' => $ticketing->id,
        ]);
    }
}
