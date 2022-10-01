# セットアップ
```
docker-compose up -d
```

起動後、http://localhost:8000/を確認してください。

# WordPressのおすすめプラグイン
## セキュリティ
|推奨|プラグイン名|機能|
| ---- | ---- | ---- |
|★|Akismet Anti-Spam|デフォルトで入ってる。コメント欄などのスパム対策　コメント欄を開放してる方は有効するなど|
|★|all in one security & firewall(WP　security)|キュリティ対策を包括的に実装できる。コメント機能を無効化する・管理画面への不正アクセスを防ぐ・Pingback機能を無効化する・標準のログインページwp-login.phpを使用できないようにする・同一IPアドレスからのアクセスで連続してログイン失敗すると一定期間経過するまではそのIPアドレスからのログイン操作が出来なくなる、等|
||Wordfence|改ざんされたファイルを見つけ出す。管理画面上で削除もできる。プラグインやwpの更新がきたらすぐに知らせてくれる|

## エディタ
|推奨|プラグイン名|機能|
| ---- | ---- | ---- |
|★|TinyMCE Advanced|投稿画面の編集ボタンの種類を増やし、HTMLやタグの知識がない方でも、無料ブログと同じ感覚で記事を設定できるようになる|
||Classic Editor|旧エディター。|
|★|Disable Gutenberg|ブロックエディタを使わせたくない時に入れる|

## フォーム
|推奨|プラグイン名|機能|
| ---- | ---- | ---- |
||MW WP Form|ショートコードを使って確認画面付きのメールフォームを作成することができる。自由にフォームをデザインすることもできます|
||contact form 7|複数のコンタクトフォームを管理できてその上フォームとメールの内容を簡単なマークアップで柔軟にカスタマイズしたりもできます|
||WP Mail SMTP|指定したSMTPサーバを使ってメールを送信できるようにするプラグインです。メールサーバ別の場合に使う|

## SEO
|推奨|プラグイン名|機能|
| ---- | ---- | ---- |
||All In One SEO Pack|WordPressで作成したサイトに必要な基本の SEO設定をカバーできる|
||Yoast SEO|WordPressで作成したサイトに必要な基本の SEO設定をカバーできる|
||XML Sitemaps|上記二つのどちからが入っている場合競合するので不要。検索エンジンのための完全なXMLサイトマップを提供。ルートにsitemap.xmlが基本設定|
||Markup (JSON-LD) structured in schema.org|構造化データを設定することができる。静的ページ作成段階で設定していなければ利用推奨。|


## カスタム投稿・フィールド
|推奨|プラグイン名|機能|
| ---- | ---- | ---- |
||Custom Post Type Permalinks|カスタム投稿タイプのパーマリンク設定を編集可能にします|
||Advanced Custom Fields|WordPressの編集画面とカスタムフィールドデータのコントロールを完全に制御します|
||Smart Custom Fields|カスタムフィールドを管理するシンプルなプラグインです|

## その他
|推奨|プラグイン名|機能|
| ---- | ---- | ---- |
|★|WP Multibyte Patch|文字化け防止機能。バグを防止するためのプラグインです|
|★|BackWPup|サーバー上とデータベース上の２つのデータのバックアップを安定して行うことができる|
||WP-PageNavi|サイト内にカスタマイズ可能なページナビゲーションを追加することができます|
||Duplicate Post|WordPressの記事を複製することができる|
||WebP Converter for Media|標準のJPEG、PNG、GIF形式のファイルをWebP形式に置き換える　※サーバー依存による影響があるので確認必要|
||EWWW Image Optimizer|画像圧縮。画像を最適化することでページのロード速度を向上させます|
||Redirection|指定したURLから他のURLへと転送を行うことができます。サイトが移転した時などに設定しておくと便利|
||Media Library Assistant|メディアファイルの管理。カテゴリ別など|
||Enable Media Replace|画像差し替え。メディア画像を簡単に差し替えてパスも上書き更新できる|
||Category Order and Taxonomy Terms Order|カテゴリーとカスタムタクソノミーの順番をドラッグ＆ドロップで簡単入れ替え|