<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\OrderAlbum
 *
 * @property int $id
 * @property int $order_id
 * @property int $album_id
 * @property string $album_cover
 * @property string $album_name
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbum whereAlbumCover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbum whereAlbumId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbum whereAlbumName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbum whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbum whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbum whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbum whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbum whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbum onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbum withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbum withoutTrashed()
 */
class OrderAlbum extends Model
{
    use SoftDeletes;
}
