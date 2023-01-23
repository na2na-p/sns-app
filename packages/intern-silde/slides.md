---
title: na2na-p/yumemi-intern-slide
download: false
lineNumbers: true
class: "text-center"
theme: apple-basic
---

# Yumemi ServerSide Intern

## A.Yamamoto

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

- 今回の目標 ⇦
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

# 今回の目標

- Hello PHP

  - そもそも PHP が久しぶり
  - 型の付いた現代の PHP はどんなもの？

- Hello Laravel

- テストを書こう
  - Stop! 猛コード・ノーテスト開発

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

# 目次

- 今回の目標
- 課題 ⇦
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

# 課題

<br>

## お題

Twitter ライクな Web アプリケーションを作成する  
バックエンドには Laravel を使用するが、そのほかは自由

---

# 課題

<br>

## 環境

<br>

| バックエンド   | Laravel 9                     |
| -------------- | ----------------------------- |
| フロントエンド | React 18 + TypeScript         |
| データベース   | MySQL 8.0                     |
| インフラ       | AWS (IaC 利用)                |
| CI/CD          | Github Actions(GitHub-hosted) |
| 認証           | Session Auth                  |

---

# 目次

- 今回の目標
- 課題
- 設計 ⇦
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

# 設計

<br>

## 要件定義

<br>

- [Github](https://github.com/na2na-p/sns-app/blob/main/documents/application_desigin.md)へ設置

## DB 設計

<br>

- [Github](https://github.com/na2na-p/sns-app/tree/main/documents/db)へ設置

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

---

# 目次

- 今回の目標
- 課題
- 設計
- 開発 ⇦
  - フローなど ⇦
  - CI/CD 準備
  - バックエンド構築
  - フロントエンド構築
  - インフラ構築
- デモ
- 振り返り

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

- Github Flow を採用
- マージコミットを産んでいいのは PR のマージの時だけ
- マージする前にベースになるブランチは最新にしましょう

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
- 開発 ⇦
  - フローなど
  - CI/CD 準備 ⇦
  - バックエンド構築
  - フロントエンド構築
  - インフラ構築
- デモ
- 振り返り

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

---

# 開発

<br>

## CI/CD 構築

- バックエンドではテストで利用するコマンドを質問して Makefile から利用可能に
- Nod.js 環境で使う CI はなんとなく理解してるのでサクッと
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

---

# 開発

<br>

## CI/CD 構築

PR のたびにこういう光景が広がります。

![check](https://misskey.na2na.dev/media/media/c6a97f66-94a5-49cd-9221-d467b7ac2bf2.png)

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
- 開発 ⇦
  - フローなど
  - CI/CD 準備
  - バックエンド構築 ⇦
  - フロントエンド構築
  - インフラ構築
- デモ
- 振り返り

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
