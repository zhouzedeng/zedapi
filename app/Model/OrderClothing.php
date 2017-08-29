<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\OrderClothing
 *
 * @property int $id
 * @property int $order_id
 * @property int $clothing_id
 * @property string $clothing_cover
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderClothing whereClothingCover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderClothing whereClothingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderClothing whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderClothing whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderClothing whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderClothing whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderClothing whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $clothing_name
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderClothing onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\OrderClothing whereClothingName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderClothing withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderClothing withoutTrashed()
 */
class OrderClothing extends Model
{
    use SoftDeletes;
}
