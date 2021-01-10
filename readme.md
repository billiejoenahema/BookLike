## BookLike
<a href="https://gyazo.com/1d1e4b6e5fb64ec34d0790c816462fcc"><img src="https://i.gyazo.com/1d1e4b6e5fb64ec34d0790c816462fcc.png" alt="Image from Gyazo" width="1201"/></a>

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
- ユーザー (登録, 編集, 削除)
- ゲストログイン (ゲストユーザーはプロフィール編集不可)
- ユーザーアイコン画像 (登録, 変更)
- マイページ (タブで表示切り替え[自分の投稿, いいねした投稿, フォロー中, フォロワー])
- ユーザーをフォロー

### ユーザー一覧
- 並び替え (登録順, 投稿数, フォロワー数, いいね獲得数)
- ユーザー検索
- 無限スクロール

### 投稿機能
- 投稿 (新規投稿, 編集, 削除)
- 投稿にいいね
- コメント (リアルタイム文字数カウント)
- 書籍検索機能 (Amazon API 利用)

### 投稿一覧
- 並び替え (投稿順, いいね順)
- 検索 (タイトル, 著者, 出版社)
- カテゴリーで絞り込み
- 無限スクロール

## 使用技術
### フロントエンド
- HTML5
- CSS3
- JavaScript
- Bootstrap 4.5
- React 16.13

### バックエンド
- PHP 7.3
- Laravel 6.20

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
<a href="https://gyazo.com/882e9057ad87d8e1b59ddb3bbd01dcdd"><img src="https://i.gyazo.com/882e9057ad87d8e1b59ddb3bbd01dcdd.png" alt="Image from Gyazo" width="942"/></a>

## 開発において意識したこと

### モバイルファースト
スマホ表示を優先してCSSをカスタマイズしました
<br />
投稿一覧 / 書籍検索画面 / ユーザープロフィール
<a href="https://gyazo.com/fb41f18984fe11582f00c03d9c498cb0"><img src="https://i.gyazo.com/fb41f18984fe11582f00c03d9c498cb0.jpg" alt="Image from Gyazo" width="2282"/></a>

### UI/UXの改善
ユーザー目線を重視して使い勝手の向上に努めました
- ロード時間の短縮
- 誤操作の防止
