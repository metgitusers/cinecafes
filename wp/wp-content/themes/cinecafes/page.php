<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since Twenty Seventeen 1.0
 * @version 1.0
 */

get_header(); ?>
<section class="welcome_area" id="about">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 headline">
			<a href="#gallery" class="arrow_dwn"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/arrow_dwn.jpg" alt=""></a>
			<h4>Welcome To</h4>
			<h2>Cine Cafes</h2>
		</div>
		<div class="col-sm-10 col-sm-offset-1 wel_com_txt">
<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End the loop.
			?>
</div>
		</div>
		
	</div>
</section>
<?php
get_footer();
