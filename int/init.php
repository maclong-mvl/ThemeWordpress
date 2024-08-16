<?php
// CORE MAC VAN LONG 2018 - 2.0 
/**
  @ Thiết lập các hằng dữ liệu quan trọng
  @ THEME_URL = get_stylesheet_directory() - đường dẫn tới thư mục theme
  @ int = thư mục /int của theme, chứa các file nguồn quan trọng.
  **/
define('THEME_URL', get_stylesheet_directory());
define('int', THEME_URL . '/int');

/**
  @ Load file /int/init.php
  @ Đây là file cấu hình ban đầu của theme mà sẽ không nên được thay đổi sau này.
  **/

require_once(int . '/init.php');

/**
 @ Thiết lập $content_width để khai báo kích thước chiều rộng của nội dung
 **/
if (!isset($content_width)) {
  /*
   * Nếu biến $content_width chưa có dữ liệu thì gán giá trị cho nó
   */
  $content_width = 620;
}

/**
  @ Thiết lập các chức năng sẽ được theme hỗ trợ
  **/
if (!function_exists('mvl_theme_setup')) {
  /*
   * Nếu chưa có hàm mvl_theme_setup() thì sẽ tạo mới hàm đó
   */
  function mvl_theme_setup()
  {
    /*
     * Thiết lập theme có thể dịch được
     */
    $language_folder = THEME_URL . '/languages';
    load_theme_textdomain('mvl', $language_folder);

    /*
     * Tự chèn RSS Feed links trong <head>
     */
    add_theme_support('automatic-feed-links');

    /*
     * Thêm chức năng post thumbnail
     */
    add_theme_support('post-thumbnails');

    /*
     * Thêm chức năng title-tag để tự thêm <title>
     */
    add_theme_support('title-tag');

    /*
     * Thêm chức năng post format
     */
    add_theme_support(
      'post-formats',
      array(
        'video',
        'image',
        'audio',
        'gallery'
      )
    );

  }
  add_action('init', 'mvl_theme_setup');
}
/*
 *  Hỗ trợ thene woocommerce
 */
function mytheme_add_woocommerce_support()
{
  add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'mytheme_add_woocommerce_support');
/*
 * Gọi file init chức năng "
 */



require_once get_template_directory() . '/int/theme-sp.php';

require_once get_template_directory() . '/int/widgets/widget.php';

require_once get_template_directory() . '/int/menu/menu_walker.php';