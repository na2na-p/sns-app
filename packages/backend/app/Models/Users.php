<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Concerns\HasUuids;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Users
 *
 * @method static Builder|Users newModelQuery()
 * @method static Builder|Users newQuery()
 * @method static Builder|Users query()
 *
 * @mixin Eloquent
 *
 * @property string $id バックエンドでUUID生成
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $name 日本語英語問わず64、登録なしはできない
 * @property string $email ユーザメールアドレス
 * @property string $password ハッシュ化前は8文字以上 32文字以下
 *
 * @method static Builder|Users whereCreatedAt($value)
 * @method static Builder|Users whereEmail($value)
 * @method static Builder|Users whereId($value)
 * @method static Builder|Users whereName($value)
 * @method static Builder|Users wherePassword($value)
 * @method static Builder|Users whereUpdatedAt($value)
 *
 * @property-read Collection|Favorites[] $favorites
 * @property-read int|null $favorites_count
 * @property-read Collection|Messages[] $messages
 * @property-read int|null $messages_count
 */
class Users extends Model
{
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

    public function messages(): HasMany
    {
        return $this->hasMany(Messages::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorites::class);
    }
}
