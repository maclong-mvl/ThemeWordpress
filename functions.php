<?php require_once get_template_directory() . '/int/init.php';
function d($data)
{
    var_dump($data);
}
function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}
function option($key)
{
    return get_field($key, 'option');
}
function field($key)
{
    return get_field($key);
}
function field_image($key, $type = false)
{

    if ($type == 'option') {
        return '<img src="' . get_field($key, 'option')['url'] . '" alt="' . get_field($key, 'option')['alt'] . '">';
    }
    return '<img src="' . get_field($key)['url'] . '" alt="' . get_field($key)['alt'] . '">';
}

function demo_image()
{
    return get_field('setting_image_demo', 'option');
}