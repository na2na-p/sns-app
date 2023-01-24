---
title: na2na-p/yumemi-intern-slide
download: false
lineNumbers: true
class: text-center
theme: apple-basic
---

<br><br><br><br><br><br>

# Yumemi ServerSide Intern

## A.Yamamoto

## 2023.1.11 ~ 2023.1.24

---

# 目次

- 今回の目標
- 課題
- 設計
- 開発
  - フローなど
  - CI/CD 準備
  - バックエンド構築
  - フロントエンド構築
  - インフラ構築
- デモ
- 振り返り

<style>
  li {
   	font-size: 1.1em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

<!--
このような流れで進めていきます。
-->

---

# 目次

- 今回の目標 👈
- 課題
- 設計
- 開発
  - フローなど
  - CI/CD 準備
  - バックエンド構築
  - フロントエンド構築
  - インフラ構築
- デモ
- 振り返り

<style>
  li {
   	font-size: 1.1em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

<!--
まずは今回の目標の確認を。
-->

---

# 今回の目標

- Hello PHP!

  - そもそも PHP が久しぶり
  - 型の付いた現代の PHP はどんなもの？

- Hello Laravel

  - Laravel は本当に初めまして

- テストを書こう
  - Stop! 猛コード・ノーテスト開発
  - テストケースの考え方

<style>
  li {
   	font-size: 1.7em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
	li li {
  	font-size: 0.8em;
    padding-bottom: 0.1em;
  }
</style>

---

# 今回の目標

<br>

## 完成形

![image](https://misskey.na2na.dev/media/media/8cb37c77-efa4-40f1-9a7b-0606145d79e7.png)

<!--
完成形のイメージ画像です。縦幅見切れちゃうのでこのサイズで一旦勘弁してください。
-->

---

# 目次

- 今回の目標
- 課題 👈
- 設計
- 開発
  - フローなど
  - CI/CD 準備
  - バックエンド構築
  - フロントエンド構築
  - インフラ構築
- デモ
- 振り返り

<style>
  li {
   	font-size: 1.1em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

---

# 課題

<br>

## お題

Twitter ライクな Web アプリケーションを作成する  
バックエンドには Laravel を使用するが、そのほかは自由

<style>
  p {
   	font-size: 1.3em;
  }
</style>

<!--
バックエンドはLaravelにすること以外は自由だったので、文字通り本当に自由にやりました。出来はともかくとして満足行くまでいろんなことを試せました。
-->

---

# 課題

<br>

## 環境

<br>

| エディタ       | IntelliJ IDEA Ultimate / VSCode                                          |
| -------------- | ------------------------------------------------------------------------ |
| バックエンド   | Laravel 9 + PHP 8.2.1 (sail 利用)                                        |
| フロントエンド | React 18 + TypeScript 4.9.4                                              |
| データベース   | MySQL 8.0                                                                |
| インフラ       | AWS (IaC 利用、バックエンド) / Cloudflare (バックエンド, フロントエンド) |
| CI/CD          | Github Actions(GitHub-hosted)                                            |
| 認証           | Session Auth                                                             |

<!--
まだフロントエンド部分でJetbrainsエディタに慣れていないのでVSCodeも使ったりしました。
Reactは関数コンポーネントです。
-->

---

# 目次

- 今回の目標
- 課題
- 設計 👈
- 開発
  - フローなど
  - CI/CD 準備
  - バックエンド構築
  - フロントエンド構築
  - インフラ構築
- デモ
- 振り返り

<style>
  li {
   	font-size: 1.1em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

---

# 設計

<br>

## 要件定義

- [Github](https://github.com/na2na-p/sns-app/blob/main/documents/application_desigin.md)へ設置

![要件](https://misskey.na2na.dev/media/media/80615e11-5dc6-4e51-a70e-e9a0d0fbc219.png)

<!--
画像は最終的に出した要件になります。意図的にある程度荒めに提示された目標を達成するために必要な要素を、一部でお馴染みのワイ記法の考え方を使って、考えていました。例えば、「ふとそのサービスを初めて使ってメッセージ投稿したくなった人」がどういった行動をとってメッセージ投稿をするのかを辿る。また、投稿後にどうなっていたら嬉しいかも考える。例えば投稿したものが先頭に表示されたら嬉しいですよね。こうやって洗い出した後に、質問をして一つづつ確認していきました。
-->

---

# 設計

<br>

## DB 設計

<br>

- [Github](https://github.com/na2na-p/sns-app/tree/main/documents/db)へ設置

<!--
開いてみせる
-->

---

# 設計

<br>

## URL 設計

<br>

OpenAPI スキーマとして吐き出したものを[Github](https://github.com/na2na-p/sns-app/blob/main/documents/api/schema.json)に設置

[Swagger UI](http://localhost:8080/#/)

## 画面設計

<br>

[Figma](https://www.figma.com/file/q1SkYbpqk9w0Pt07ukiE6e/sns-app?node-id=0%3A3&t=LOSFTrDgMrSbfr5p-0)

Export した SVG を[Github](https://github.com/na2na-p/sns-app/tree/main/documents/ui)にも置いてあります

<!--
SwaggerUIを別タブで表示する
-->

---

# 目次

- 今回の目標
- 課題
- 設計
- 開発 👈
  - フローなど 👈
  - CI/CD 準備
  - バックエンド構築
  - フロントエンド構築
  - インフラ構築
- デモ
- 振り返り

<style>
  li {
   	font-size: 1.1em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

---

# 開発

<br>

## フローなど

- Github Flow を採用
- マージコミットを産んでいいのは PR のマージの時だけ
- マージする前にベースになるブランチは最新にしましょう
  - 最新のベースブランチでリベースしよう

<style>
  li {
   	font-size: 1.2em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

---

# 開発

<br>

## フローなど

![branch-graph](https://misskey.na2na.dev/media/media/e9e0f3fa-d760-4c46-8784-3f166bd4367a.png)

<!--
ブランチグラフが綺麗で気持ちがいいですね
-->

---

# 目次

- 今回の目標
- 課題
- 設計
- 開発 👈
  - フローなど
  - CI/CD 準備 👈
  - バックエンド構築
  - フロントエンド構築
  - インフラ構築
- デモ
- 振り返り

<style>
  li {
   	font-size: 1.1em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

---

# 開発

<br>

## CI/CD 構築

- 今回は Public Repository で開発
  - GitHub-hosted Runner を利用
  - GitGuardian による機密情報漏洩チェック
  - ライブラリのライセンスチェックはなし(主に GPL 系ライセンス)

<style>
  li {
   	font-size: 1.2em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

<!--
自分が一番得意かもしれないところ
今回はPublic Repositoryなので、Self hosted runnerは利用しません。誰でも実行できてしまうというところと、わざわざ利用枠消費するものなぁというところです。もしやるならオンプレかEC2のスポットインスタンスかなぁというところです。
続いて鍵の大公開をやらかした時にリアルタイムに通知を飛ばしてくるGitGuardianのセットをします。以前にAWSの鍵をやらかしたことがあってその時にメールを寄越してきたのが利用開始のきっかけです。
また、ライブラリのライセンスチェックはしません。いわゆるGPL汚染のことを言ってますが、今回はそもそも公開してるので考慮する必要はないです。
-->

---

# 開発

<br>

## CI/CD 構築

- ライブラリ等の更新は Renovate に丸投げ
- バックエンドではテストで利用するコマンドを質問して Makefile から利用可能に
- Node.js 環境で使う CI はなんとなく理解してるのでサクッと
- フロントエンド CD は Cloudflare Pages へ。ビルドテストも兼ねています。
  - デプロイ後はキャッシュパージしましょう
- バックエンド CD は AWS EC2 へ
  - SSM を利用して Run Command することで自動更新

<style>
  li {
   	font-size: 1.2em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

<!--
最低限のCI構築してからですが、ライブラリの更新はRenovateに丸投げします。
バックエンドでは、と言ってますがフロントだろうがなんだろうがMakefileから操作できるようにしました。
Cloudflare Pagesへのデプロイについて、mainブランチにpushした時のみCDNのキャッシュパージも一緒に行うようにしています。
バックエンドCDはSSMを利用してRun Commandでgit rebaseなどなどコマンドを叩いて自動更新されるようになっています。
-->

---

# 開発

<br>

## CI/CD 構築

- Branch Protection ルールをよしなに設定
  - 最低 1 名の Approve を必要に
    - 抜け道として Bot に Approve させたりしました
  - 設定の終わったテスト系から順次 Required へ
  - コミットに署名されていることを強制
- 全部の条件を満たしたら Bot が勝手に Merge するように

<style>
  li {
   	font-size: 1.2em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

<!--
Branch Protectionルールをよしなに設定していきます。
-->

---

# 開発

<br>

## CI/CD 構築

`terraform plan`

![terraformplan](https://misskey.na2na.dev/media/media/3978dd38-273e-4380-bf32-2691774a1a51.png)

<!--
terraform planの結果も出してます。
-->

---

# 開発

<br>

## CI/CD 構築

PR のたびにこういう光景が広がります。これでも見切れていますが。~~モノレポの辛いところ~~

<!-- モノレポの辛いところで、関係ない分野のテストも通らないとマージされないのが -->

![check](https://misskey.na2na.dev/media/media/595bb658-4c63-49e9-b380-de533a4b7f3c.png)

<style>
  li {
   	font-size: 1.2em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

<!--
モノレポのつらいところで、必須テスト増やすとニョキニョキ伸びて行くのがあります。画像も見切れていますし。。
-->

---

# 目次

- 今回の目標
- 課題
- 設計
- 開発 👈
  - フローなど
  - CI/CD 準備
  - バックエンド構築 👈
  - フロントエンド構築
  - インフラ構築
- デモ
- 振り返り

<style>
  li {
   	font-size: 1.1em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

---

# 開発

<br>

## バックエンド構築

- Laravel で API サーバの構築
- CORS の設定周りがかなり雑になってしまった

<style>
    li {
     	font-size: 1.2em;
      margin-left: 50px;
    	padding-bottom: 0.4em;
    }
    li li {
    	font-size: 1em;
      padding-bottom: 0.1em;
    }
</style>

---

# 開発

<br>

## バックエンド構築

- 初期からある認証用ミドルウェアでは不満があったので、自前で作成したものを適用
  <!-- - 具体的には認証していない場合絶対に`/login`にリダイレクトさせようとする挙動 -->

```php
class SessionAuthMiddleware
{
		// PHPDoc省略
    public function handle(Request $request, Closure $next)
    {
        if (is_null($request->user())) {
            return response([
                'message' => 'Unauthorized',
            ], 401);
        }
        return $next($request);
    }
}
```

<style>
    li {
     	font-size: 1.2em;
      margin-left: 50px;
    	padding-bottom: 0.4em;
    }
    li li {
    	font-size: 1em;
      padding-bottom: 0.1em;
    }
</style>

---

# 開発

<br>

## バックエンド構築

- ルーティングはまとめてスッキリ書こう(一部抜粋)

```php
Route::prefix('/v1')->group(function () {
    Route::middleware('sessionAuth')->group(function () {
        Route::prefix('/users')->group(function () {
            Route::controller(UsersController::class)->group(function () {
                Route::get('/me', 'findUser');
                Route::put('/me', 'updateUser');
                Route::put('/me/password', 'updatePassword');
            });
        });
        Route::prefix('/messages')->group(function () {
            Route::controller(MessagesController::class)->group(function () {
                Route::post('/', 'createMessage');
                Route::get('/', 'listMessage');
            });
            Route::put('/{messageId}/favorite', [FavoriteController::class, 'addFavorite']);
        });
    });
});
```

<style>
    li {
     	font-size: 1.2em;
      margin-left: 50px;
    	padding-bottom: 0.4em;
    }
    li li {
    	font-size: 1em;
      padding-bottom: 0.1em;
    }
</style>

---

# 開発

<br>

## バックエンド構築

- Eloquent の`with`便利
- Eloquent Model の良さを殺さない書き方をしましょう
  - 必要な時以外できる限り query, select を使用するのは避ける

```php
$messages = Message::with('favorites')
		->withCount(['favorites' => function (Builder $query) use ($userId) {
				$query->where('user_id', $userId);
		}])
		->with('user')
		->when($lastMessageId, function (Builder $query) use ($lastMessageId) {
				$query->where('id', '<', $lastMessageId);
		})
		->orderBy('id', 'desc')
		->take($perPage)
		->get();
```

<style>
    li {
     	font-size: 1.2em;
      margin-left: 50px;
    	padding-bottom: 0.4em;
    }
    li li {
    	font-size: 1em;
      padding-bottom: 0.1em;
    }
</style>

<!--
PRでいただいたアドバイスとして、Eloquent Modelの良さを殺さない書き方をしましょう。というところがあります。
-->

---

# 開発

<br>

## バックエンド構築

- OpenAPI のスキーマ生成を Laravel の実装から行うように
  - `"vyuldashev/laravel-openapi": "^1.8"`を利用しました
  - 出来上がったスキーマをもとにテストが生成できたら嬉しい
  - リクエスト飛ばすためのツールもスキーマから一発で大体の設定が終わって嬉しい
  - ローカルで SwaggerUI 確認しやすくなって嬉しい
  - フロントエンドもスキーマ駆動で開発できて嬉しい

<style>
    li {
     	font-size: 1.2em;
      margin-left: 50px;
    	padding-bottom: 0.4em;
    }
    li li {
    	font-size: 1em;
      padding-bottom: 0.1em;
    }
</style>

<!--
今までやった開発がGraphQLのスキーマ駆動なフロントエンドだった、というのもあって、どうしてもスキーマは欲しかったのでゴリ押して実装しました。嬉しいずくめ。
-->

---

# 開発

<br>

## バックエンド構築

- テスト実装
  - DRY 原則に背いたテストコードを書くことも多々ある。むしろ愚直に書くべき。
  - 更新後の値もきちんと確認しよう、更新できて終わりではない
  - テストの意図が伝わりやすいテストを書こう
- カバレッジは確認しておこう
  - 今回は 1 箇所の漏れに気づけた

<style>
    li {
     	font-size: 1.2em;
      margin-left: 50px;
    	padding-bottom: 0.4em;
    }
    li li {
    	font-size: 1em;
      padding-bottom: 0.1em;
    }
</style>

<!--
初めてまともにテストを書きました。知見もあったし、単純にCIの項目で1=1テストの状態が解消されて嬉しかったです。カバレッジの確認はしましょう。今回ルート一つ漏れてたのに気づけました。
-->

---

# 目次

- 今回の目標
- 課題
- 設計
- 開発 👈
  - フローなど
  - CI/CD 準備
  - バックエンド構築
  - フロントエンド構築 👈
  - インフラ構築
- デモ
- 振り返り

<style>
  li {
   	font-size: 1.1em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

---

# 開発

<br>

## フロントエンド構築

- TypeScript で書く
- MUI 利用
- フォームには下記を利用
  - react-hook-form
  - yup

<style>
    li {
     	font-size: 1.2em;
      margin-left: 50px;
    	padding-bottom: 0.4em;
    }
    li li {
    	font-size: 1em;
      padding-bottom: 0.1em;
    }
  </style>

---

# 開発

<br>

## フロントエンド構築

- スキーマ駆動開発で幸せになりましょう
- 型は Orval によって自動生成
  - 自動生成された TanStack Query のクライアントが壊れていて使い物にならなくて悲しい

```ts
export type GetApiV1Messages200Item = {
	id: string;
	body: string;
	created_by: string;
	created_at: string;
	isFavorite: boolean;
	favoritesCount: number;
};
```

<style>
    li {
     	font-size: 1.2em;
      margin-left: 50px;
    	padding-bottom: 0.4em;
    }
    li li {
    	font-size: 1em;
      padding-bottom: 0.1em;
    }
  </style>

---

# 目次

- 今回の目標
- 課題
- 設計
- 開発 👈
  - フローなど
  - CI/CD 準備
  - バックエンド構築
  - フロントエンド構築
  - インフラ構築 👈
- デモ
- 振り返り

<style>
  li {
   	font-size: 1.1em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

---

# 開発

<br>

## インフラ構築

とてもかんたんな構成図

![構成図](https://misskey.na2na.dev/media/media/9f6070d8-a7f1-44bd-b4b5-4ec17eb6f931.png)

---

# 開発

<br>

## インフラ構築

AWS EC2 は IaC 利用しました。  
tfstate は S3 で管理し、DynamoDB を利用して排他制御をしています。

~~排他制御の影響で main からリベースしたものを矢継ぎ早に force push すると CI 上で動かしている `terraform plan` が落ちる...~~

<!--
バックエンドは当初オンプレにしていたのを、学校でタダ使えるAzure仮想マシンで実行していました。が、せっかく真面目にやるんだからIaCに挑戦しても面白そうだというところで自腹でAWS EC2を自前で準備しています。tfstateの管理はS3で行っていてDynamoDBで排他制御をしています。その副作用というか、当然といえば当然ですがterraform planがCIで複数同時に走る様な状況になると後発が負けて失敗します。
-->

---

# 開発

<br>

## インフラ構築

- フロントエンド  
   Github Actions でビルドして、Cloudflare Pages へデプロイ。  
   CDN なので、デプロイと同時にキャッシュパージも行う。
  ![cf-pages](https://misskey.na2na.dev/media/media/f0f0a67a-538f-4b7b-83fe-636ec04b5726.png)

---

# 開発

<br>

## インフラ構築

- バックエンド  
   EC2 + Cloudflare Tunnel で構築  
   気持ち的には ECS だったが、イメージ作成が辛そうだったので見送り  
   sail の使ってるのが php のビルトインサーバだったと思うので、本格的にやるならば避けるべきだと思う
  ![EC2](https://misskey.na2na.dev/media/media/4086c475-1368-49e5-8031-d4e289420127.png)

---

# 開発

<br>

## インフラ構築

- バックエンド

  - Cloudflare Tunnel を使ってることで、ポート解放が不要に
    ![port解放いらず](https://misskey.na2na.dev/media/media/ad115ed6-6ca5-4e2b-8150-3ef6aabcaefb.png)

  - 本当なら Public IP も必要ないけれど、SSM 周りがうまくいかなくなったので一旦そのままに

---

# 開発

<br>

## インフラ構築

- バックエンド

  - CD 関係では巷でよく見かける、デプロイのタイミングでインバウンドルールに穴を開けるのではなく、SSM で Run Command するようにしています。
  - それ用の Policy / Role を拵えるのも IaC でやってます。

---

# 開発

<br>

## インフラ構築

Cloudflare の WAF もこんな感じで簡単にセットができます

### 画像が一時期話題だった log4j のあれこれの時に仕込んだものです。

### 簡単すぎるから突破されていそうというのと、CF がデフォルトで対策していそう

<!-- 3 Billion DevicesといえばJava -->

![3-billion-devices](https://misskey.na2na.dev/media/media/05d042a0-cd9a-4770-b430-a5dccaa07e12.png)

<!--
3 billon devicesってことで、log4jの騒ぎの時になんとなくセットしたルールです。単純すぎるからとっくに回避されていそうというのと、Cloufdlareがデフォルトで対策していそうな気はしますがこのまま放置してます。
-->

---

# 目次

- 今回の目標
- 課題
- 設計
- 開発
  - フローなど
  - CI/CD 準備
  - バックエンド構築
  - フロントエンド構築
  - インフラ構築
- デモ 👈
- 振り返り

<style>
  li {
   	font-size: 1.1em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

<!--
ZoomでURL共有します。
-->

---

# 目次

- 今回の目標
- 課題
- 設計
- 開発
  - フローなど
  - CI/CD 準備
  - バックエンド構築
  - フロントエンド構築
  - インフラ構築
- デモ
- 振り返り 👈

<style>
  li {
   	font-size: 1.1em;
    margin-left: 50px;
  	padding-bottom: 0.4em;
  }
  li li {
  	font-size: 1em;
    padding-bottom: 0.1em;
  }
</style>

---

# 振り返り

- Laravel バックエンドの構築について
- テスト設計
- REST API の設計について
- インフラ周り
- 総括

<!--
まず、今回のメインである、Laravelバックエンドの構築について
プロジェクト作成、環境の設定など一から教えていただきました。
全てのフェーズでバックエンドコードレビューを頂き、お行儀のいい書き方を知ることができました。
また、今回の目的でもあったテストの設計や書き方まで教えていただくことができ、PHP以外でも使えないかなとさっそく考えています。
忘れないうちに何か個人で作ってみるのもいいかもしれないと思っています。
REST APIの設計は実質初めてのことだったので、命名であったりメソッドの付け方であったりを知ることができました。
実は結構危険な状態だったりするので早いところ畳んでおきます。それはさておき、普段はなかなかここまでしっかりとは取り組めないので非常にいい機会になりました。
総括としては、チームのメンバーの方に非常に細かいところまで見ていただき、非常に得るものの大きかった2週間だったと感じています。
本当にありがとうございました。
-->
