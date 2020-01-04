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
    $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : null;
    $loop = array(
        'post_type' => 'tiendas',
        'orderby'			=> 'title',
        'order'				=> 'ASC',
        'posts_per_page'=>-1
    );
    if ($categoria) {
      $loop['tax_query'] =  array(
          array(
              'taxonomy' => 'categoria_tienda',
              'field' => 'slug',
              'terms' => $categoria
          )
      );
    }
    $query = new WP_Query( $loop );
?>

	<section class="section section--interior">
		<div class="container-fluid">
			<div class="frame">
				<div class="tiendas inner-content">
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
							<h1>Tiendas</h1>
						</div>
            <div class="col-xs-12 col-md-3">
                <aside class="sidenav">
                  <div class="tiendas__categorias">
                    <?php
                      $taxonomy = 'categoria_tienda';
                      $terms = get_terms($taxonomy);
                      $activoTodas = !$categoria ? 'activo' : ''; 
                      if ( $terms && !is_wp_error( $terms ) ) :
                      ?>
                          <ul class="tiendas__categorias__lista">
                            <li class="tiendas__categorias__item"><a href="/tiendas" class="tiendas__categorias__link <?php echo $activoTodas; ?>">Todas las tiendas</a></li>
                              <?php foreach ( $terms as $term ) {
                                $activo = $categoria == $term->slug ? 'activo' : '';
                              ?>
                                  <li class="tiendas__categorias__item"><a href="/tiendas?categoria=<?php echo $term->slug; ?>" class="tiendas__categorias__link <?php echo $activo; ?>"><?php echo $term->name; ?></a></li>
                              <?php } ?>
                          </ul>
                    <?php endif;?>
                  </div>
                </aside>
            </div>
            <div class="col-xs-12 col-md-9">
              <div class="row">
                <?php while ( $query->have_posts() ) : $query->the_post();
                  $imagenSmall = crop_image(get_field('tienda_logo'), 612*0.02,612*0.02, true);
                  $imagen = get_field('tienda_logo');
                  $fondoLogo = get_field('tienda_fondo_logo') === 'light' ? 'light' : 'dark';
                ?>
                  <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="<?php echo the_permalink(); ?>" class="tiendas__item">
                      <div class="tiendas__image">
                        <?php if ($imagen) {?>
                          <img class="lozad" src="<?php echo $imagenSmall; ?>" data-src="<?php echo $imagen; ?>" alt="<?php the_title(); ?>">
                        <?php } else { ?>
                          <img class="lozad" src="<?php bloginfo('template_directory'); ?>/img/sin-imagen--small.jpg" data-src="<?php bloginfo('template_directory'); ?>/img/sin-imagen.jpg" alt="<?php the_title(); ?>">
                        <?php } ?> 
                      </div>
                      <div class="tiendas__content">
                        <h3 class="tiendas__title"><?php the_title(); ?></h3>
                      </div>
                      <span class="tiendas__meta tiendas__meta--<?php echo $fondoLogo; ?>">N° <?php echo get_field('tienda_numero_local'); ?> | Nivel <?php echo get_field('tienda_piso'); ?></span>
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