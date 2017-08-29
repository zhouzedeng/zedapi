<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Combo
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ComboDetail[] $details
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ComboPhoto[] $photos
 * @mixin \Eloquent
 * @property int $id
 * @property int $category_id
 * @property bool $sale_type
 * @property string $cover
 * @property string $name
 * @property int $price
 * @property int $origin_price
 * @property int $sales_volume
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereCover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereOriginPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereSaleType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereSalesVolume($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo whereUpdatedAt($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Combo withoutTrashed()
 */
class Combo extends Model
{
    use SoftDeletes;

    const SALE_TYPE_ACTIVITY = 1;
    const SALE_TYPE_SPECIAL  = 2;
    const SALE_TYPE_DISCOUNT = 3;

    protected $hidden = ['id'];

    /**
     * Combo sale type config
     *
     * @return array
     */
    public function saleTypes() {
        return [
            self::SALE_TYPE_ACTIVITY => 'activity',
            self::SALE_TYPE_SPECIAL  => 'special',
            self::SALE_TYPE_DISCOUNT => 'discount',
        ];
    }

    /**
     * Combo sale type text
     *
     * @return mixed|string
     */
    public function saleTypeText() {
        $params = $this->saleTypes();
        return isset($params[$this->sale_type]) ? $params[$this->sale_type] : '';
    }

    /**
     * Get combo photos information
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos(){
        return $this->hasMany(ComboPhoto::class, 'combo_id', 'id');
    }

    /**
     * Get combo details information
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details(){
        return $this->hasMany(ComboDetail::class, 'combo_id', 'id');
    }
}
