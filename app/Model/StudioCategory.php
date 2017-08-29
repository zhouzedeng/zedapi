<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\StudioCategory
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StudioCategory whereCompanyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StudioCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StudioCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StudioCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StudioCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StudioCategory whereUpdatedAt($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StudioCategory onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StudioCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StudioCategory withoutTrashed()
 */
class StudioCategory extends Model
{
    use SoftDeletes;

    protected $hidden = ['id'];
}
