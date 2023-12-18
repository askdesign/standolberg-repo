<?php header("Content-type: text/css"); ?>
@charset "utf-8";
/* CSS Document */
/***************Top Margin *******************/
.nav { <?php 
// Get padding
if ( $contentpadding = get_option('of_content_padding') ) { echo 'padding-top:'.$contentpadding.'px;'; } else { echo 'padding-top:50px;';} 
?>	
}

.logo h1,
.logo h2 { <?php 
// Get padding
if ( $logopadding = get_option('of_logo_padding') ) { echo 'padding-top:'.$logopadding.'px;'; } else { echo 'padding-top:55px;';} 
?>	
}

.sf-menu a {
 <?php 
// Get padding
if ( $navpadding = get_option('of_navbottom_padding') ) { echo 'padding-bottom:'.$navpadding.'px;'; } else { echo 'padding-bottom:32px;';} 
?>	
}

/*******************BG Image*******************/ 
.sitecontainer { 
<?php if ( $backgroundimage = get_option('of_background_image') ) {  
echo 'background-image:url('.$backgroundimage.');';  
} else { 
if ($backgroundtexture = get_option('of_texture_bg') ) { 
if($backgroundtexture != 'none') { 
echo 'background-image:url('.$backgroundtexture.');'; 
} 
} } ?> 
    background-repeat:repeat; 
    background-position:center top; 
    } 

<?php if ($crop = get_option('of_slide_crop')) {
		if ($crop == 'Crop') {?>
	.wmuSlider {
    height:350px !important;
    }
    
    /* Tablet Portrait size to standard 960 (devices and browsers) */
@media only screen and (min-width: 768px) and (max-width: 959px) {

    .wmuSlider {
    height:277px !important;
    }
    
    }
    
    /* Mobile Landscape Size to Tablet Portrait (devices and browsers) */
@media only screen and (min-width: 480px) and (max-width: 767px) {

    .wmuSlider {
    height:229px !important;
    }
    
}

/* Mobile Portrait Size to Mobile Landscape Size (devices and browsers) */
@media only screen and (max-width: 479px) {

    .wmuSlider {
    height:164px !important;
    }
    
}
<?php } else { ?>

	.wmuSlider {
    min-height:350px !important;
    }
    
    /* Tablet Portrait size to standard 960 (devices and browsers) */
@media only screen and (min-width: 768px) and (max-width: 959px) {

    .wmuSlider {
    min-height:277px !important;
    }
    
    }
    
    /* Mobile Landscape Size to Tablet Portrait (devices and browsers) */
@media only screen and (min-width: 480px) and (max-width: 767px) {

    .wmuSlider {
    min-height:229px !important;
    }
    
}

/* Mobile Portrait Size to Mobile Landscape Size (devices and browsers) */
@media only screen and (max-width: 479px) {

    .wmuSlider {
    min-height:164px !important;
    }
    
}

<?php }} ?>


/****************Button Colors***********************/

.button:hover, a.button:hover, a.more-link:hover, #footer .button:hover, #footer a.button:hover, #footer a.more-link:hover, .cancel-reply p a:hover {
		   
<?php 
// Get Button Color
if ( $buttonhover = get_option('of_button_hover_color') ) { echo 'background:'.$buttonhover.'!important;'; }
?>	
color:#fff;
}

.button, a.button, a.more-link, #footer .button, #footer a.button, #footer a.more-link, .cancel-reply p a {
		   
<?php 
// Get Button Color
if ( $buttoncolor = get_option('of_button_color') ) { echo 'background:'.$buttoncolor.';'; }
?>	
color:#fff;
}

/****************Link Colors***********************/
p a, a {
<?php 
// Get Link Color
if ( $linkcolor = get_option('of_link_color') ) { echo 'color:'.$linkcolor.';'; } 
?>	
}

h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, p a:hover, 
#footer h1 a:hover, #footer h2 a:hover, #footer h3 a:hover, #footer h3 a:hover, #footer h4 a:hover, #footer h5 a:hover, a:hover, #footer a:hover, .blogpost h2 a:hover, .blogpost .smalldetails a:hover {
<?php 
// Get Link Hover Color
if ( $linkhover = get_option('of_link_hover_color') ) { echo 'color:'.$linkhover.';'; } 
?>	
}

