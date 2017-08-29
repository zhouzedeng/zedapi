<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\ComboPhoto
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $combo_id
 * @property string $url
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboPhoto whereComboId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboPhoto whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboPhoto whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboPhoto whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboPhoto whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboPhoto whereUrl($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboPhoto onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboPhoto withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ComboPhoto withoutTrashed()
 */
class ComboPhoto extends Model
{
    use SoftDeletes;

    protected $hidden = ['id', 'combo_id', 'deleted_at', 'created_at', 'updated_at'];
}
