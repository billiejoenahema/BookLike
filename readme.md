## BookLike
<a href="https://gyazo.com/f00b879be3ba413e91611d39ba0ceee0"><img src="https://i.gyazo.com/f00b879be3ba413e91611d39ba0ceee0.png" alt="Image from Gyazo" width="1240"/></a>

## URL
https://booklikeapp.com
<br />
お試しログインをご利用いただけます（ユーザー登録不要）

## 概要
ユーザーが自分のお気に入りの書籍を気軽に共有したり、みんなのお気に入りの中から読みたい本を探すことができるサービスです。

## 背景
スマホで本を読むようになってからすっかり読書の習慣が身についたのはいいものの、自分の知っている範囲内において、めぼしいタイトルはあらかた読み終えてしまいました。面白そうな本はないかといろんなサイトで検索してみてもおすすめされているのは大体既読の作品だったり、たとえ未読であってもその本が自分に合っているかどうか判別がむずかしい。

## 機能一覧
### ユーザー機能
- ユーザー (登録/編集/削除)
- ゲストログイン
- ユーザーアイコン画像 (登録・変更)
- マイページ (自分の投稿/いいねした投稿/フォロー中/フォロワー)
- フォロー

### ユーザー一覧
- 並び替え (登録順/フォロワー数)
- ユーザー検索
- 無限スクロール

### 投稿機能
- 投稿 (新規投稿/編集/削除)
- いいね
- コメント
- 書籍検索機能 (Amazon API)

### 投稿一覧
- 並び替え (投稿順/いいね順)
- 検索 (タイトル/著者/出版社)
- 絞り込み
- 無限スクロール

## モバイルファースト
スマホ表示を優先してCSSをカスタマイズしました
<br />
左から、マイページ / 書籍検索画面 / 投稿一覧
<a href="https://gyazo.com/314644882185aa0c181725a752f524c8"><img src="https://i.gyazo.com/314644882185aa0c181725a752f524c8.jpg" alt="Image from Gyazo" width="2282"/></a>

## 使用技術
### フロントエンド
- HTML
- CSS
- JavaScript
- Bootstrap4
- React

### バックエンド
- PHP
- Laravel

### 開発環境・インフラなど
- Apache
- MySQL
- AWS (EC2, RDS, ACM, Route53, ALB, CloudFront, S3)
- GitHub
- PHPUnit

### 外部API
- Amazon Product Advertizing API

## インフラ構成図
<a href="https://gyazo.com/811c351cd60543f6e965e23c92849cf7"><img src="https://i.gyazo.com/811c351cd60543f6e965e23c92849cf7.png" alt="Image from Gyazo" width="922"/></a>

## ER図
<a href="https://gyazo.com/1993b96c3d895861d215a44a79e6aa7f"><img src="https://i.gyazo.com/1993b96c3d895861d215a44a79e6aa7f.png" alt="Image from Gyazo" width="1000"/></a>

## 開発において意識したこと
