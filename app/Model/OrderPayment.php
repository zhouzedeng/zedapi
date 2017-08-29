<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\OrderPayment
 *
 * @property int $id
 * @property int $order_id
 * @property int $type
 * @property int $amount
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderPayment onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\OrderPayment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\OrderPayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\OrderPayment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\OrderPayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\OrderPayment whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\OrderPayment whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\OrderPayment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderPayment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderPayment withoutTrashed()
 * @mixin \Eloquent
 */
class OrderPayment extends Model
{
    use SoftDeletes;

    const TYPE_NONE   = 0;
    const TYPE_WECHAT = 1;
    const TYPE_ALIPAY = 2;
    const TYPE_CASH   = 3;

    protected $hidden = ['id'];

    protected $dates = ['created_at'];
    
    /**
     * Order payment type config
     *
     * @return array
     */
    public function types() {
        return [
            self::TYPE_NONE   => 'none',
            self::TYPE_WECHAT => 'wechat',
            self::TYPE_ALIPAY => 'alipay',
            self::TYPE_CASH   => 'cash',
        ];
    }

    /**
     * Order payment type text
     *
     * @return mixed
     */
    public function typeText() {
        $params = $this->types();
        return isset($params[$this->type]) ? $params[$this->type] : '';
    }
}
