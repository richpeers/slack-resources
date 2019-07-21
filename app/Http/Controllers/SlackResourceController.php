<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\SlackResource;
use Richpeers\LaravelSlackResources\Models\SlackResource as Resource;

class SlackResourceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param Resource $slackResource
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function __invoke(Request $request, Resource $slackResource)
    {
        $tagId = $request->tag;

        $slackResources = $slackResource
            ->when($tagId, function ($query) use ($tagId) {
                return $query->whereHas('tags', function ($tag) use ($tagId) {
                    $tag->where('id', (int)$tagId);
                });
            })->get();

        return SlackResource::collection($slackResources);
    }
}
