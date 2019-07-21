<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\SlackResourceException;
use App\Http\Controllers\Controller;
use App\Models\SlackResources\SlackResource;
use App\Models\SlackResources\SlackTag;
use Illuminate\Http\Request;

class SlackCommandController extends Controller
{
    /**
     * @var SlackResource
     */
    protected $slackResource;
    /**
     * @var SlackTag
     */
    protected $slackTag;

    /**
     * SlackCommandController constructor.
     * @param SlackResource $slackResource
     * @param SlackTag $slackTag
     */
    public function __construct(SlackResource $slackResource, SlackTag $slackTag)
    {
        //authorize slack signing secret
        $this->middleware('slack.signing.secret');

        $this->slackResource = $slackResource;
        $this->slackTag = $slackTag;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws SlackResourceException
     */
    public function store(Request $request)
    {
        $value = $request->input('text');

        // check if not a string
        if (!is_string($value)) {
            throw new SlackResourceException('URL required');
        }

        $value = \trim($value);

        // check if empty
        if ($value === '') {
            throw new SlackResourceException('URL required');
        }

        // explode value by one or more spaces or tabs
        $parts = \preg_split('/\s+/', $value, -1, PREG_SPLIT_NO_EMPTY);

        // url is first part of the array
        $url = \array_shift($parts);

        // check for invalid url
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new SlackResourceException('Invalid url.');
        }

        // store the url resource
        $resource = $this->slackResource->create([
            'url' => $url,
            'meta' => \json_encode($request->all())
        ]);

        // lowercase tags
        $tags = \array_map('strtolower', $parts);

        // associate each tag with the resource
        foreach ($tags as $tag) {
            $tag = $this->slackTag->firstOrCreate(['body' => $tag]);
            $resource->tags()->syncWithoutDetaching($tag->id);
        }

        $message = $url . !empty($tags) ?: ' tagged with: ' . \implode(', ', $tags);

        //return response with message
        return response()->json([
            'text' => 'Resource successfully saved',
            'attachments' => [
                (object)[
                    'text' => $message
                ]
            ]
        ], 200);
    }
}
