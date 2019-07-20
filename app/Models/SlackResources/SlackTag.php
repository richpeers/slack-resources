<?php

namespace App\Models\SlackResources;

use Illuminate\Database\Eloquent\Model;

class SlackTag extends Model
{
    protected $table = 'slack_tags';

    protected $fillable = [
        'body'
    ];

    public $timestamps = false;

    public function resources()
    {
        return $this->belongsToMany(SlackResource::class, 'slack_resource_tag', 'tag_id', 'resource_id');
    }
}
