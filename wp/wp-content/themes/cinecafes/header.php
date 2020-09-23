<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="https://gmpg.org/xfn/11">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic,300italic,300" rel="stylesheet" type="text/css">

<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">


<!-- Bootstrap core CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/stellarnav.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/theme.css">
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/responsive.css">

<!-- for Gallery-->
<link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/simplelightbox.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/demo.css" rel="stylesheet" type="text/css">



<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="assets/js/ie-emulation-modes-warning.js"></script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header>
	<div class="header_top c">
		<div class="container">
			<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 header_left">
				<div class="row">
					<div class="top_contact">
					<ul class="con_list">
						<li><a href="tel:9181000 01001 "><i class="fa fa-phone"></i> Call +91 81000 01001 </a></li>
						<!--<li><a href=""><i class="fa fa-map-marker"></i> 118 Main abcd Road</a></li>-->
					</ul>
				</div>
				</div>
			</div> 
			<div class="col-lg-6 col-md-6 col-sm-6 header_right">
				<div class="row">
									
				<div class="social_area">
            <ul class="social-network social-circle">
              <li><a href="https://www.facebook.com/CineCafes/" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a></li>
              <li><a href="https://twitter.com/CafesCine" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a></li>
              
              <li><a href="https://www.instagram.com/cinecafes/" class="instagram" title="instagram"><i class="fa fa-instagram"></i></a></li>
            </ul>
          </div>

				</div>
			</div>

		
			</div>
		</div>
	</div>
	<div class="header_dwn">
		<div class="container">
			<div class="col-sm-12">
				<a href="index.php" class="logo_area"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.png" alt="" class="logo" id="logo"></a>
			</div>
			<div class="col-sm-12">
				<div class="row">
					<div id="main-nav" class="stellarnav">
		<ul>
			
		    <li class="active"><a href="index.php">Home</a></li>
		    <li><a href="#about">About Us</a></li>
		    <li><a href="#gallery">Gallery</a></li>
		    <li class="drop-left"><a href="" type="button" data-toggle="modal" data-target="#ContactModal">Contact Us</a></li>
		</ul>
	</div>
				</div>
			</div>
		</div>
	</div>
</header>


<!--Header Top End-->
<section id="banner_area">
	<div id="banner-carousel" class="owl-carousel">
                    <div class="item">
                    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/banner.jpg" width="100%" alt=""/>
                    	<div class="overlay">
                    		<h2>The Amalgamation of</h2>
                    		<h4>Hospitality  & Entertainment</h4>
                    	</div>
                    </div>
                    <div class="item">
                    	<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/banner1.jpg" width="100%" alt=""/>
                    	<div class="overlay">
                    		<h2>The Amalgamation of</h2>
                    		<h4>Hospitality  & Entertainment</h4>
                    	</div>
                    </div>
                    
                    
                    
                </div>
</section>
