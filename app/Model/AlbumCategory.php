<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\AlbumCategory
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $company_id
 * @property string $name
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumCategory whereCompanyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumCategory whereUpdatedAt($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumCategory onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AlbumCategory withoutTrashed()
 */
class AlbumCategory extends Model
{
    use SoftDeletes;

    protected $hidden = ['id'];
}
