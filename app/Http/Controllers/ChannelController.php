<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\View\View;

class ChannelController extends Controller
{
    /**
     * @param string  $locale
     * @param Channel $channel
     *
     * @return View
     */
    public function index(string $locale, Channel $channel): View
    {
        return view('channel.index', compact('channel'));
    }

    /**
     * @param string  $locale
     * @param Channel $channel
     *
     * @return View
     */
    public function edit(string $locale, Channel $channel): View
    {
        return view('channel.edit', compact('channel'));
    }
}
