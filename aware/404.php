<?php get_header(); ?>

<!-- Page Title
  ================================================== -->
<div class="container clearfix">
    <div class="pagename sixteen columns fadeInUp animated">
        <h1>
            <?php _e('Page Not Found', 'framework'); ?>
        </h1>
    </div>
</div>

<!-- Page Content
  ================================================== -->
<div class="container clearfix fadeInUp animated">
<div class="eleven columns content">
<div class="contentwrap">
			 <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
             <?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

            <?php endwhile; else :?>
            <!-- Else nothing found -->
            <h2><?php _e('Error 404 - Not found.', 'framework'); ?></h2>
            <p><?php _e("Sorry, but you are looking for something that isn't here.", 'framework'); ?></p>
           <!--BEGIN .navigation .page-navigation -->
            <?php endif; ?>
            
            <div class="clear"></div>
</div>          
</div>
<div class="four columns sidebar offset-by-one content">
   <?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Page Sidebar') ) ?>
</div>
<div class="clear"></div>
</div>
<?php get_footer(); ?>
