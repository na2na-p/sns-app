<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Favorites
 *
 * @method static Builder|Favorites newModelQuery()
 * @method static Builder|Favorites newQuery()
 * @method static Builder|Favorites query()
 *
 * @mixin Eloquent
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder|Favorites whereCreatedAt($value)
 * @method static Builder|Favorites whereId($value)
 * @method static Builder|Favorites whereUpdatedAt($value)
 *
 * @property string $user_id ユーザID
 * @property string $message_id メッセージID
 *
 * @method static Builder|Favorites whereMessageId($value)
 * @method static Builder|Favorites whereUserId($value)
 *
 * @property-read Messages $message
 * @property-read Users $user
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class);
    }

    public function message(): BelongsTo
    {
        return $this->belongsTo(Messages::class);
    }
}
