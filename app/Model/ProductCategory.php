<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\ProductCategory
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereCompanyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereUpdatedAt($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory withoutTrashed()
 */
class ProductCategory extends Model
{
    use SoftDeletes;

    protected $hidden = ['id'];
}
