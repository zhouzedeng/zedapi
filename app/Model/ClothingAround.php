<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\ClothingAround
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $clothing_id
 * @property string $url
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingAround whereClothingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingAround whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingAround whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingAround whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingAround whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingAround whereUrl($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingAround onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingAround withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ClothingAround withoutTrashed()
 */
class ClothingAround extends Model
{
    use SoftDeletes;

    protected $table = 'clothing_around';
}
