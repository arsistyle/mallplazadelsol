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
    // Filtro por categoría
    // $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : null;
    $loop = array(
        'post_type' => 'eventos',
        'orderby'			=> 'eventos_fecha_desde',
	      'order'				=> 'ASC'
    );
    // if ($categoria) {
    //   $loop['tax_query'] =  array(
    //       array(
    //           'taxonomy' => 'categoria_tienda',
    //           'field' => 'slug',
    //           'terms' => $categoria
    //       )
    //   );
    // }
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
							<h1>Eventos</h1>
						</div>
            <div class="col-xs-12">
              <div class="row">
                <?php while ( $query->have_posts() ) : $query->the_post();
                  $imagenSmall = crop_image(get_field('eventos_imagen'), 612*0.02,612*0.02, true);
                  $imagen = get_field('eventos_imagen');
                  // $fondoLogo = get_field('tienda_fondo_logo') === 'light' ? 'light' : 'dark';
                ?>
                  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="<?php echo the_permalink(); ?>" class="tiendas__item">
                      <div class="tiendas__image">
                        <img class="lozad" src="<?php echo $imagenSmall; ?>" data-src="<?php echo $imagen; ?>" alt="<?php the_title(); ?>">
                      </div>
                      <div class="tiendas__content">
                        <h3 class="tiendas__title"><?php the_title(); ?></h3>
                      </div>
                      <!-- <span class="tiendas__meta tiendas__meta--<?php// echo $fondoLogo; ?>">N° <?php// echo get_field('tienda_numero_local'); ?> | Nivel <?php// echo get_field('tienda_piso'); ?></span> -->
                    </a>
                  </div>
                <?php endwhile; wp_reset_query(); ?>
              </div>
            </div>
					</div>
				</div>
			</div>
		</div>
		<div class="separador--ultra"></div>
	</section>

<?php get_footer(); ?>