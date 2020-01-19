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
				<div class="inner-content">
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
          <div class="row contenido-dinamico">
              <div class="col-xs-12 col-md-6">
                <?php
                  $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                  $imagenSmall = crop_image($image[0], $image[1]*0.02,$image[2]*0.02, true);
                ?>
                <div class="eventos__image">
                  <img src="<?php echo $imagenSmall; ?>" data-src="<?php echo $image[0] ?>" alt="" class="lozad">
                </div>

              </div>
              <div class="col-xs-12 col-md-6">
                <?php
                  if (get_field('eventos_descripcion')) echo '<p>'.get_field('eventos_descripcion').'</p>';
                  if (get_field('eventos_fecha_desde') && !get_field('eventos_fecha_hasta')) echo '<p><strong>Fecha</strong>: '.get_field('eventos_fecha_desde').'</p>';
                  if (get_field('eventos_fecha_desde') && get_field('eventos_fecha_hasta')) echo '<p><strong>Fecha inicio</strong>: '.get_field('eventos_fecha_desde').'</p>';
                  if (get_field('eventos_fecha_hasta')) echo '<p><strong>Fecha termino</strong>: '.get_field('eventos_fecha_hasta').'</p>';
                  if (get_field('eventos_hora')) echo '<p><strong>Hora</strong>: '.get_field('eventos_hora').'</p>';
                  if (get_field('eventos_lugar')) echo '<p><strong>Lugar</strong>: '.get_field('eventos_lugar').'</p>';
                  if (get_field('eventos_informacion')) echo get_field('eventos_informacion');
                  // if (get_field('eventos_telefono')) echo '<p><strong>Teléfono</strong>: '.get_field('eventos_telefono').'</p>';
                ?>
              </div>
          </div>
				</div>
			</div>
		</div>
		<div class="separador--big"></div>
	</section>

<?php get_footer(); ?>
