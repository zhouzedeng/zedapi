<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\OrderStudio
 *
 * @property int $id
 * @property int $order_id
 * @property int $studio_id
 * @property string $studio_cover
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderStudio whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderStudio whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderStudio whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderStudio whereOrderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderStudio whereStudioCover($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderStudio whereStudioId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderStudio whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $studio_name
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderStudio onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\OrderStudio whereStudioName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderStudio withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\OrderStudio withoutTrashed()
 */
class OrderStudio extends Model
{
    use SoftDeletes;
}
