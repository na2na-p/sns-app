<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Message
 *
 * @property string $id バックエンドでUUID生成
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $body メッセージ本文
 * @property string $user_id ユーザID
 *
 * @method static Builder|Message newModelQuery()
 * @method static Builder|Message newQuery()
 * @method static Builder|Message query()
 * @method static Builder|Message whereBody($value)
 * @method static Builder|Message whereCreatedAt($value)
 * @method static Builder|Message whereId($value)
 * @method static Builder|Message whereUpdatedAt($value)
 * @method static Builder|Message whereUserId($value)
 *
 * @mixin Eloquent
 *
 * @property-read Collection|Favorite[] $favorites
 * @property-read int|null $favorites_count
 * @property-read User $user
 */
class Message extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [
        'id',
        'body',
        'created_at',
        'updated_at',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }
}