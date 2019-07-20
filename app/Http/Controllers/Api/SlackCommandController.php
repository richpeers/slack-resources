<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class SlackCommandController extends Controller
{
    public function __construct()
    {
        $this->middleware('slack.signing.secret');
    }

    public function store(Request $request)
    {
        //authorize using slack signing secrets

        // validate text input

        // record the resource and tags

        //return response with success message

//  'token' => 'nskhc9VgNmcVzJi2KbT5nssH',
//  'team_id' => 'TL94YDXJP',
//  'team_domain' => 'richpeers1',
//  'channel_id' => 'CLLGCL1BJ',
//  'channel_name' => 'general',
//  'user_id' => 'UL94HCKLJ',
//  'user_name' => 'richpeers1',
//  'command' => '/resource',
//  'text' => 'https://google.com google',
//  'response_url' => 'https://hooks.slack.com/commands/TL94YDXJP/700920207008/JXeSKwJ2sRnMij9k6NAerGe1',
//  'trigger_id' => '702781073639.689168473635.f9502abd7ccd156a8995c93709f72682',

        Log::info($request->all());
    }
}
