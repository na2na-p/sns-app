# Backend

## Tinkerの中でRedis

```tinker
Illuminate\Support\Facades\Redis::keys('*')
# or
# \Redis::keys('*') // のように先頭にバックスラッシュをつける?
```

## 書き散らし

./vendor/bin/sail up -d && ./vendor/bin/sail test

./vendor/bin/sail test
./vendor/bin/sail pint

composer installをいれたい、sailでのやりかた

```
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

./vendor/bin/sail composer install

@ts-xxxx的なものがある
(ジェネリクスが扱えるっぽい)
