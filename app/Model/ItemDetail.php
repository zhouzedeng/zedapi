<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\ItemDetail
 *
 * @property-read \App\Model\Item $item
 * @mixin \Eloquent
 * @property int $id
 * @property int $item_id
 * @property string $content
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDetail whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDetail whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDetail whereItemId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDetail whereUpdatedAt($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDetail onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDetail withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ItemDetail withoutTrashed()
 */
class ItemDetail extends Model
{
    use SoftDeletes;

    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
