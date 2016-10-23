<?php /* Template Name: Page with header image */ ?>
<?php get_header(); ?>

<article class="uk-article">

    <?php if (has_post_thumbnail()) : $post_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'original' ); ?>
        <div class="uk-cover-background tm-featured-image uk-slideshow uk-overlay-active" style="background-image:url(<?php echo $post_image[0]; ?>);">
            <div class="uk-overlay-panel uk-flex uk-flex-center uk-flex-middle uk-text-center">
                <div>
                    <h1 class="uk-article-title uk-heading-large" id="main-title"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
        <div class="uk-cover-background-spacer"></div>
    <?php endif; ?>

    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>

            <?php the_content(''); ?>

            <?php edit_post_link(__('Edit this post.', 'warp'), '<p><i class="uk-icon-pencil"></i> ','</p>'); ?>

        <?php endwhile; ?>
    <?php endif; ?>
</article>
<?php get_footer(); ?>