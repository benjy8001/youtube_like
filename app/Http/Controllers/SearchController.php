<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * @param Request $request
     *
     * @return View
     */
    public function search(Request $request): View
    {
        $videos = [];
        if (null !== $request->input('query')) {
            $search = $request->input('query');
            $videos = Video::query()
                ->where('title', 'LIKE', sprintf('%%%s%%', $search))
                ->orWhere('description', 'LIKE', sprintf('%%%s%%', $search))
                ->get();
        }

        return view('search', compact('videos'));
    }
}
