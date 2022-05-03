<?php

namespace App\Http\Controllers;

use App\Models\Repositories\VideoRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * @param Request         $request
     * @param VideoRepository $videoRepository
     *
     * @return View
     */
    public function search(Request $request, VideoRepository $videoRepository): View
    {
        $videos = $videoRepository->search($request->input('query'));

        return view('search', compact('videos'));
    }
}
