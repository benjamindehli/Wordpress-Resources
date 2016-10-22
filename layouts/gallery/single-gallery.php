
<?php 
$photos = rwmb_meta( 'photos_imgadv', get_the_ID() );
?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        
        
        <article class="uk-article" data-permalink="<?php the_permalink(); ?>">
           

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
                <?php the_content(''); ?>
            </div>

            <div class="uk-grid masonry-row">
            <?php 
                $itemnumber = 0;
                $numberOfItems = count($photos);
            ?>
            <?php foreach ($photos as $photo) { ?>
                <div class="uk-width-medium-1-3 uk-width-small-1-2 gallery-image masonry-item">
                    <div class="card">
                        <div class="uk-thumbnail photo-modal" id="item-<?php echo $itemnumber ?>">
                            <div class="helper">
                                <div class="photo-modal-content">
                                    <div class="modal-header">
                                        <span class="modal-title">
                                            <?php echo $photo["caption"]; ?>
                                        </span>
                                        <span class="photo-modal-close"></span>
                                    </div>
                                    <div class="uk-overlay">
                                        <img src="<?php echo $photo["full_url"]; ?>" 
                                             srcset="<?php echo $photo["srcset"]; ?>" 
                                             alt="<?php echo $photo["alt"]; ?>" 
                                        />
                                    </div>
                                    <div class="modal-buttons">
                                        <?php $prevItemNumber = ($itemnumber > 0) ? $itemnumber - 1 : $numberOfItems - 1; ?>
                                            <span id="item-<?php echo $itemnumber ?>-toggle-prev" 
                                                  class="photo-modal-toggle" 
                                                  style="left: 0;" 
                                                  data-deactivate-item="item-<?php echo $itemnumber ?>" 
                                                  data-activate-item="item-<?php echo $prevItemNumber ?>">
                                                <span class="toggle-icon uk-icon uk-icon-angle-left"></span>
                                            </span>

                                        <?php $nextItemNumber = (($itemnumber + 1) < $numberOfItems) ? $itemnumber + 1 : 0; ?>

                                            <span id="item-<?php echo $itemnumber ?>-toggle-next" 
                                                  class="photo-modal-toggle" 
                                                  style="right: 0;" 
                                                  data-deactivate-item="item-<?php echo $itemnumber ?>" 
                                                  data-activate-item="item-<?php echo $nextItemNumber ?>">
                                                <span class="toggle-icon uk-icon uk-icon-angle-right"></span>
                                            </span>
                                    </div>
                                    <div class="modal-text">
                                            <?php echo $photo["description"]; ?>
                                            <span class="localstorage-add-photo uk-icon uk-icon-cart-arrow-down uk-float-right" 
                                                  data-photo-url="<?php echo $photo["full_url"]; ?>"
                                                  data-photo-thumbnail="<?php echo $photo["url"]; ?>"
                                                  data-photo-gallery="<?php the_title(); ?>" 
                                                  data-photo-caption="<?php echo $photo["caption"]; ?>"
                                                  data-photo-description="<?php echo $photo["description"]; ?>"
                                                  >
                                            </span>
                                    </div>  
                                </div>
                            </div>
                        </div>
                        <div class="uk-thumbnail-caption">
                        <?php echo $photo["caption"]; ?>
                            <span class="localstorage-add-photo uk-icon uk-icon-cart-arrow-down uk-float-right" 
                                  data-photo-url="<?php echo $photo["full_url"]; ?>"
                                  data-photo-thumbnail="<?php echo $photo["url"]; ?>"
                                  data-photo-gallery="<?php the_title(); ?>" 
                                  data-photo-caption="<?php echo $photo["caption"]; ?>"
                                  data-photo-description="<?php echo $photo["description"]; ?>"
                                  >
                            </span>
                            <div class="uk-clearfix"></div>
                        </div>
                    </div>
                </div>
            <?php $itemnumber++; ?>
            <?php  } ?>
            </div>
            

            
           

            <?php wp_link_pages(); ?>

            <?php the_tags('<p>'.__('Tags: ', 'warp'), ', ', '</p>'); ?>

            <?php edit_post_link(__('Edit this post.', 'warp'), '<p><i class="uk-icon-pencil"></i> ','</p>'); ?>

            <?php if (pings_open()) : ?>
                <p><?php printf(__('<a href="%s">Trackback</a> from your site.', 'warp'), get_trackback_url()); ?></p>
            <?php endif; ?>

            <?php if (get_the_author_meta('description')) : ?>
                <div class="uk-panel uk-panel-box">

                    <div class="uk-align-medium-left">

                        <?php echo get_avatar(get_the_author_meta('user_email')); ?>

                    </div>

                    <h2 class="uk-h3 uk-margin-top-remove"><?php the_author(); ?></h2>

                    <div class="uk-margin"><?php the_author_meta('description'); ?></div>

                </div>
            <?php endif; ?>

            <?php
            $prev = get_previous_post();
            $next = get_next_post();
            ?>

        </article>
    
    <?php endwhile; ?>
<?php endif; ?>