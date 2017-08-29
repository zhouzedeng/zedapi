<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Album
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $category_id
 * @property string $cover
 * @property string $name
 * @property int $like
 * @property int $photo_number
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Album whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Album whereCover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Album whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Album whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Album whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Album whereLike($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Album whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Album wherePhotoNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Album whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\AlbumPhoto[] $photos
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Album onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Album withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Album withoutTrashed()
 */
class Album extends Model
{
    use SoftDeletes;

    protected $hidden = ['id'];

    public function photos(){
        return $this->hasMany(AlbumPhoto::class, 'album_id', 'id');
    }
}
