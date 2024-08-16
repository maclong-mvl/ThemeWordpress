<?php 
/*
	Customize logo login wordpress
*/
add_action('login_head','login_css');
function login_css() {
	wp_enqueue_style('login_css', get_template_directory_uri().'/int/admin/admin.css');
	wp_enqueue_style('login_js', get_template_directory_uri().'/int/admin/admin.js');
}

// Thay doi duong dan logo admin
function wpc_url_login(){
return "https://pranasma.com/"; // duong dan vao website cua ban
}
add_filter('login_headerurl', 'wpc_url_login');