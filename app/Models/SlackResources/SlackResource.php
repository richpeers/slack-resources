<?php

namespace App\Models\SlackResources;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SlackResources\SlackResource
 *
 * @property int $id
 * @property string $url
 * @property string $meta
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SlackResources\SlackTag[] $tags
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlackResources\SlackResource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlackResources\SlackResource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlackResources\SlackResource query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlackResources\SlackResource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlackResources\SlackResource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlackResources\SlackResource whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlackResources\SlackResource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SlackResources\SlackResource whereUrl($value)
 * @mixin \Eloquent
 */
class SlackResource extends Model
{
    protected $table = 'slack_resources';

    protected $fillable = [
        'url',
        'meta'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(SlackTag::class, 'slack_resource_tag', 'resource_id', 'tag_id');
    }
}
