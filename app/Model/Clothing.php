<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Clothing
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $category_id
 * @property string $cover
 * @property string $name
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Clothing whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Clothing whereCover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Clothing whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Clothing whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Clothing whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Clothing whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Clothing whereUpdatedAt($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Clothing onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Clothing withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Clothing withoutTrashed()
 */
class Clothing extends Model
{
    use SoftDeletes;

    protected $hidden = ['id'];
}
