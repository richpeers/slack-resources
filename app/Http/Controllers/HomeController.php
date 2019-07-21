<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Richpeers\LaravelSlackResources\Models\SlackTag;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param SlackTag $slackTag
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(SlackTag $slackTag)
    {
        $tags = $slackTag->get();

        return view('welcome', [
            'tags' => $tags
        ]);
    }
}
