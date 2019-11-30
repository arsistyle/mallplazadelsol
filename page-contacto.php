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
 * @package mallplazadelsol
 */

get_header();
?>

	<section class="section section--interior">
		<!-- <?php //get_template_part( 'template-parts/pages', 'banner' ); ?> -->
		<div class="container-fluid">
			<div class="frame">
				<div class="contenido-interior">
					<div class="row">
						<div class="col-xs-12">
							<div class="separador"></div>
							<?php
								if ( function_exists('yoast_breadcrumb') ) {
									yoast_breadcrumb( '<p id="breadcrumbs" class="breadcrumbs">','</p>' );
								}
							?>
						</div>
						<div class="col-xs-12">
							<h1><?php the_title(); ?></h1>
						</div>
          </div>
          <div class="row direction-row-reverse-xs contenido-dinamico">
              <div class="col-xs-12 col-md-6">
                <?php the_content(); ?>
              </div>
              <div class="col-xs-12 col-md-6">
                <a href="<?php echo the_field('mapa_url') ?>" class="mapa">
                  <img src="<?php echo the_field('mapa_imagen') ?>" alt="Ubicación Mall Plaza del Sol">
                </a>
              </div>
          </div>
				</div>
			</div>
		</div>
		<div class="separador--big"></div>
	</section>

<?php
get_footer();
