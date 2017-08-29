<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\AlbumPhoto
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $album_id
 * @property string $url
 * @property int $like
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumPhoto whereAlbumId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumPhoto whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumPhoto whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumPhoto whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumPhoto whereLike($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumPhoto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumPhoto whereUrl($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumPhoto onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumPhoto withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumPhoto withoutTrashed()
 */
class AlbumPhoto extends Model
{
    use SoftDeletes;

    protected $hidden = ['id'];
}
