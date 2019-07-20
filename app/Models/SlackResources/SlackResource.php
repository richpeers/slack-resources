<?php

namespace App\Models\SlackResources;

use Illuminate\Database\Eloquent\Model;

class SlackResource extends Model
{
    protected $table = 'slack_resources';

    protected $fillable = [
        'url',
        'meta'
    ];

    public function tags()
    {
        return $this->belongsToMany(SlackTag::class, 'slack_resource_tag', 'resource_id', 'tag_id');
    }
}
