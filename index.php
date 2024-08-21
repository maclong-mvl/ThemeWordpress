<?php
$is_images_demo = demo_image();
$url_images = "https://picsum.photos/1000/800?random=";
?>
<?php /* template name:Trang chủ */ ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <?php wp_head(); ?>
</head>

<body>
    <header>
        <div class="wp">
            <div class="wp_header">
                <div class="menu_nav_mobi">
                    <i class="fa fa-list-ul" aria-hidden="true"></i>
                </div>
                <div class="logo">
                    <a href="<?= home_url() ?>">
                        <i class="fa fa-home" aria-hidden="true"></i>
                    </a>
                </div>
                <nav class="menu">
                    <?php
                    wp_nav_menu(array(
                        'menu' => 'header',
                        'container' => false,
                        'menu_class' => 'pc-nav-links',
                    ));
                    ?>
                </nav>

                <div class="boxMxhSearch">
                    <ul>
                        <?php foreach (option('mang_xa_hoi') as $key => $mang_xa_hoi) {
                            echo ' <li><a href="' . @$mang_xa_hoi['url'] . '"><i class="dashicons ' . $mang_xa_hoi['icon'] . '"></i></a></li>';
                        } ?>
                        <li class="search">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </li>
                        <li class="languages">
                            <?php
                            $languages = icl_get_languages('skip_missing=0&orderby=code&order=DIR');

                            foreach ($languages as $key => $lang) {
                                ?>
                                <div
                                    class="<?= 'languages_' . $lang['code']; ?> <?= $lang['active'] == "1" ? "lang_active" : "" ?>">
                                    <a href="<?= $lang['url']; ?>">
                                        <img src="<?= $lang['country_flag_url']; ?>" height="12" width="18" />
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </header>
    <main>
        <section id="logo">
            <div class="wp">
                <div class="wp_logo">
                    <a href="<?= home_url() ?>">
                        <?= field_image('logo', 'option') ?>
                    </a>
                </div>
            </div>
        </section>
        <section id="one">
            <div class="wp">
                <div class="wp_one">
                    <!-- Swiper -->
                    <div id="bannerHome" class="swiper">
                        <div id="bannerHomeText"><?= field('text_section_one') ?></div>
                        <div class="swiper-wrapper">
                            <?php foreach (field('banner_home') as $key => $banner_home) { ?>
                                <div class="swiper-slide">
                                    <div class="banner_home">
                                        <img src="<?= $banner_home['anh_nen']['url'] ?>"
                                            alt="<?= $banner_home['anh_nen']['alt'] ?>">
                                        <div class="banner_home_content_box">
                                            <h2><?= $banner_home['tieu_de'] ?></h2>
                                            <p><?= $banner_home['mo_ta'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="button_home_swiper home_swiper_button_next">
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                        </div>
                        <div class="button_home_swiper home_swiper_button_prev">
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="form_search">
            <div class="wp">
                <h2 class="form_search_title"><?= field('title_section_1') ?></h2>
                <div class="wp_form_search">
                    <form action="<?= esc_url(home_url('/')); ?>" method="get">
                        <input type="text" name="s" class="input_search"
                            placeholder="<?php esc_attr_e('Search...', 'mvl'); ?>">
                        <button type="submit" class="btn_search">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                </div>
            </div>
        </section>
        </section>
        <section id="two">
            <div class="wp">
                <div class="wp_two">
                    <?php foreach (field('danh_muc_post_section_2') as $key => $danh_muc_post_section_2) { ?>
                        <div class="box_two">
                            <h3 class="box_two_title">
                                <a target="<?= $danh_muc_post_section_2['url']['target'] ?>"
                                    href="<?= $danh_muc_post_section_2['url']['url'] ?>">
                                    <?= $danh_muc_post_section_2['url']['title'] ?>
                                </a>
                            </h3>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <section id="three">
            <div class="wp">
                <div class="wp_three">
                    <div class="home_list_post">
                        <?php
                        $key = 0;
                        $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 12,
                        );

                        $the_query = new WP_Query($args);

                        if ($the_query->have_posts()):
                            while ($the_query->have_posts()):
                                $the_query->the_post();
                                ?>
                                <?= $key === 1 ? "<div class='home_list_post_col'>" : "" ?>
                                <div class="post_new <?= $key === 0 ? "new" : "off" ?>">
                                    <a href="<?php the_permalink() ?>">
                                        <h3><?php the_title() ?></h3>
                                        <div class="info_post">
                                            <span class="auth">
                                                · <?php the_author() ?>
                                            </span>
                                            <span class="date">
                                                · <?php the_date() ?>
                                            </span>
                                            <span class="time">
                                                <?php the_time(); ?>
                                            </span>
                                        </div>
                                        <div class="image_avatar">
                                            <img src="<?= $is_images_demo ? $url_images . get_the_ID() : get_the_post_thumbnail_url() ?>"
                                                alt="<?php the_title() ?>">
                                        </div>
                                        <p class="the_content">
                                            <?= wp_trim_words(get_the_content(), 100) ?>
                                        </p>
                                    </a>
                                    </p>
                                    </a>
                                </div>
                                <?= $key === (count($the_query->posts) - 1) ? "</div>" : "" ?>
                                <?php
                                $key++;
                            endwhile;

                            wp_reset_postdata();
                        else:
                            echo 'No posts found';
                        endif;
                        ?>
                    </div>
                    <div class="home_list_sidebar">
                        <?php get_sidebar() ?>
                    </div>
                </div>
            </div>

        </section>
        <section id="four">
            <div class="wp">
                <div class="wp_four">
                    <div class="wp_four_box_content">
                        <h2><?= field('title_section_4') ?></h2>
                        <?php foreach (field('list_text_section_4') as $key => $list_text_section_4) { ?>
                            <p><?= $list_text_section_4['text'] ?></p>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>
        <div class="wp">
            <div class="wp_copyright">
                <p class="copyright">Copyright © 2024 Xplorevietnamtravel. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v20.0"
        nonce="GeoZDtFw"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</body>

</html>

<script>
    $(document).ready(function () {
        $("p").click(function () {
            $(this).hide();
        });
    });
</script>

<script>
    const swiper_id_home = '#bannerHome';
    var swiper = new Swiper(swiper_id_home, {
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        effect: "fade",
        speed: 1000,
        loop: true,
        navigation: {
            nextEl: `${swiper_id_home} .home_swiper_button_next`,
            prevEl: `${swiper_id_home} .home_swiper_button_prev`,
        },
    });
</script>