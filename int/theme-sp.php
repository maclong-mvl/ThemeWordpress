<?php

// Add col Ảnh đại diện 

// GET FEATURED IMAGE
function ST4_get_featured_image($post_ID)
{
	$post_thumbnail_id = get_post_thumbnail_id($post_ID);
	if ($post_thumbnail_id) {
		$post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'featured_preview');
		return $post_thumbnail_img[0];
	}
}

// ADD NEW COLUMN
function ST4_columns_head($defaults)
{
	$defaults['featured_image'] = 'Ảnh đại diện';
	return $defaults;
}

// SHOW THE FEATURED IMAGE
function ST4_columns_content($column_name, $post_ID)
{
	if ($column_name == 'featured_image') {
		$post_featured_image = ST4_get_featured_image($post_ID);
		if ($post_featured_image) {
			echo '<img src="' . $post_featured_image . '" width="100" />';
		} else {
			echo '<img src="http://i.imgur.com/HpGzS8e.jpg" width="100" />';
		}
	}
}
// Add end  

add_filter('manage_posts_columns', 'ST4_columns_head');
add_action('manage_posts_custom_column', 'ST4_columns_content', 10, 2);

// Tạo thêm menu 
function taothemmenu()
{
	register_nav_menu('menu-left', __('Menu left', 'mvl'));
	register_nav_menu('menu-right', __('Menu right', 'mvl'));
}
add_action('init', 'taothemmenu');

// Tạo Thêm widgets
function taothemwidgets()
{
	register_sidebar(
		array(
			'name' => esc_html__('Head', 'mvl'),
			'',
			'id' => 'head',
			'description' => esc_html__('Khu vực header'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>'
		)
	);

}
add_action('init', 'taothemwidgets');

function taofooter()
{
	register_sidebar(
		array(
			'name' => esc_html__('Footer', 'mvl'),
			'id' => 'footer',
			'description' => esc_html__('Khu vực footer'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>'
		)
	);
}
add_action('init', 'taofooter');
function theme_scripts()
{
	wp_enqueue_style('theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'theme_scripts');


function unregister_default_widgets()
{
	unregister_widget('WP_Widget_d');
	unregister_widget('WP_Widget_Media_Image');
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Media_Audio');
	unregister_widget('WP_Widget_Media_Video');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Text');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Nav_Menu_Widget');
	unregister_widget('Twenty_Eleven_Ephemera_Widget');
}
add_action('widgets_init', 'unregister_default_widgets', 11);

// Thêm kích thước ảnh 
if (function_exists('add_image_size')) {
	// add_image_size( 'homepage-thumb', 50, 50, true ); //(cropped)
}


// Xóa slug category cha ra khỏi đường dẫn của bài viết

// function devvn_post_link_category( $cat, $cats, $post ) {
//     unset($cat->parent);
//     return $cat;
// }

// add_filter( 'post_link_category', 'devvn_post_link_category', 20, 3 );


if (function_exists('acf_add_options_page')) {
	$parent = acf_add_options_page(array(
		'page_title' => 'Theme Option', // Title hiển thị khi truy cập vào Options page
		'menu_title' => 'Theme Option', // Tên menu hiển thị ở khu vực admin
		'menu_slug' => 'option-settings', // Url hiển thị trên đường dẫn của options page
		'capability' => 'edit_posts',
		// 'icon_url' => get_template_directory_uri() . '/int/admin/image/icon_option.jpg',
		'redirect' => false,
		'update_button' => __('Save', 'acf'),
	));
	// Add sub page.
	$child = acf_add_options_page(array(
		'page_title' => __('Page home'),
		'menu_title' => __('Page home'),
		'parent_slug' => $parent['menu_slug'],
	));
}
