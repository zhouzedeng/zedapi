<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\OrderExtra
 *
 * @property int $id
 * @property int $order_id
 * @property string $content
 * @property int $money
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderExtra whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderExtra whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderExtra whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderExtra whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderExtra whereMoney($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderExtra whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderExtra whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderExtra onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderExtra withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderExtra withoutTrashed()
 */
class OrderExtra extends Model
{
    use SoftDeletes;

    protected $hidden = ['id'];
}
