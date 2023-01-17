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
 * App\Models\Messages
 *
 * @method static Builder|Messages newModelQuery()
 * @method static Builder|Messages newQuery()
 * @method static Builder|Messages query()
 *
 * @mixin Eloquent
 *
 * @property string $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Messages whereCreatedAt($value)
 * @method static Builder|Messages whereId($value)
 * @method static Builder|Messages whereUpdatedAt($value)
 *
 * @property string $body メッセージ本文
 * @property string $user_id ユーザID
 *
 * @method static Builder|Messages whereBody($value)
 * @method static Builder|Messages whereUserId($value)
 *
 * @property-read Collection|Favorites[] $favorites
 * @property-read int|null $favorites_count
 * @property-read Users $user
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
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorites::class);
    }
}
