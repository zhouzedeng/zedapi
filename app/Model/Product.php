<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Product
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductPhoto[] $photos
 * @mixin \Eloquent
 * @property int $id
 * @property int $category_id
 * @property bool $sale_type
 * @property string $cover
 * @property string $name
 * @property int $sales_volume
 * @property int $price
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereCover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereSaleType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereSalesVolume($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereUpdatedAt($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product withoutTrashed()
 */
class Product extends Model
{
    use SoftDeletes;

    const SALE_TYPE_ACTIVITY = 1;

    protected $hidden = ['id'];

    /**
     * Product sale type config
     *
     * @return array
     */
    public function saleTypes(){
        return [
            self::SALE_TYPE_ACTIVITY => 'activity',
        ];
    }

    /**
     * Product sale type text
     *
     * @return mixed|string
     */
    public function saleTypeText(){
        $params = $this->saleTypes();
        return isset($params[$this->sale_type]) ? $params[$this->sale_type] : '';
    }

    /**
     * Get product photos information
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos(){
        return $this->hasMany(ProductPhoto::class, 'product_id', 'id');
    }
}
