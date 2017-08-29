<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\OrderProduct
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $product_cover
 * @property string $product_name
 * @property int $product_price
 * @property int $count
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderProduct whereCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderProduct whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderProduct whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderProduct whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderProduct whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderProduct whereProductCover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderProduct whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderProduct whereProductName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderProduct whereProductPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderProduct whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderProduct onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderProduct withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderProduct withoutTrashed()
 */
class OrderProduct extends Model
{
    use SoftDeletes;

    protected $hidden = ['id'];
}
