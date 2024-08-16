<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
   // Các thành phần của bài viết
<?php endwhile;?>
<?php endif; ?>