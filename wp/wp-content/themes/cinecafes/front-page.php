<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

get_header();
$url ="https://cinecafes.com/";
wp_redirect( $url );
exit;
?>

<section class="welcome_area" id="about">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 headline">
			<a href="#gallery" class="arrow_dwn"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow_dwn.jpg" alt=""></a>
			<h4>Welcome To</h4>
			<h2>Cine Cafes</h2>
		</div>
		<div class="col-sm-10 col-sm-offset-1 wel_com_txt">
			<div class="row">
							<div class="col-sm-7">
				<p class="mrg80T">Caféplex Entertainment Pvt. Ltd. brings one of a kind facility Cine Cafes, where you can enjoy your favorite Movie or TV show with your favorite food in a luxury sitting. This eclectic and innovative blend has been designed to appease the current consumer trend, which is bringing dining and movie viewing experiences together. Starting soon, the café will be your perfect opportunity for relaxing with family or friends or someone special.</p>
				
				<p>Movies have always held a special place of interest for the mass. In the last couple of year, TV shows have gradually started to take space on the same preference platform. Cine Cafés brings you the choice and chance of uninterrupted movie viewing or TV show binging while enjoying delicious food.
</p>
				<!--<a href="" class="btn btn-view">View More</a>-->
			</div>
			<div class="col-sm-5">
				<div class="wel_com_img">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/welcome_img.jpg" alt="">
				</div>
			</div>

			</div>
		</div>
		</div>
		
	</div>
</section>



<section id="gallery">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 headline">
			<a href="#visiters_area" class="arrow_dwn"><img src="assets/img/arrow_dwn.jpg" alt=""></a>
			<h4>View Our</h4>
			<h2>Gallery</h2>
			</div>
			
			
		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="gallery">
				
					<div class="col-sm-6">
						<div class="row">
							<div class="gallery_img"> <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/gallery.jpg" class="big"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/gallery.jpg" alt="" title="gallery"></a>
                            <div class="gallery_txt">
                                
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/search.png" alt=""> </div>
                          </div>
						</div>
					</div>
					
					
					
					<div class="col-sm-6">
						<div class="row">
							<div class="gallery_img"> <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/gallery8.jpg" class="big"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/gallery8.jpg" alt="" title="gallery"></a>
                            <div class="gallery_txt">
                                
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/search.png" alt=""> </div>
                          </div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="gallery_img"> <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/gallery1.jpg" class="big"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/gallery1.jpg" alt="" title="gallery"></a>
                            <div class="gallery_txt">
                                
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/search.png" alt=""> </div>
                          </div>
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="row">
							<div class="gallery_img"> <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/gallery2.jpg" class="big"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/gallery2.jpg" alt="" title="gallery"></a>
                            <div class="gallery_txt">
                                <!--<h4>special offer</h4>-->
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/search.png" alt=""> </div>
                          </div>
						</div>
					</div>
						<div class="col-sm-6">
						<div class="row">
							<div class="gallery_img"> <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/gallery33.jpg" class="big"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/gallery33.jpg" alt="" title="gallery"></a>
                            <div class="gallery_txt">
                                <!--<h4>special offer</h4>-->
                                <img src="assets/img/search.png" alt=""> </div>
                          </div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="gallery_img"> <a href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/gallery44.jpg" class="big"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/gallery44.jpg" alt="" title="gallery"></a>
                            <div class="gallery_txt">
                                <!--<h4>special offer</h4>-->
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/search.png" alt=""> </div>
                          </div>
						</div>
					</div>
					
			</div>
		</div>
	</div>
</section>		

<section id="visiters_area">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 headline">
			<a href="#big_footer" class="arrow_dwn"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow_dwn.jpg" alt=""></a>
			<h4>Our Happy</h4>
			<h2>Visitors</h2>
			</div>
			
			<div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12">
				
				<div id="visiters-carousel" class="owl-carousel">
                    <div class="item">
                    	<div class="visiter_img"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/no-image.png" alt=""></div>
                    	<p>Great place and with the bar as well, many options for what ever time of sag you want to come... toasties were nice and staff friendly.. worth a visit...</p>
                    	<h4>Rahul Sarkar</h4>
                    </div>
                    <div class="item">
                    	<div class="visiter_img"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/user.jpg" alt=""></div>
                    	<p>Great place and with the bar as well, many options for what ever time of sag you want to come... toasties were nice and staff friendly.. worth a visit...</p>
                    	<h4>Rahul Sarkar</h4>
                    </div>
                    
                    
                    
                </div>
			</div>
			
		</div>
	</div>
</section>
<?php
get_footer();
