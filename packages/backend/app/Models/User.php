<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Carbon;

/**
 * App\Models\User
 *
 * @property string $id バックエンドでUUID生成
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name 日本語英語問わず64、登録なしはできない
 * @property string $password ハッシュ化前は8文字以上 32文字以下
 * @property string $email ユーザメールアドレス
 *
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereUpdatedAt($value)
 *
 * @mixin Eloquent
 *
 * @property-read Collection|Favorite[] $favorites
 * @property-read int|null $favorites_count
 * @property-read Collection|Message[] $messages
 * @property-read int|null $messages_count
 *
 * @method static UserFactory factory(...$parameters)
 */
class User extends Authenticatable
{
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [
        'id',
        'name',
        'email',
        'password',
        'created_at',
        'updated_at',
    ];

    /**
     * @return HasMany<Message>
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @return HasMany<Favorite>
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }
}
