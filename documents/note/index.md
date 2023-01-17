# Backend

## Tinker の中で Redis

```tinker
Illuminate\Support\Facades\Redis::keys('*')
# or
# app.phpでエイリアスを設定して\Redis::keys('*') // のように先頭にバックスラッシュをつける?
```

## 認証周り

```php
//        dd($request->all()['password']);
//        dd($request->get('password')); // ○
//        dd(Hash::make($request->get('password')));
```

```php
Route::get('/v1', function () {
    return Auth::user();
});
```

## Kernel

`packages/backend/app/Http/Kernel.php`は use 使わないでフルパスで書く。
as でハンドリング必要になる可能性があってつらくなることがある。

## 書き散らし

./vendor/bin/sail up -d && ./vendor/bin/sail test

./vendor/bin/sail test
./vendor/bin/sail pint

composer install をいれたい、sail でのやりかた

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

./vendor/bin/sail composer install

@ts-xxxx 的なものがある
(ジェネリクスが扱えるっぽい)

fillable <-> guarded

vendor/bin/sail artisan ide-helper:model -W

全部 guarded に入れているので連想配列では Update はできない

\PHPStan\debugType($var); // mixed

if (is_string($var)) {
    \PHPStan\debugType($var); // string
}

\PHPStan\debugType($var); // mixed
や
\PHPStan\debugType($var); // mixed

assert(is_string($var));

\PHPStan\debugType($var); // string

- assert は、string じゃないときに例外が投げられる
  - TypeScript でいうところの assert arg is string な戻り値の関数のようなもの
- 型アノテーションは、その場ではエラーにならない
  - TypeScript でいうところの as unknown as string のキャストのようなもの

正しく使わないと危険な気配があるのでできるだけ使わない方法を見つけるほうに倒したほうがよさそう
