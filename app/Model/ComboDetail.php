<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\ComboDetail
 *
 * @property-read \App\Model\ItemDetail $detail
 * @mixin \Eloquent
 * @property int $id
 * @property int $combo_id
 * @property int $detail_id
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboDetail whereComboId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboDetail whereDetailId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboDetail whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboDetail whereUpdatedAt($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboDetail onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboDetail withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboDetail withoutTrashed()
 */
class ComboDetail extends Model
{
    use SoftDeletes;

    protected $hidden = ['id', 'combo_id', 'detail_id', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * Get combo detail item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function detail(){
        return $this->belongsTo(ItemDetail::class, 'detail_id', 'id');
    }
}
