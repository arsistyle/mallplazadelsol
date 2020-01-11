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

<?php
    $loop = array(
        'post_type' => 'galerias',
        'orderby'			=> 'eventos_fecha_desde',
        'order'				=> 'ASC',
        'posts_per_page'=>-1,
        'meta_query'     => array(
          array(
            'key'     => 'eventos_galeria',
            'value'   => 1,
            'compare' => 'LIKE'
          ),
        )
    );
    $query = new WP_Query( $loop );
?>

	<section class="section section--interior">
		<div class="container-fluid">
			<div class="frame">
				<div class="eventos inner-content">
					<div class="row">
						<div class="col-xs-12">
              <div class="separador"></div>
							<?php
								if ( function_exists('yoast_breadcrumb') ) {
									yoast_breadcrumb( '<p id="breadcrumbs" class="breadcrumbs">','</p>' );
								}
							?>
						</div>
						<div class="col-xs-12 contenido-dinamico">
							<h1><?php echo get_the_archive_title(); ?></h1>
						</div>
            <div class="col-xs-12">
              <div class="row">
                <?php if ($query->have_posts()) {?>
                  <?php while ( $query->have_posts() ) : $query->the_post();

                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                    $imageFull = crop_image($image[0], 665,400, true);
                    $imageSmall = crop_image($image[0], 665*0.02,400*0.02, true);

                  ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                      <a href="<?php echo the_permalink(); ?>" class="eventos__item sombras">
                        <div class="eventos__image sombras__image">
                          <img class="sombras__img lozad" src="<?php echo $imageSmall; ?>" data-src="<?php echo $imageFull; ?>" alt="<?php the_title(); ?>">
                          <img class="sombras__sombra lozad" src="<?php echo $imageSmall; ?>" data-src="<?php echo $imageFull; ?>" alt="<?php the_title(); ?>">
                        </div>
                        <div class="eventos__content contenido-dinamico">
                          <h3 class="eventos__title"><?php the_title(); ?></h3>
                          <?php
                            if (get_field('eventos_fecha_desde') && get_field('eventos_fecha_hasta')) {
                              echo '<p><strong>Fecha desde</strong>: '.get_field('eventos_fecha_desde').'</p>';
                              echo '<p><strong>Fecha hasta</strong>: '.get_field('eventos_fecha_hasta').'</p>';
                            }
                            else if (get_field('eventos_fecha_desde')) echo '<p><strong>Fecha</strong>: '.get_field('eventos_fecha_desde').'</p>';
                            if (get_field('eventos_hora')) echo '<p><strong>Hora</strong>: '.get_field('eventos_hora').'</p>';
                            if (get_field('eventos_lugar')) echo '<p><strong>Lugar</strong>: '.get_field('eventos_lugar').'</p>';
                          ?>
                        </div>
                      </a>
                    </div>
                <?php endwhile; wp_reset_query(); ?>
                <?php } else { ?>
                  <div class="col-xs-12">
                    <div class="alerta alerta--aviso">
                      Por el momento no tenemos galerías.
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
					</div>
				</div>
			</div>
		</div>
		<div class="separador--ultra"></div>
	</section>

<?php get_footer(); ?>