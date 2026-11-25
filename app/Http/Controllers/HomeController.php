<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Expertise;
use App\Models\Experience;
use App\Models\PortfolioProfile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $profile = PortfolioProfile::query()->firstOrFail();
        $skills = Skill::orderBy('id', 'asc')->get();
        $experience = Experience::orderBy('id', 'asc')->get();
        $education = Education::orderBy('id', 'asc')->get();
        $expertises = Expertise::orderBy('urutan')->orderBy('id')->get();

        $searchKey = trim($request->query('search', ''));
        $kategoriFilter = trim($request->query('kategori', ''));

        $projectsQuery = Project::query();
        if ($searchKey !== '') {
            $projectsQuery->where('judul', 'like', '%' . $searchKey . '%');
        }
        if ($kategoriFilter !== '') {
            $projectsQuery->whereRaw('LOWER(kategori) = ?', [strtolower($kategoriFilter)]);
        }

        $filteredProjects = $projectsQuery->orderByDesc('tahun')->get();
        $categories = Project::query()
            ->select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        return view('index', compact(
            'profile',
            'skills',
            'experience',
            'education',
            'expertises',
            'filteredProjects',
            'searchKey',
            'kategoriFilter',
            'categories'
        ));
    }
}