<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\View\View;

class ChannelController extends Controller
{
    public function edit(Channel $channel): View
    {
        return view('channel.edit', compact('channel'));
    }
}
