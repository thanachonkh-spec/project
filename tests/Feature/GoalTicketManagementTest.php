<?php

namespace Tests\Feature;

use App\Models\GoalTicket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GoalTicketManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_verified_user_can_manage_goal_tickets_and_show_available_matches_on_homepage(): void
    {
        $this->actingAs(User::factory()->create());

        $attributes = [
            'league' => 'Premier League',
            'short' => 'PL',
            'home' => 'Arsenal',
            'away' => 'Liverpool',
            'home_short' => 'ARS',
            'away_short' => 'LIV',
            'home_color' => '#ef4444',
            'away_color' => '#dc2626',
            'match_at' => '2026-10-18T23:30',
            'stadium' => 'Emirates Stadium',
            'price' => '80000',
            'status' => 'AVAILABLE',
            'featured' => '1',
        ];

        $this->get(route('goal-tickets.index'))->assertOk();

        $this->post(route('goal-tickets.store'), $attributes)
            ->assertRedirect();

        $goalTicket = GoalTicket::firstOrFail();
        $this->assertDatabaseHas('goal_tickets', [
            'id' => $goalTicket->id,
            'home' => 'Arsenal',
            'featured' => true,
        ]);

        $this->get(route('goal-tickets.show', $goalTicket))
            ->assertOk()
            ->assertSee('Arsenal');

        $this->get('/')
            ->assertOk()
            ->assertSee('Arsenal')
            ->assertSee('Liverpool');

        $this->put(route('goal-tickets.update', $goalTicket), array_merge($attributes, [
            'home' => 'Manchester City',
            'featured' => '0',
        ]))->assertRedirect(route('goal-tickets.show', $goalTicket));

        $this->assertDatabaseHas('goal_tickets', [
            'id' => $goalTicket->id,
            'home' => 'Manchester City',
            'featured' => false,
        ]);

        $this->delete(route('goal-tickets.destroy', $goalTicket))
            ->assertRedirect(route('goal-tickets.index'));

        $this->assertDatabaseMissing('goal_tickets', ['id' => $goalTicket->id]);
    }

    public function test_goal_ticket_management_requires_a_verified_user(): void
    {
        $this->get(route('goal-tickets.index'))
            ->assertRedirect(route('login'));
    }
}
