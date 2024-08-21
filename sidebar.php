<div class="listCategoryPost">
    <ul>
        <?php $args = array(
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'exclude' => array(1),
        );
        $categories = get_categories($args);

        foreach ($categories as $key => $category) { ?>
            <li class="<?= $key % 2 == 0 ? "active" : "" ?>">
                <a href="<?= get_category_link($category->term_id) ?>"><?= $category->name ?></a>
            </li>
        <?php } ?>

    </ul>
</div>

<div class="imgage_sidebar">
    <a href="">
        <?= field_image('image_option_sidebar', 'option') ?>
    </a>
</div>

<div class="form_search">
    <h3 class="title_sidebar"><?= __('EXPLORE OUR CATALOG', 'mvl') ?></h3>
    <form action="<?php echo esc_url(home_url('/')); ?>" method="get">
        <input type="text" name="s" placeholder="What are you looking for?...">
        <button type="submit"><?= __('Search', 'mvl') ?></button>
    </form>
</div>

<div class="witghet_sidebar post">
    <h3 class="title_sidebar">EXPLORE OUR Post</h3>
    <ul>
        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 10,
        );

        $the_query = new WP_Query($args);

        if ($the_query->have_posts()):
            while ($the_query->have_posts()):
                $the_query->the_post();
                echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
            endwhile;

            // Reset Post Data
            wp_reset_postdata();
        else:
            // No posts found
            echo 'No posts found';
        endif;
        ?>
    </ul>
</div>


<div class="fb-page" data-href="<?= option('facebook_page') ?>" data-width="340" data-height="400"
    data-hide-cover="false" data-show-facepile="true"></div>

<div class="witghet_sidebar tag">
    <h3 class="title_sidebar"><?= __('EXPLORE OUR TAG', 'mvl') ?></h3>
    <ul>
        <?php $tags = get_tags();
        foreach ($tags as $key => $tag) {
            $tag_link = get_tag_link($tag->term_id);
            echo '<li><a href="' . $tag_link . '">' . $tag->name . '</a></li>';
        } ?>
    </ul>
</div>