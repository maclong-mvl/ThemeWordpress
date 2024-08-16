<?php 

class CleanMenuWalker extends Walker_Nav_Menu
{
    /**
     * {@inheritdoc}
     */
    function start_lvl(&$output, $depth=0, $args=array())
    {
        $output .= '<ul class="sup-menu">';
    }
    /**
     * {@inheritdoc}
     */
    function end_lvl(&$output, $depth=0, $args=array())
    {
        $output .= '</ul>';
    }
    /**
     * {@inheritdoc}
     */
    function start_el(&$output, $item, $depth=0, $args=array(), $id=0)
    {
        $class_names = '';
        $classes = empty($item->classes) ?
            array() : array_intersect($this->get_allowed_classes(), (array) $item->classes);
        // put th ecustom CSS classes back in.
        if ($custom = get_post_meta($item->ID, '_menu_item_classes', true)) {
            $classes = array_merge($classes, $custom);
        }
        $class_names = join(' ',
            apply_filters('nav_menu_css_class', array_filter(array_unique($classes)), $item, $args)
        );
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        $output .= '<li' . $class_names .'>';
        $attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target    ) .'"' : '';
        $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn       ) .'"' : '';
        $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url       ) .'"' : '';
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    /**
     * {@inheritdoc}
     */
    function end_el(&$output, $item, $depth = 0, $args = array()) {
        $output .= "</li>";
    }
    /**
     * Get the CSS classes that will be allowed on menu item li's.
     *
     * @since   1.0
     * @access  private
     * @uses    apply_filters.
     * @return  array
     */
    private function get_allowed_classes()
    {
        return apply_filters('clean_menu_walker_allowed_classes', array(
            'current-menu-item',
            'current-menu-ancestor',
        ));
    }
}
