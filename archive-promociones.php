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
        'post_type' => 'promociones',
        'posts_per_page'=> -1,
    );
    $query = new WP_Query( $loop );

?>

	<section class="section section--interior">
		<div class="container-fluid">
			<div class="frame">
				<div class="promociones inner-content">
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
              <div class="ars1-galeria js-galeria row" data-group="promocion">

                <?php if ($query->have_posts()) {?>

                  <?php while ( $query->have_posts() ) : $query->the_post();
                    
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
                    $imageFull = crop_image($image[0], 650,650, true);
                    $imageSmall = crop_image($image[0], 650*0.02,650*0.02, true);

                  ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                      <a href="<?php echo $image[0]; ?>" class="promociones__item ars1-galeria__item">
                        <div class="promociones__image">
                          <img class="sombras__img lozad" src="<?php echo $imageSmall; ?>" data-src="<?php echo $imageFull; ?>" alt="<?php the_title(); ?>">
                        </div>
                      </a>
                    </div>
                  <?php endwhile; wp_reset_query(); ?>
                  <?php } else { ?>
                    <div class="col-xs-12">
                      <div class="alerta alerta--aviso">
                        Por el momento no tenemos promociones.
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