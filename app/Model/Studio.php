<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Studio
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $category_id
 * @property string $cover
 * @property string $name
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Studio whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Studio whereCover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Studio whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Studio whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Studio whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Studio whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Studio whereUpdatedAt($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Studio onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Studio withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Studio withoutTrashed()
 */
class Studio extends Model
{
    use SoftDeletes;

    protected $hidden = ['id'];
}
