## BookLike

<a href="https://gyazo.com/f6d0d6ec415ca3ac0a999cc207c47841"><img src="https://i.gyazo.com/f6d0d6ec415ca3ac0a999cc207c47841.png" alt="Image from Gyazo" width="1200"/></a>

## 概要

読み終えた本を気軽に投稿することで、電子書籍、紙の本にかかわらず既読本の履歴を確認したり、ほかのユーザーが読んだ本の評価や感想を参考にして読みたい本を見つけたりするとができるサービスです。

## 機能一覧

### ユーザー機能

-   ユーザー (登録, 編集, 削除)
-   ゲストログイン (ゲストユーザーはプロフィール編集不可)
-   ユーザーアイコン画像 (登録, 変更)
-   マイページ (タブによる表示切り替え[自分の投稿, いいねした投稿, フォロー中, フォロワー])
-   ユーザーをフォロー

### ユーザー一覧

-   並び替え (登録順, 投稿数, フォロワー数, いいね獲得数)
-   ユーザー検索（非同期・部分一致検索）
-   無限スクロール

### 投稿機能

-   投稿 (新規投稿, 編集, 削除)
-   投稿にいいね
-   コメント
-   書籍検索機能 (Amazon API 利用)

### 投稿一覧

-   並び替え (投稿順, いいね順, 評価順)
-   検索 (タイトル, 著者, 出版社)
-   カテゴリーで絞り込み
-   無限スクロール

## 使用技術

### フロントエンド

-   HTML5
-   CSS3
-   JavaScript
-   Bootstrap 4.5
-   React 16.13

### バックエンド

-   PHP 7.3
-   Laravel 6.20

### 開発環境・インフラなど

-   Apache
-   MySQL
-   AWS (EC2, RDS, ACM, Route53, ALB, CloudFront, S3) // 2021 年 11 月に close しました。
-   GitHub
-   PHPUnit

### 外部 API

-   Amazon Product Advertizing API

## インフラ構成図

<a href="https://gyazo.com/811c351cd60543f6e965e23c92849cf7"><img src="https://i.gyazo.com/811c351cd60543f6e965e23c92849cf7.png" alt="Image from Gyazo" width="922"/></a>

## ER 図

<a href="https://gyazo.com/045f627e5cb9fc582748ba1e63fc8d3e"><img src="https://i.gyazo.com/045f627e5cb9fc582748ba1e63fc8d3e.png" alt="Image from Gyazo" width="936"/></a>
