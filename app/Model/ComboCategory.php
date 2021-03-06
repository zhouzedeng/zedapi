<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\ComboCategory
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboCategory whereCompanyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboCategory whereUpdatedAt($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboCategory onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboCategory withoutTrashed()
 */
class ComboCategory extends Model
{
    use SoftDeletes;

    protected $hidden = ['id'];
}
