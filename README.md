# save for happiness

「継続できる 500 円貯金」をテーマとした日々の貯金を記録する Web アプリケーションです。一部機能はゲストログインから利用可能ですので気軽にお試し下さい。

#### リンク：https://web.save-app.net/

<img width="1194" alt="スクリーンショット 2022-09-12 6 55 21" src="https://user-images.githubusercontent.com/92079024/189550638-2638756f-0fc0-4c02-852d-c4b0648b5cff.png">

### 工夫した点

インフラストラクチャー

- Docker を使い、ECS Fargate で本番環境をサーバーレスで運用している点
- CircleCI を使い、CD/CD パイプラインを構築している点

バックエンド

- API サーバーとしてフロントエンドからのリクエストに対して JSON データを返している点
- サービス、リポジトリに処理を分割し、コントローラーを薄くしている点

フロントエンド

- Nuxt.js を採用し、SPA（シングルページアプリケーション）で配信している点
- モーダルやボトムナビゲーションを使って直感的に操作できるよう意識した点

その他

- フロントエンドでは ESLint/Prettier、バックエンドでは PHP CS Fixer といったコード解析ツールを採用し読みやすいコードを意識している点

### 使用技術

#### バックエンド

- Laravel 8.83.4
  - Laravel Sanctum
  - Laravel Fortify
  - Laravel Telescope
- Mysql 8.0
- PHP CS Fixer（コード解析ツール）
- PHPUnit

#### フロントエンド

- Nuxt.js 2.15.8（SPA モード）
- Vuetify 2.6.1（UI フレームワーク）
- ESLint/Prettier（コード解析ツール）

#### インフラストラクチャー

- AWS(ECS-FARGATE/ALB/Route53/VPC/RDS)
- CircleCI (CI/CD)
- Docker/docker-compose

#### ER 図

![ER図_portfolio](https://user-images.githubusercontent.com/92079024/189545324-d122ed73-5474-479e-933e-ba1a7cab7ed8.png)

#### インフラ構成図

![AWS3 drawio](https://user-images.githubusercontent.com/92079024/189545358-0a60551f-cc76-4593-8a63-e567dbca84e9.png)

### 機能一覧

| 機能名                 | 説明                                                                         |
| ---------------------- | ---------------------------------------------------------------------------- |
| ユーザー機能           | 会員登録、ログイン、ログアウト、ゲストログイン                               |
| ユーザーフォロー機能   | フォローしたユーザーのプロフィール閲覧可能                                   |
| 貯金記録機能           | 作成、編集、削除                                                             |
| 貯金記録表示機能       | グラフ、ランキング形式で表示                                                 |
| 目標作成機能           | 作成、編集、削除                                                             |
| 振り返り作成機能       | 作成、編集、削除                                                             |
| 振り返りお気に入り機能 | 他のユーザーの振り返りをお気に入りできる<br>お気に入りした振り返りを一覧表示 |
| 通知機能               | フォロー、お気に入りされたときに通知を取得                                   |
| ニュース閲覧機能       | NewsAPI から取得したニュースを表示                                           |
