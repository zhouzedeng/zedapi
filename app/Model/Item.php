<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Item
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $company_id
 * @property string $content
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereCompanyId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereUpdatedAt($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item withoutTrashed()
 */
class Item extends Model
{
    use SoftDeletes;
}
