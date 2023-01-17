<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Favorites
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites query()
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites whereUpdatedAt($value)
 * @property string $user_id ユーザID
 * @property string $message_id メッセージID
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites whereMessageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorites whereUserId($value)
 */
class Favorites extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function message()
    {
        return $this->belongsTo('App\Models\Messages');
    }
}