/****************Selection Colors***********************/
::-moz-selection {
<?php 
// Get heading font choices
if ( $linkhover = get_option('of_link_hover_color') ) { echo 'background:'.$linkhover.'; color:#fff;'; } 
?>	
}

::selection {
<?php 
// Get heading font choices
if ( $linkhover = get_option('of_link_hover_color') ) { echo 'background:'.$linkhover.'; color:#fff;'; } 
?>	
}

::selection {
<?php 
// Get heading font choices
if ( $linkhover = get_option('of_link_hover_color') ) { echo 'background:'.$linkhover.'; color:#fff;'; } 
?>	
}

.recent-project:hover {
<?php 
// Get heading font choices
if ( $linkhover = get_option('of_link_hover_color') ) { echo 'border-color:'.$linkhover.' !important;'; } 
?>	
}
/***************Typographic User Values *********************************/

h1, h2, h1 a, h2 a, .blogpost h2 a, h3, .ag_projects_widget h3, h3 a, .aj_projects_widget h3 a {
<?php 
// Get heading font choices
if ( $headingfont = get_option('of_heading_font') ) { echo 'font-family:"'.$headingfont.'", arial, sans-serif;'; } 
?>
}

h5, h5 a, .widget h3, .widget h2, .widget h4  {
<?php 

// Get tiny font option
if ( $tinyfont = get_option('of_tiny_font') ) { echo 'font-family:"'.$tinyfont.'", arial, sans-serif;;'; } ?>
}

h4, h4 a, .footer .note h4, .footer h4.subheadline, .newspost h4  {
<?php 

// Get subfont option
if ($secondaryfont = get_option('of_secondary_font') ) { echo 'font-family:"'.$secondaryfont.'", arial, sans-serif;;'; } ?>
}

body, input, p, ul, ol, .button, .ui-tabs-vertical .ui-tabs-nav li a span.text,
.footer p, .footer ul, .footer ol, .footer.button, .credits p,
.credits ul, .credits ol, .credits.button, .footer textarea, .footer input, .testimonial p, 
.contactsubmit label, .contactsubmit input[type=text], .contactsubmit textarea {
<?php 

// Get paragraph option
if ($pfont = get_option('of_p_font')) { echo 'font-family:"'.$pfont.'", arial, sans-serif;'; } ?>
}

<?php if ($thumbhover = get_option('of_thumb_hover')) { 
	if($thumbhover == 'Title') { ?>
    
.portfolioitem.darkbg {
	background:#000 url('<?php echo get_template_directory_uri(); ?>/images/zoom.png') 95% 95% no-repeat;
}

<?php }} ?>

<?php if ($padding = get_option('of_thumb_padding')) { 
	if($padding == 'On') { ?>

.container .three.columns.nopadding {
width: 188px;
padding: 0;
margin: 2px;
}

@media only screen and (min-width: 768px) and (max-width: 959px) {
.container .three.columns.nopadding { 
width: 148px;  margin:2px; 
}
}


 @media only screen and (max-width: 767px) {
.container .three.columns.nopadding { 
width: 146px; 
margin:2px;
}
}

@media only screen and (min-width: 480px) and (max-width: 767px) {
.container .three.columns.nopadding {
width: 204px; 
margin:2px;
margin-bottom: 6px; 
}
.slideshowcontainer {
    margin-left:8px;
}
.slideshowcontainer .container {
    width:428px;
}
}
/* Mobile Portrait Size to Mobile Landscape Size (devices and browsers) */
@media only screen and (max-width: 479px) {
ul.filter li {
width: 137px;
}

}
<?php } else { ?>
@media only screen and (max-width: 959px) and (min-width: 768px) {
    .container.slideshow {
        width:760px;
    }
}
@media only screen and (max-width: 767px) and (min-width: 480px) {

}
    
<?php } } ?>