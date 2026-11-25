<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_open_dashboard_and_skill_manager()
    {
        $this->actingAs(User::factory()->create());

        $this->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Dashboard')
            ->assertSee('Kelola Skill');

        $this->get(route('skills.index'))
            ->assertOk()
            ->assertSee('Kelola Data Skill')
            ->assertSee('Tambah Skill Baru');
    }
}
