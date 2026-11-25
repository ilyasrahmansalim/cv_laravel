<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Education;
use App\Models\Expertise;
use App\Models\PortfolioProfile;
use App\Models\Project;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        PortfolioProfile::updateOrCreate(
            ['id' => 1],
            [
                'nama' => 'Ilyas Rahman Salim',
                'nrp' => '5325600063',
                'prodi' => 'Teknologi Rekayasa Multimedia',
                'email' => 'ilyas.rahman.salim@gmail.com',
                'posisi' => 'Front-End Web Dev & Graphic Designer',
                'deskripsi' => 'Ilyas Rahman Salim is a dedicated Front-End Web Developer and Graphic Designer focused on professional brand design and interactive web interfaces. Combining modern technical development stacks with robust visual aesthetics, I am committed to delivering digital solutions that are both technically reliable and visually compelling.',
                'status' => true,
                'foto' => 'img/foto-ilyas.png',
            ]
        );

        $expertises = [
            [
                'judul' => 'Front-End Web Dev',
                'deskripsi' => 'Building responsive, interactive, and high-performance modern user interfaces.',
                'gambar' => 'img/web.png',
                'urutan' => 1,
            ],
            [
                'judul' => 'Graphic Designer',
                'deskripsi' => 'Designing strong visual identities, professional branding, and creative layouts.',
                'gambar' => 'img/brand-design.png',
                'urutan' => 2,
            ],
            [
                'judul' => 'Social Media Designer',
                'deskripsi' => 'Creating strategic digital publication assets and engaging promotional media.',
                'gambar' => 'img/sosmed-design.png',
                'urutan' => 3,
            ],
        ];

        foreach ($expertises as $expertise) {
            Expertise::updateOrCreate(
                ['judul' => $expertise['judul']],
                $expertise
            );
        }

        $experiences = [
            [
                'posisi' => 'Staff Media & Information',
                'instansi' => 'UKM Software Development',
                'tahun' => 'NOW',
                'deskripsi' => 'Managing digital content publication, information media, and visual design assets for organizational programs.',
                'logo' => 'img/softdev-logo.png',
            ],
            [
                'posisi' => 'Staff Creative Media & Information',
                'instansi' => 'IEEE SB PENS',
                'tahun' => 'NOW',
                'deskripsi' => 'Designing creative visual strategies and publication campaigns for campus-level organizational events.',
                'logo' => 'img/ieee-logo.png',
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::updateOrCreate(
                [
                    'posisi' => $experience['posisi'],
                    'instansi' => $experience['instansi'],
                ],
                $experience
            );
        }

        $educations = [
            [
                'jurusan' => 'D4 Multimedia Engineering Technology',
                'instansi' => 'Politeknik Elektronika Negeri Surabaya',
                'tahun' => '2025 - NOW',
                'deskripsi' => 'Pursuing higher education with deep focus on multimedia engineering, front-end programming, and digital design.',
                'logo' => 'https://thumb.wikimedia.org/wikipedia/id/thumb/4/44/Logo_PENS.png/250px-Logo_PENS.png',
            ],
            [
                'jurusan' => 'High School Education',
                'instansi' => 'SMA Bayt Al-Hikmah',
                'tahun' => '2021 - 2025',
                'deskripsi' => 'Completed secondary education with active organizational involvement and academic foundations.',
                'logo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSa5OcFynf3AZ2JySwV7vVz1yrOAU7i8nq02KXF75TdhNHdKOT6d08kzBU&s=10',
            ],
        ];

        foreach ($educations as $education) {
            Education::updateOrCreate(
                [
                    'jurusan' => $education['jurusan'],
                    'instansi' => $education['instansi'],
                ],
                $education
            );
        }

        $projects = [
            [
                'judul' => 'Terjadinya Telaga Ranu Grati',
                'kategori' => 'Game',
                'tahun' => 2026,
                'deskripsi' => "Interactive 2D visual novel game developed using Ren'Py engine and custom Python scripting.",
            ],
            [
                'judul' => 'Wonderweb Agency',
                'kategori' => 'Web',
                'tahun' => 2026,
                'deskripsi' => 'Modern landing page web application built with Astro 5, Tailwind CSS, and daisyUI.',
            ],
            [
                'judul' => 'Color Palette Manager CLI',
                'kategori' => 'CLI',
                'tahun' => 2026,
                'deskripsi' => 'Terminal-based color palette management software application written in C language.',
            ],
        ];

        foreach ($projects as $project) {
            Project::updateOrCreate(
                ['judul' => $project['judul']],
                $project
            );
        }
    }
}
