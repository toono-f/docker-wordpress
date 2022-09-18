<?php
// ==========================================================================
// バージョン非公開
// ==========================================================================
// WordPressバージョンの非表示
// remove_action('wp_head', 'wp_generator');
// 本体の更新通知を非表示(有効にすると自動更新（マイナーアップデート含む）が無効になる)
// add_filter("pre_site_transient_update_core", "__return_null");
// プラグインの更新通知を非表示（有効にすると管理画面上でバージョンアップデートは不可能になる）
// add_filter("pre_site_transient_update_plugins", "__return_null");
// テーマの更新通知を非表示
// add_filter("pre_site_transient_update_themes", "__return_null");
// ==========================================================================
// ダッシュボード表示項目非表示
// ==========================================================================
// function remove_dashboard_widget()
// {
//   remove_action('welcome_panel', 'wp_welcome_panel'); // ようこそ
//   remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // 概要
//   remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // アクティビティ
//   remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); // クイックドラフト
//   remove_meta_box('dashboard_primary', 'dashboard', 'side'); // WordPress イベントとニュース
// }
// add_action('wp_dashboard_setup', 'remove_dashboard_widget');
// ==========================================================================
// 管理画面メニューカスタマイズ(unsetで非表示)
// ==========================================================================
// function remove_menus()
// {
//   global $menu;
//   unset($menu[2]);  // ダッシュボード
//   unset($menu[4]);  // メニューの線1
//   unset($menu[5]);  // 投稿
//   unset($menu[10]); // メディア
//   unset($menu[15]); // リンク
//   unset($menu[20]); // ページ
//   unset($menu[25]); // コメント
//   unset($menu[59]); // メニューの線2
//   unset($menu[60]); // テーマ
//   unset($menu[65]); // プラグイン
//   unset($menu[70]); // プロフィール
//   unset($menu[75]); // ツール
//   unset($menu[80]); // 設定
//   unset($menu[90]); // メニューの線3
// }
// add_action('admin_menu', 'remove_menus');
// ==========================================================================
// 投稿画面から不要な機能を削除します。
// ==========================================================================
// function remove_post_supports()
// {
//   remove_post_type_support('post', 'title'); // タイトル
//   remove_post_type_support('post', 'editor'); // 本文欄
//   remove_post_type_support('post', 'author'); // 作成者
//   remove_post_type_support('post', 'thumbnail'); // アイキャッチ
//   remove_post_type_support('post', 'excerpt'); // 抜粋
//   remove_post_type_support('post', 'trackbacks'); // トラックバック
//   remove_post_type_support('post', 'custom-fields'); // カスタムフィールド
//   remove_post_type_support('post', 'comments'); // コメント
//   remove_post_type_support('post', 'revisions'); // リビジョン
//   remove_post_type_support('post', 'page-attributes'); // ページ属性
//   remove_post_type_support('post', 'post-formats'); // 投稿フォーマット
//   unregister_taxonomy_for_object_type('category', 'post'); // カテゴリ
//   unregister_taxonomy_for_object_type('post_tag', 'post'); // タグ
// }
// add_action('init', 'remove_post_supports');
// ==========================================================================
// 投稿画面から不要な枠(メタボックス)を無効にします。
// ==========================================================================
// function remove_post_meta_boxes() {
// 	remove_meta_box( 'slugdiv', 'post', 'normal' ); // スラッグ
// 	remove_meta_box( 'submitdiv', 'post', 'side' ); // 公開
// }
// add_action( 'admin_menu', 'remove_post_meta_boxes' );
// ==========================================================================
// カテゴリーの選択を1つに制限
// ==========================================================================
function limit_category_select()
{
?>
  <script type="text/javascript">
    jQuery(function($) {
      // 投稿画面のカテゴリー選択を制限
      var categorydiv = $('#categorydiv input[type=checkbox]');
      categorydiv.click(function() {
        $(this).parents('#categorydiv').find('input[type=checkbox]').attr('checked', false);
        $(this).attr('checked', true);
      });
      // クイック編集のカテゴリー選択を制限
      var inline_edit_col_center = $('.inline-edit-col-center input[type=checkbox]');
      inline_edit_col_center.click(function() {
        $(this).parents('.inline-edit-col-center').find('input[type=checkbox]').attr('checked', false);
        $(this).attr('checked', true);
      });

      $('#categorydiv #category-pop > ul > li:first-child, #categorydiv #category-all > ul > li:first-child, .inline-edit-col-center > ul.category-checklist > li:first-child').before('<p style="padding-top:5px;">カテゴリーは1つしか選択できません</p>');

    });
  </script>
<?php
}
add_action('admin_print_footer_scripts', 'limit_category_select');
// ==========================================================================
// カテゴリー「よく使うもの」を非表示
// ==========================================================================
// function my_admin_style()
// {
//   echo '<style>
// 	div.categorydiv li.hide-if-no-js{
// 	display:none;
// 	}
// 	</style>' . PHP_EOL;
// }
// add_action('admin_print_styles', 'my_admin_style');
// ==========================================================================
// 新規カテゴリ追加非表示
// ==========================================================================
// function my_admin_style02()
// {
//   echo '<style>
// 	div.wp-hidden-children a.hide-if-no-js{
// 	display:none;
// 	}}
// 	</style>' . PHP_EOL;
// }
// add_action('admin_print_styles', 'my_admin_style02');
// ==========================================================================
// パンくずリスト生成
// ==========================================================================
if (!function_exists('custom_breadcrumb')) {
  function custom_breadcrumb()
  {
    // トップページでは何も出力しない
    if (is_front_page()) return false;
    // そのページのWPオブジェクトを取得
    $wp_obj = get_queried_object();
    echo '<div class="l-contents__normal">' .
      '<ul class="l-breadcrumb">' .
      '<li class="l-breadcrumb__lists">' .
      '<a href="' . esc_url(home_url()) . '">TOP</a>' .
      '</li>';
    if (is_attachment()) {
      // 添付ファイルページ
    } elseif (is_page()) {
      // 固定ページ ( $wp_obj : WP_Post )
      $page_id    = $wp_obj->ID;
      $page_title = $wp_obj->post_title;
      // 親ページがあれば順番に表示
      if ($wp_obj->post_parent !== 0) {
        $parent_array = array_reverse(get_post_ancestors($page_id));
        foreach ($parent_array as $parent_id) {
          echo '<li class="l-breadcrumb__lists">' .
            '<a href="' . get_permalink($parent_id) . '">' . get_the_title($parent_id) .
            '</a>' .
            '</li>';
        }
      }
      // 投稿自身の表示
      echo '<li class="l-breadcrumb__lists"><span>' . esc_html(strip_tags($page_title)) . '</span></li>';
    } else {
      // その他
    }
    echo '</ul></div>';  // 冒頭に合わせた閉じタグ
  }
}
// ==========================================================================
// ビジュアルエディターの自動整形のp削除
// ==========================================================================
function override_mce_options($init_array)
{
  //グローバル変数の宣言
  global $allowedposttags;
  //エディタのビジュアル/テキスト切替でコード消滅を防止（自動整形無効化）
  $init_array['valid_elements']          = '*[*]';
  $init_array['extended_valid_elements'] = '*[*]';
  //aタグ内ですべてのタグを仕様可能に
  $init_array['valid_children']          = '+a[' . implode('|', array_keys($allowedposttags)) . ']';
  $init_array['indent']                  = true;
  //pタグの自動挿入を無効化
  $init_array['wpautop']                 = false;
  $init_array['force_p_newlines']        = false;
  //改行をbrタグに置き換える
  $init_array['force_br_newlines']       = true;
  $init_array['forced_root_block']       = '';
  return $init_array;
}
add_filter('tiny_mce_before_init', 'override_mce_options');
remove_filter('the_excerpt', 'wpautop');
remove_filter('the_content', 'wpautop');
// 固定ページのみ自動的に付与されるpタグやbrタグを無効にする場合
// function disable_page_wpautop()
// {
//   if (is_page()) {
//     remove_filter('the_content', 'wpautop');
//     remove_filter('the_excerpt', 'wpautop');
//   }
// }
// add_action('wp', 'disable_page_wpautop');
// ==========================================================================
// TinyMCE Advencedのフォントサイズのラベルとサイズ変更
// ==========================================================================
function tinymce_custom_fonts($setting)
{
  $setting['fontsize_formats'] = "10=0.625em 12=0.75em 14=0.875em 16=1em 18=1.125em 20=1.25em 24=1.5em 32=2em 40=2.5em 48=3em";
  return $setting;
}
add_filter('tiny_mce_before_init', 'tinymce_custom_fonts', 5);
// ==========================================================================
// ビジュアルエディタで出力できるタグの変更
// ==========================================================================
// function custom_tiny_mce_formats($settings)
// {
//   $settings['block_formats'] = '段落=p;見出し1=h3;見出し2=h4;見出し3=h5;スペース=div;';
//   return $settings;
// }
// add_filter('tiny_mce_before_init', 'custom_tiny_mce_formats');
// ==========================================================================
// ページネーション
// ==========================================================================
function pagination($pages = '', $range = 2)
{
  $showitems = ($range * 2) + 1;
  global $paged;
  if (empty($paged)) $paged = 1;
  if ($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if (!$pages) {
      $pages = 1;
    }
  }
  if (1 != $pages) {
    echo "<div class=\" p-pager-nl \">\n";
    // Prev：現在のページ値が１より大きい場合は表示
    if ($paged > 1) echo "<a class=\" p-pager-nl__back \" href='" . get_pagenum_link($paged - 1) . "'>前へ;</a>\n";
    for ($i = 1; $i <= $pages; $i++) {
      if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
        echo ($paged == $i) ? "<a class=\"p-pager-nl__number is-active\">" . $i . "</a>\n" : "<a class=\"p-pager-nl__number\" href='" . get_pagenum_link($i) . "'>" . $i . "</a>\n";
      }
    }
    // Next：総ページ数より現在のページ値が小さい場合は表示
    if ($paged < $pages) echo "<a class=\"p-pager-nl__next\" href=\"" . get_pagenum_link($paged + 1) . "\">次へ</a>\n";
    echo "</div>\n";
  }
}
// ==========================================================================
// TOPページのページネーション発火防止
// ==========================================================================
function status404()
{
  if (is_home() && is_paged()) {
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
  }
}
add_action('template_redirect', 'status404');
// ==========================================================================
// 投稿アーカイブを任意のURLで出力する→パーマリンク設定の更新必要
// ==========================================================================
function post_has_archive($args, $post_type)
{
  if ('post' == $post_type) {
    $args['rewrite'] = true;
    $args['has_archive'] = 'topics'; // 任意のスラッグ名
  }
  return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);
