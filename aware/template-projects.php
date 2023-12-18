<?php
/*
Template Name: Page - All Projects
*/
?>
<?php get_header(); ?>
<!--Start Top Section -->
<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>

<!-- Page Title
  ================================================== -->
<div class="container clearfix">
    <div class="pagename sixteen columns fadeInUp animated">
        <h1><?php if ($projecttitle = get_option('of_portfolio_title')) { echo $projecttitle; } else { echo 'Projects';} ?>
        </h1>
    </div>
</div>

<!-- Page Content
  ================================================== -->
<div class="container clearfix fadeInUp animated">
    <div class="eleven columns blogwrap">
    
     <?php  // Grab the global ProperPagination and WP_Query instances
		global $pp, $wp_query, $wp;
		
		$counter = 1;
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		// Construct the custom WP_Query instance
		$loop = new WP_Query( array( 'post_type' => 'portfolio', 'paged' => $paged) );

	if ( function_exists('pp_has_pagination') ) : 
	
		// Override the number of found posts on the ProperPagination instance
		$pp->found_posts = (int)$loop->found_posts;
		$pp->max_pages = ceil($pp->found_posts / $pp->posts_per_page);
       
		   if ($counter == 1) {     
				// How many page links do we display at one time?
				$pp->max_page_links = min((int)get_option('pp_max_pagelinks'), $pp->max_pages);
				
				// Derive start and end values for the pagination links
				if ($pp->max_pages <= $pp->max_page_links) {
					// Start at the very beginning, end at the very end
					$pp->start = 1;
					$pp->end = $pp->max_pages;
				} else {
					$pp->start = max(1, $pp->page - floor($pp->max_page_links / 2));
					$pp->end = min($pp->max_pages, $pp->start + $pp->max_page_links - 1);
				}
			$counter++;	
		   }
	endif;

