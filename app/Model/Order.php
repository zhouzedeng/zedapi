<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Order
 *
 * @property-read \App\Model\OrderCombo $combo
 * @mixin \Eloquent
 * @property int $id
 * @property int $company_id
 * @property string $order_number
 * @property string $bridegroom_name
 * @property string $bridegroom_phone
 * @property string $bride_name
 * @property string $bride_phone
 * @property int $province
 * @property int $city
 * @property string $address
 * @property string $shoot_at
 * @property int $album_id
 * @property int $amount
 * @property bool $payment_type
 * @property int $payment_amount
 * @property string $payment_at
 * @property string $remark
 * @property int $status
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereAlbumId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereBrideName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereBridePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereBridegroomName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereBridegroomPhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereCompanyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereOrderNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order wherePaymentAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order wherePaymentAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereProvince($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereRemark($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereShootAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\OrderExtra[] $extras
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\OrderProduct[] $products
 * @property string $follower
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order whereFollower($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Order withoutTrashed()
 * @property int $discount
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Order whereDiscount($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\OrderPayment[] $payments
 */
class Order extends Model
{
    use SoftDeletes;

    const STATUS_CLOSE       = -1;
    const STATUS_OBLIGATIONS = 1000;
    const STATUS_PAID        = 2000;
    const STATUS_COMPLETE    = 3000;



    // hidden field
    protected $hidden = ['id'];

    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
        $timestamp          = Carbon::now()->format('YmdHis');
        $random_string      = sprintf('%04d', mt_rand(1, 9999));
        $this->order_number = '01' . $timestamp . $random_string;
        if (config('app.debug')) {
            $this->order_number = '00' . $timestamp . $random_string;
        }
    }

    /**
     * Order status config
     *
     * @return array
     */
    public function status() {
        return [
            self::STATUS_CLOSE       => 'close',
            self::STATUS_OBLIGATIONS => 'obligations',
            self::STATUS_PAID        => 'paid',
            self::STATUS_COMPLETE    => 'complete',
        ];
    }

    /**
     * Order status text
     *
     * @return mixed
     */
    public function statusText() {
        $params = $this->status();
        return isset($params[$this->status]) ? $params[$this->status] : '';
    }



    /**
     * Get order combo information
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function combo() {
        return $this->hasOne(OrderCombo::class, 'order_id', 'id');
    }

    /**
     * Get order products information
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products() {
        return $this->hasMany(OrderProduct::class, 'order_id', 'id');
    }

    /**
     * Get order extras information
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function extras() {
        return $this->hasMany(OrderExtra::class, 'order_id', 'id');
    }

    /**
     * Get order payments information
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments(){
        return $this->hasMany(OrderPayment::class, 'order_id', 'id');
    }
}