// ==========================================================================
// title属性設定
// ==========================================================================
function setup_theme()
{
  add_theme_support('title-tag');
}
add_action('after_setup_theme', 'setup_theme');
// ==========================================================================
// title属性のセパレータを任意のものに変更する（all in one seoでも同様の現象を確認可能）
// ==========================================================================
function custom_title_separator($sep)
{
  $sep = '|';
  return $sep;
}
add_filter('document_title_separator', 'custom_title_separator');
// ==========================================================================
// Gutenbergを使わないので「wp-block-library-css」を削除する
// ==========================================================================
// function dequeue_plugins_style()
// {
//   wp_dequeue_style('wp-block-library');
// }
// add_action('wp_enqueue_scripts', 'dequeue_plugins_style', 9999);
// ==========================================================================
// 絵文字を使わない
// ==========================================================================
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles', 10);
// ==========================================================================
// DNSプリフェッチ用コードを削除
// ==========================================================================
function remove_dns_prefetch($hints, $relation_type)
{
  if ('dns-prefetch' === $relation_type) {
    return array_diff(wp_dependencies_unique_hosts(), $hints);
  }
  return $hints;
}
add_filter('wp_resource_hints', 'remove_dns_prefetch', 10, 2);
// ==========================================================================
// 以下のワーニング回避：URLパラメータが配列だと怒られるので、文字列に変換（絞り込み検索機能実装する場合）
// Warning: urlencode() expects parameter 1 to be string, array given
// ==========================================================================
// function my_query_string($q)
// {
//   foreach (get_taxonomies(array(), 'objects') as $taxonomy => $t) {
//     if ($t->query_var && !empty($q[$t->query_var])) {
//       if (is_array($q[$t->query_var])) {
//         $q[$t->query_var] = implode(',', $q[$t->query_var]);
//       }
//     }
//   }
//   return $q;
// }
// add_filter('request', 'my_query_string', 1);
