<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\ClothingPhoto
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $clothing_id
 * @property string $url
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingPhoto whereClothingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingPhoto whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingPhoto whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingPhoto whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingPhoto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingPhoto whereUrl($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingPhoto onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingPhoto withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingPhoto withoutTrashed()
 */
class ClothingPhoto extends Model
{
    use SoftDeletes;
}
