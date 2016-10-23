<?php /* Template Name: Gallery */ ?>
<?php get_header(); ?>

<?php
$wpb_all_query = new WP_Query(array('post_type'=>'gallery', 'post_status'=>'publish', 'posts_per_page'=>-1)); ?>


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

    <div class="lead-text">
    	<?php 
        	$page = get_post(get_the_ID()); 
			$content = apply_filters('the_content', $page->post_content); 
            echo $content;
        ?>
    </div>

<?php  if ($wpb_all_query->have_posts()) : ?>
	<?php $alignmentClass = "uk-float-right uk-flex-order-last-medium"; ?>
	<?php while ($wpb_all_query->have_posts()) : $wpb_all_query->the_post(); ?>
		
		<?php $alignmentClass = $alignmentClass == "uk-float-right uk-flex-order-last-medium" ? "" : "uk-float-right uk-flex-order-last-medium"; ?>
		<div class="uk-grid">
			<div class="uk-width-medium-1-2 <?php echo $alignmentClass; ?>">
				<a href="<?php the_permalink(); ?>">
					<div class="uk-overlay uk-overlay-hover ">
						<?php the_post_thumbnail('medium_large', array('class' => 'uk-overlay-scale')); ?>
					</div>
				</a>
			</div>

			<div class="uk-width-medium-1-2">
				<div class="uk-panel uk-panel-space">
					<a href="<?php the_permalink(); ?>">
						<h2><?php the_title(); ?></h2>
					</a>
					<p><?php the_excerpt() ?></p>
				</div>
			</div>
		</div>


	<?php endwhile; ?>
<?php endif; ?>
</article>

<?php get_footer(); ?>