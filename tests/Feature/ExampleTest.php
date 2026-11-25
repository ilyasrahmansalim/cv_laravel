<?php

namespace Tests\Feature;

use App\Models\Expertise;
use App\Models\PortfolioProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_remains_available_without_profile_data()
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Portfolio Owner')
            ->assertSee('Profil portfolio belum dikonfigurasi.');
    }

    public function test_homepage_displays_profile_and_expertise_from_database()
    {
        PortfolioProfile::create([
            'nama' => 'Database Portfolio Name',
            'nrp' => '123456',
            'prodi' => 'Database Program',
            'email' => 'portfolio@example.test',
            'posisi' => 'Database Position',
            'deskripsi' => 'Database profile description.',
            'status' => true,
        ]);
        Expertise::create([
            'judul' => 'Database Expertise',
            'deskripsi' => 'Expertise content stored in the database.',
            'urutan' => 1,
        ]);

        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Database Portfolio Name')
            ->assertSee('Database profile description.')
            ->assertSee('Database Expertise')
            ->assertSee('Expertise content stored in the database.');
    }
}
