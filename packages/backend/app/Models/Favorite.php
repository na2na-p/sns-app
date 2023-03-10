<?php

namespace App\Models;

use Database\Factories\FavoriteFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Favorite
 *
 * @property string $id バックエンドでUUID生成
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $user_id ユーザID
 * @property string $message_id メッセージID
 *
 * @method static Builder|Favorite newModelQuery()
 * @method static Builder|Favorite newQuery()
 * @method static Builder|Favorite query()
 * @method static Builder|Favorite whereCreatedAt($value)
 * @method static Builder|Favorite whereId($value)
 * @method static Builder|Favorite whereMessageId($value)
 * @method static Builder|Favorite whereUpdatedAt($value)
 * @method static Builder|Favorite whereUserId($value)
 *
 * @property-read Message $message
 * @property-read User $user
 *
 * @method static FavoriteFactory factory(...$parameters)
 *
 * @mixin Eloquent
 */
class Favorite extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'message_id',
        'user_id',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return BelongsTo<User, self>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Message, self>
     */
    public function message(): BelongsTo
    {
        return $this->belongsTo(Message::class);
    }
}