// Loop through your posts...
while ( $loop->have_posts() ) : $loop->the_post();   ?>
            
        <div class="blogpost portfolio">
        <div class="featuredimage">
          <?php 
			$video_url = get_post_meta(get_the_ID(), 'ag_video_url', true);	
		    $popup = get_option('of_slideshow_popup');

			if ($video_url != '') { 

			$vendor = parse_url($video_url); ?>
        
				<div class="videocontainer">	
					<?php if ($vendor['host'] == 'www.youtube.com' || $vendor['host'] == 'youtu.be' || $vendor['host'] == 'www.youtu.be' || $vendor['host'] == 'youtube.com'){ ?>
		
						<?php if ($vendor['host'] == 'www.youtube.com') { parse_str( parse_url( $video_url, PHP_URL_QUERY ), $my_array_of_vars ); ?>
                            <iframe width="620" height="350" src="http://www.youtube.com/embed/<?php echo $my_array_of_vars['v']; ?>?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;" frameborder="0" allowfullscreen></iframe>
                        <?php } else { ?>
                            <iframe width="620" height="350" src="http://www.youtube.com/embed<?php echo parse_url($video_url, PHP_URL_PATH);?>?modestbranding=1;rel=0;showinfo=0;autoplay=0;autohide=1;yt:stretch=16:9;" frameborder="0" allowfullscreen></iframe>
                        <?php } } ?>

					<?php if ($vendor['host'] == 'vimeo.com'){ ?>
						<iframe src="http://player.vimeo.com/video<?php echo parse_url($video_url, PHP_URL_PATH);?>?title=0&amp;byline=0&amp;portrait=0" width="400" height="225" frameborder="0"></iframe>
					<?php } ?>
				</div>

			<?php } else { 
  
				$crop = get_option('of_slide_crop');
				if ( $thumbnum = get_option('of_thumbnail_number') ) { $thumbnum = ($thumbnum + 1); } else { $thumbnum = 7;}
				get_portfolio_info ('portfoliolarge', $post->ID, $crop, $thumbnum);
				
				?>
		
			<div class="wmuSlider <?php if( MultiPostThumbnails::get_the_post_thumbnail('portfolio', 'second-slide', NULL,  'portfoliolarge') != '' ) { echo 'projectslideshow'; }?>">
							<div class="wmuSliderWrapper">
				 
								<span><?php if ($popup == 'On') { ?><a href="<?php echo $full[0]; ?>" rel="prettyPhoto[pp_gal]" title="<?php if ($alt) { echo str_replace('"', "", $alt);  } else { echo the_title(); } ?>"><?php }?><img src="<?php  echo $thumb[0]; ?>" alt="<?php if ($alt) { echo str_replace('"', "", $alt); } else { echo the_title(); } ?>" title="<?php if ($alt) { echo str_replace('"', "", $alt); } else { echo the_title(); } ?>" class="scale-with-grid"/><?php if ($popup == 'On') { ?></a><?php }?></span>
								
								<?php $counter = 2;
								
								while ($counter < ($thumbnum)) :
								
									if ( ${'thumb' . $counter}) : ?>
										<span><?php if ($popup == 'On') { ?><a href="<?php echo ${'full' . $counter}[0]; ?>" rel="prettyPhoto[pp_gal]" title="<?php if (${'alt' . $counter}) { echo str_replace('"', "", ${'alt' . $counter}); } else { echo the_title(); } ?>"><?php }?><img src="<?php  echo ${'thumb' . $counter}[0]; ?>" alt="<?php if (${'alt' . $counter}) { echo str_replace('"', "", ${'alt' . $counter}); } else { echo the_title(); } ?>" title="<?php if (${'alt' . $counter}) { echo str_replace('"', "", ${'alt' . $counter}); } else { echo the_title(); } ?>" class="scale-with-grid"/><?php if ($popup == 'On') { ?></a><?php }?></span>
									<?php endif; $counter++;
									
								endwhile; ?>
		  
							</div>
			</div>
			
		<?php } ?>
        
           </div>
           <div class="clear"></div>
             <div class="one_fifth fulldetails"> 
                <?php echo get_the_term_list( $post->ID, 'sort', '<div class="darkbubble"> <p class="smalldetails">', '<br />', ' </p></div>' ); ?>
                <p class="smalldetails">
                
                <?php if ( comments_open() ) : ?>  
                <a href=" <?php comments_link(); ?> "><?php comments_number( __('No Comments', 'framework'), __('One Comment', 'framework'), __('% Comments', 'framework') ); ?></a> 
                <br />
				<?php endif; ?> 
                    <?php _e('By', 'framework'); ?>
                    <?php the_author_link(); ?>
                </p>
            </div>
            <div class="four_fifth column-last">
            <div class="mobiledetails">
                     <p>
					 <?php _e('On ', 'framework'); the_time('d'); ?>, <?php the_time('M'); ?>  <?php the_time('Y'); ?><?php if ( comments_open() ) : ?> | <a href=" <?php comments_link(); ?> ">
                   	 <?php comments_number( __('No Comments', 'framework'), __('One Comment', 'framework'), __('% Comments', 'framework') ); ?>
                     </a><?php endif; ?> |  <?php _e('In ', 'framework'); echo get_the_term_list( $post->ID, 'sort', '', ' ', '' ); ?> | <?php _e('By ', 'framework'); the_author_link(); ?>
                     </p> 
             </div>
            <h2><a href="<?php the_permalink(); ?>" title="<?php get_the_title(); ?>"><?php the_title();?></a></h2>
            	<?php global $more; $more = 0; ?>
                <?php the_content(__('Read more...', 'framework')); ?>
                <?php edit_post_link( __('Edit Post', 'framework'), '<div class="edit-post"><p>[', ']</p></div>' ); ?>
                <div class="clear"></div>
            </div>   
            <div class="clear"></div> 
        </div>
        <div class="clear"></div>
       
	    <?php endwhile; ?>

        <!--BEGIN .navigation .page-navigation -->
        <?php if ( function_exists('pp_has_pagination') ) : ?>
        <div class="pagination_container">
        <ul id="pagination">
            <!-- the previous page -->
            <?php pp_the_pagination(); if (pp_has_previous_page()) : ?>
            <li class="previous"> <a href="<?php pp_the_previous_page_permalink(); ?>" class="prev">&laquo;
                <?php _e('Previous', 'framework'); ?>
                </a></li>
            <?php else : ?>
            <li class="previous-off">&laquo;
                <?php _e('Previous', 'framework'); ?>
            </li>
            <?php endif; pp_rewind_pagination(); ?>
            <!-- the page links -->
            <?php while(pp_has_pagination()) : pp_the_pagination(); ?>
            <?php if (pp_is_current_page()) : ?>
            <li class="active">
                <?php pp_the_page_num(); ?>
            </li>
            <?php else : ?>
            <li><a href="<?php pp_the_page_permalink(); ?>">
                <?php pp_the_page_num(); ?>
                </a></li>
            <?php endif; ?>
            <?php endwhile; pp_rewind_pagination(); ?>
            <!-- the next page -->
            <?php pp_the_pagination(); if (pp_has_next_page()) : ?>
            <li class="next"> <a href="<?php pp_the_next_page_permalink(); ?>">
                <?php _e('Next', 'framework'); ?>
                &raquo;</a></li>
            <?php else : ?>
            <li class="next-off">
                <?php _e('Next', 'framework'); ?>
                &raquo;</span>
                <?php endif; pp_rewind_pagination(); ?>
        </ul>
        </div>
        <?php  else:  ?>
        
            <!-- Pagination
            ================================================== -->        
            <div class="pagination">
                <?php
                    global $wp_query;

                    $big = 999999999; // need an unlikely integer

                    echo paginate_links( array(
                        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format' => '?paged=%#%',
                        'current' => max( 1, get_query_var('paged') ),
                        'total' => $wp_query->max_num_pages
                    ) );
                ?>   
                <div class="clear"></div>
            </div> <!-- End pagination --> 

		<?php endif; ?>
    </div>
    
    <div class="four columns sidebar offset-by-one content">
        <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Portfolio Sidebar') ) ?>
    </div>
    <div class="clear"></div>
    
</div>
<?php get_footer(); ?>
