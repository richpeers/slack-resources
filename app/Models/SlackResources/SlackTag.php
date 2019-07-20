<?php

namespace App\Models\SlackResources;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SlackResources\SlackTag
 *
 * @property int $id
 * @property string $body
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SlackResources\SlackResource[] $resources
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlackResources\SlackTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlackResources\SlackTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlackResources\SlackTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlackResources\SlackTag whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlackResources\SlackTag whereId($value)
 * @mixin \Eloquent
 */
class SlackTag extends Model
{
    protected $table = 'slack_tags';

    protected $fillable = [
        'body'
    ];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function resources()
    {
        return $this->belongsToMany(SlackResource::class, 'slack_resource_tag', 'tag_id', 'resource_id');
    }
}
