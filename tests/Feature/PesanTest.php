<?php

namespace Tests\Feature;

use App\Models\FormEmail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PesanTest extends TestCase
{
    use RefreshDatabase;

    public function test_inbox_requires_authentication()
    {
        $this->get(route('pesan.index'))
            ->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_view_inbox()
    {
        $this->actingAs(User::factory()->create());

        FormEmail::create([
            'nama' => 'Pengirim',
            'email' => 'sender@example.com',
            'subjek' => 'Kolaborasi',
            'pesan' => 'Mari berdiskusi.',
        ]);

        $this->get(route('pesan.index'))
            ->assertOk()
            ->assertSee('Pesan Masuk')
            ->assertSee('sender@example.com')
            ->assertSee('Mari berdiskusi.');
    }

    public function test_contact_form_stores_message_and_returns_home()
    {
        $this->post(route('pesan.store'), [
            'name' => 'Pengirim',
            'email' => 'sender@example.com',
            'subjek' => 'Kolaborasi',
            'pesan' => 'Mari berdiskusi.',
        ])
            ->assertRedirect('/')
            ->assertSessionHas('status');

        $this->assertDatabaseHas('form_email', [
            'nama' => 'Pengirim',
            'email' => 'sender@example.com',
            'subjek' => 'Kolaborasi',
            'pesan' => 'Mari berdiskusi.',
        ]);
    }
}
