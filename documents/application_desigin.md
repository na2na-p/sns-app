# 要件整理

- あらかじめ作成済みユーザでログインができる
- ユーザ登録ができる
  - 登録後はログイン画面へリダイレクト？それともログイン済みホームにリダイレクト？
- タイムラインにメッセージ書き込みができる
- メッセージにいいねができる
- テストについて考える
  - E2E: 候補として Playwright(使ったことがある...少し。)
- 開発環境は Docker
  - DevContainer?
- AWS にデプロイ
  - 予算は？
  - CloudFront + S3 + ECS(EKS)　+ RDS?
  - WAF?
- API は REST っぽい？

## ユーザができることは？

- ユーザデータ

  - ユーザー作成
    - 必要な情報は？
    - 識別用の ID と表示 ID、ニックネームのような概念が出てくる？
    - 識別子/パスワードに利用できる文字列は？
  - ログイン
    - 識別に使うのはメールアドレス？ID？
    - 上手く行った時に使うのは jwt?
    - ログアウト（自動ログアウトはある？）
      - jwt の有効期限で制御するけど期限はいつにする？
  - 削除は必要？必要場合論理削除？物理削除？
  - ユーザ情報はユーザ自身で変更はできる？できるとしたらどの項目？
  - follow の概念はある？
  - ユーザー(One)

- メッセージ
  - ここでのメッセージの定義は、TL に流れるもの。ツイートとかトゥートとかノートとかそういう概念
  - 利用可能文字列、文字数は？
  - メンション機能はある？
  - 書き込み/閲覧はログイン済みだけ？
  - 公開範囲の概念はある？（例えば followers only みたいな
  - あとからの編集はできる？
  - 後からの削除はできる？論理削除？物理削除？
  - 1 回のフェッチで何件取得？
  - いいねした人(Many)、されたメッセージ(One)
    - いいねは取り消しができる
      - エンドポイントは同一？
  - リポストの概念はある？
  - リプライのようなシステムは必要？(メッセージ間のリレーション)

## 開発

- Github flow(main, topic/hoge)
- そもそも開発はバックエンド先行っぽい
- モノレポ
- バリデーションはどこでやるの？
  - 何に対してバリデーションかけるの？
    - ログインに利用する項目 2 つ
    - 登録情報で必要そうなもの
    - ポストするメッセージ
  - 引っかかった時のメッセージは？
- サーバサイド
  - PHP/Laravel
    - seeder にユーザーは登録する必要がありそう、あとは指定なし
- フロントエンド
  - TypeScript/React(Vite/SPA), MUI
- テスト
  - Lint
  - ビルドテスト
  - PHP でよく使うテストツールは？
    - 動かし方覚えたら Actions に仕込む + PASS しないと main に行かないように
    - テストケースは要件固まってから考えるがバックエンドは API 一通りとユーティリティ関数？
  - E2E
    - 本題ではなさそうなのでカロリーを抑えたい

## デプロイ

- 時間があったら IaC 頑張りたい
  - tf のモジュール化とか覚えてみたい
- 無理そうならぽちぽち

## 別の視点から

1. 新規登録
2. ログイン済ホーム(TL 表示)
3. post
4. ログアウト

5. ログイン
6. 設定変更画面？