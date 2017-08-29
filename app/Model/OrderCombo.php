<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\OrderCombo
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $order_id
 * @property int $combo_id
 * @property string $combo_cover
 * @property string $combo_name
 * @property int $combo_price
 * @property int $combo_origin_price
 * @property int $count
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderCombo whereComboCover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderCombo whereComboId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderCombo whereComboName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderCombo whereComboOriginPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderCombo whereComboPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderCombo whereCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderCombo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderCombo whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderCombo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderCombo whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderCombo whereUpdatedAt($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderCombo onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderCombo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderCombo withoutTrashed()
 */
class OrderCombo extends Model
{
    use SoftDeletes;

    protected $hidden = ['combo_id'];
}
