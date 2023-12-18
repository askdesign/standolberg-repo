<?php get_header(); ?>
<!--Start Top Section -->

<!-- Page Title
  ================================================== -->
<div class="container clearfix">
    <div class="pagename sixteen columns fadeInUp animated">
        <h3><?php if ($projecttitle = get_option('of_portfolio_title')) { echo $projecttitle; } else { echo 'Projects';} ?>
        </h3>
    </div>
</div>

<!-- Page Content
  ================================================== -->
<div class="container clearfix fadeInUp animated">
    <div class="eleven columns blogwrap">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
           				 <iframe width="620" height="350" src="http://www.youtube.com/embed/<?php echo $my_array_of_vars['v']; ?>" frameborder="0" allowfullscreen></iframe>
       				    <?php } else { ?>
          				  <iframe width="620" height="350" src="http://www.youtube.com/embed<?php echo parse_url($video_url, PHP_URL_PATH);?>" frameborder="0" allowfullscreen></iframe>
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
            <h1><?php the_title();?></h1>
                <?php the_content(__('Read more...', 'framework')); ?>
                <?php edit_post_link( __('Edit Post', 'framework'), '<div class="edit-post"><p>[', ']</p></div>' ); ?>
                <div class="clear"></div>
            </div>    
        </div>
        <div class="clear"></div>
        <?php endwhile; ?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php comments_template('', true);?>
        <?php endwhile; else :?>
        <!-- Else nothing found -->
        <h2>
            <?php _e('Error 404 - Not found.', 'framework'); ?>
        </h2>
        <p>
            <?php _e("Sorry, but you are looking for something that isn't here.", 'framework'); ?>
        </p>
        <!--BEGIN .navigation .page-navigation -->
        <?php endif; endif; ?>
        <?php if ( function_exists('pp_has_pagination') ) : ?>
        <?php if (pp_has_pagination()) : ?>
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
        <?php endif; else: paginate_links(); wp_link_pages('before=<p>&after=</p>&next_or_number=number&pagelink=page %');  endif;?>
    </div>
    <div class="four columns sidebar offset-by-one content">
        <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Portfolio Sidebar') ) ?>
    </div>
    <div class="clear"></div>
</div>
<?php get_footer(); ?>
