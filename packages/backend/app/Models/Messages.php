<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Messages
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Messages newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Messages newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Messages query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Messages whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Messages whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Messages whereUpdatedAt($value)
 * @property string $body メッセージ本文
 * @property string $user_id ユーザID
 * @method static \Illuminate\Database\Eloquent\Builder|Messages whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Messages whereUserId($value)
 */
class Messages extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [
        'id',
        'body',
        'created_at',
        'updated_at',
    ];
}
