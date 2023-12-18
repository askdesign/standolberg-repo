<?php

	if(!function_exists('wp_head')) {
		
		if(file_exists('../../../../wp-load.php')) {
			include '../../../../wp-load.php';
		} else {
			include '../../../../../wp-load.php';
		}

		$postId = $_POST['id'];

		
		//Query the database
		query_posts( array (
			'post_type' => 'portfolio',
			'p' => $postId,
			)
		);
	
	}


    if (have_posts()) : while (have_posts()) : the_post(); 

    ?>
<script type="text/javascript">
/*-----------------------------------------------------------------------------------*/
/* WMU Slider Initialization
/*-----------------------------------------------------------------------------------*/   

jQuery('.projectslideshow').wmuSlider({
    animation: 'fade',
	animationDuration: 600,
	slideshow: <?php if ($portautoplay = get_option('of_portfolio_autoplay')) { echo $portautoplay; } else { echo 'true'; } ?>,
	slideshowSpeed: <?php if ($portautoplaydelay = get_option('of_project_autoplay_delay')) { echo $portautoplaydelay.'000'; } else { echo '7000'; } ?>,
	slideToStart: 0,
	navigationControl: true,
	paginationControl: true,
	previousText: 'Previous',
	nextText: 'Next',
	touch: false,
	slide: 'span'
}); 



/*-----------------------------------------------------------------------------------*/
/* FitVid Fluid Video
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function(){
    jQuery(".videocontainer").fitVids();
});

/*-----------------------------------------------------------------------------------*/
/* Pretty Photo
/*-----------------------------------------------------------------------------------*/
	
	jQuery(function(){
	   jQuery("a[rel^='prettyPhoto']").prettyPhoto({
			animation_speed: 'fast', /* fast/slow/normal */
			slideshow: 5000, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: false, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			default_width: 500,
			default_height: 344,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: '<?php  if ($ppskin = get_option('of_prettyphoto_skin')) { echo $ppskin; } else { echo 'light_square'; } ?>', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			horizontal_padding: 20, /* The padding on each side of the picture */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			deeplinking: true, /* Allow prettyPhoto to update the url to enable deeplinking. */
			overlay_gallery: true, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			changepicturecallback: function(){}, /* Called everytime an item is shown/changed */
			callback: function(){}, /* Called when prettyPhoto is closed */
			ie6_fallback: true
			});
	});

</script>

<div class="ajaxinner">
 <a href="#" class="portfolio-close">Close</a> 
 <a id="next-port" href="#">Next</a> 
 <a id="prev-port" href="#">Previous</a> 

<div class="clear"></div>
<div class="eleven columns ajaxslider alpha">

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
<div class="five columns ajaxcontent">
    <div <?php post_class() ?> id="door-<?php the_ID(); ?>">
          <span class="darkbubble left">
        <h3 class="entry-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
                   </span>
       
        <?php echo get_the_term_list( $post->ID, 'sort', '<p class="entry-details"><strong>' . __('In ', 'framework'), ', ', '</strong></p>' ); ?>
        <!--BEGIN .entry-content -->
        <div class="entry-content">
            <?php global $more; $more = 0; ?>
            <?php the_content(__('Read more...', 'framework')); ?>
            <!--END .entry-content -->
        </div>
        <!--END .hentry-->
    </div>
</div>
</div>
<div class="clear"></div>
<?php endwhile; endif; ?>