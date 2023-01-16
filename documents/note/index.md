# Backend

## Tinker の中で Redis

```tinker
Illuminate\Support\Facades\Redis::keys('*')
# or
# app.phpでエイリアスを設定して\Redis::keys('*') // のように先頭にバックスラッシュをつける?
```

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
