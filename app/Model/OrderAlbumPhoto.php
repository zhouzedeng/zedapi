<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\OrderAlbumPhoto
 *
 * @property int $id
 * @property int $order_id
 * @property int $photo_id
 * @property string $photo_url
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbumPhoto whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbumPhoto whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbumPhoto whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbumPhoto whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbumPhoto wherePhotoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbumPhoto wherePhotoUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbumPhoto whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbumPhoto onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbumPhoto withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderAlbumPhoto withoutTrashed()
 */
class OrderAlbumPhoto extends Model
{
    use SoftDeletes;
}
