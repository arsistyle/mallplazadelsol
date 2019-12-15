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
                  $imagenSmall = crop_image(get_field('tienda_imagen')['url'], get_field('tienda_imagen')['width']*0.02,get_field('tienda_imagen')['height']*0.02, true);
                ?>
                <div class="tiendas__image">
                  <img src="<?php echo $imagenSmall; ?>" data-src="<?php echo get_field('tienda_imagen')['url'] ?>" alt="" class="lozad">
                </div>

              </div>
              <div class="col-xs-12 col-md-6">
                <?php
                  if (get_field('tienda_promocion')) echo '<p>'.get_field('tienda_promocion').'</p>';
                  if (get_field('tienda_numero_local')) echo '<p><strong>Local</strong>: '.get_field('tienda_numero_local').'</p>';
                  if (get_field('tienda_piso')) echo '<p><strong>Piso</strong>: '.get_field('tienda_piso').'</p>';
                  if (get_field('tienda_sitio_web')) echo '<p><strong>Sitio web</strong>: <a href="'.get_field('tienda_sitio_web').'" class="link-externo">'.get_field('tienda_sitio_web').'</a></p>';
                  if (get_field('tienda_telefono')) echo '<p><strong>Teléfono</strong>: '.get_field('tienda_telefono').'</p>';
                ?>
                
                <?php
                  if( have_rows('tienda_redes_sociales') ) {
                    while ( have_rows('tienda_redes_sociales') ) : the_row();
                      $redes = array();
                      if (get_sub_field('tienda_facebook')) $redes['facebook'] = get_sub_field('tienda_facebook');
                      if (get_sub_field('tienda_instagram')) $redes['instagram'] = get_sub_field('tienda_instagram');
                      if (get_sub_field('tienda_twitter')) $redes['twitter'] = get_sub_field('tienda_twitter');
                      if (get_sub_field('tienda_youtube')) $redes['youtube'] = get_sub_field('tienda_youtube');
                
                      if (count($redes)) {
                ?>
                        <div class="tiendas__redes">
                          <p><strong>Redes sociales:</strong></p>
                          <?php if($redes['facebook']) { ?>
                            <a href="<?php echo $redes['facebook']; ?>" class="tiendas__redes__link">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 384 384" class="svg svg--primario"><rect class="svg--transparente" width="384" height="384"/><path d="M273.4 129.4H218V93.1c0-13.7 9-16.8 15.4-16.8h39.1v-60L218.6 16c-59.8 0-73.4 44.8-73.4 73.4v40h-34.6v61.9h34.6v175.1H218v-175h49.1L273.4 129.4z"/></svg>
                            </a>
                          <?php } ?>
                          <?php if($redes['instagram']) { ?>
                            <a href="<?php echo $redes['instagram']; ?>" class="tiendas__redes__link">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 384 384" class="svg svg--primario"><rect class="svg--transparente" width="384" height="384"/><path d="M366.9 119.4c-0.8-18.8-3.8-31.6-8.2-42.7C349.6 53 331 34.4 307.3 25.2c-11.1-4.4-24.1-7.4-42.7-8.2S239.9 16 192 16s-53.9 0.1-72.6 1.1 -31.6 3.8-42.7 8.2C53 34.4 34.4 53 25.3 76.7c-4.4 11.2-7.4 24.1-8.2 42.7S16 144.1 16 192s0.1 53.9 1.1 72.6 3.8 31.6 8.2 42.7c9.1 23.6 27.8 42.3 51.4 51.4 11.2 4.4 24.1 7.4 42.7 8.2s24.7 1.1 72.6 1.1 53.9-0.1 72.6-1.1 31.6-3.8 42.7-8.2c23.6-9.1 42.3-27.8 51.4-51.4 4.4-11.1 7.4-24.1 8.2-42.7s1.1-24.8 1.1-72.6S367.9 138.1 366.9 119.4zM335.2 263.1c-0.8 17.1-3.7 26.5-6.1 32.6 -2.8 7.6-7.3 14.6-13.2 20.2 -5.7 5.8-12.6 10.4-20.3 13.2 -6.3 2.5-15.5 5.3-32.6 6.1 -18.6 0.8-24.1 1.1-71.1 1.1s-52.6-0.1-71.1-1.1c-17.1-0.8-26.5-3.7-32.6-6.1 -15.4-5.9-27.5-18.1-33.5-33.5 -2.5-6.3-5.3-15.5-6.1-32.6 -0.8-18.6-1.1-24.2-1.1-71.1s0.1-52.6 1.1-71.1c0.8-17.1 3.7-26.5 6.1-32.7C57.5 80.6 62 73.7 67.8 68c5.7-5.8 12.6-10.4 20.3-13.2 6.3-2.5 15.5-5.3 32.6-6.1 18.6-0.8 24.2-1.1 71.1-1.1s52.6 0.1 71.1 1.1c17.1 0.8 26.5 3.7 32.6 6.1 7.7 2.8 14.6 7.3 20.3 13.2 5.8 5.7 10.3 12.6 13.2 20.2 2.5 6.3 5.3 15.5 6.1 32.7 0.8 18.6 1.1 24.2 1.1 71.1S336 244.6 335.2 263.1z"/><path d="M191.9 101.5c-50 0-90.4 40.5-90.4 90.4s40.5 90.5 90.4 90.5 90.4-40.5 90.4-90.5l0 0C282.3 142.1 241.8 101.6 191.9 101.5zM191.9 250.8c-32.5 0-58.8-26.3-58.8-58.8s26.3-58.8 58.8-58.8 58.8 26.3 58.8 58.8C250.6 224.4 224.3 250.8 191.9 250.8L191.9 250.8z"/><circle cx="285.9" cy="98" r="21.1"/></svg>
                            </a>
                          <?php } ?>
                          <?php if($redes['twitter']) { ?>
                            <a href="<?php echo $redes['twitter']; ?>" class="tiendas__redes__link">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 384.1 384" class="svg svg--primario"><rect class="svg--transparente" x="0.1" width="384" height="384"/><path d="M384 74.9c-14.1 6.3-29.3 10.5-45.2 12.4 16.3-9.7 28.8-25.2 34.6-43.6 -15.2 9-32.1 15.6-50 19.1C309 47.5 288.5 38 265.9 38c-43.5 0-78.8 35.3-78.8 78.8 0 6.2 0.7 12.2 2 18 -65.5-3.3-123.5-34.6-162.4-82.3C20 64 16.1 77.5 16.1 92c0 27.3 13.9 51.4 35 65.6 -12.9-0.4-25.1-4-35.7-9.9 0 0.3 0 0.7 0 1 0 38.2 27.2 70 63.2 77.2 -6.6 1.8-13.6 2.8-20.8 2.8 -5.1 0-10-0.5-14.8-1.4 10 31.3 39.1 54.1 73.6 54.7 -27 21.1-60.9 33.7-97.8 33.7 -6.4 0-12.6-0.4-18.8-1.1C34.9 337 76.3 350 120.8 350c144.9 0 224.2-120 224.2-224.2 0-3.4-0.1-6.8-0.2-10.2C360.1 104.6 373.4 90.7 384 74.9z"/></svg>
                            </a>
                          <?php } ?>
                          <?php if($redes['youtube']) { ?>
                            <a href="<?php echo $redes['youtube']; ?>" class="tiendas__redes__link">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 384 384" class="svg svg--primario"><rect class="svg--transparente" width="384" height="384"/><path d="M274.3 192c0-5.3-2.1-9.1-6.4-11.6l-109.7-68.6c-4.4-2.9-9.1-3-13.9-0.4 -4.7 2.6-7.1 6.6-7.1 12v137.1c0 5.4 2.4 9.4 7.1 12 2.3 1.1 4.5 1.7 6.6 1.7 2.9 0 5.3-0.7 7.3-2.1l109.7-68.6C272.1 201.1 274.3 197.3 274.3 192zM384 192c0 13.7-0.1 24.4-0.2 32.1 -0.1 7.7-0.8 17.5-1.8 29.3 -1.1 11.8-2.7 22.3-4.8 31.6 -2.3 10.4-7.2 19.2-14.8 26.4 -7.6 7.1-16.4 11.3-26.6 12.4 -31.7 3.6-79.6 5.4-143.8 5.4s-112.1-1.8-143.8-5.4c-10.1-1.1-19-5.3-26.7-12.4 -7.6-7.1-12.6-15.9-14.9-26.4 -2-9.3-3.5-19.8-4.6-31.6s-1.7-21.5-1.8-29.3C0.1 216.4 0 205.7 0 192s0.1-24.4 0.2-32.1c0.1-7.7 0.8-17.5 1.8-29.3 1.1-11.8 2.7-22.3 4.8-31.6 2.3-10.4 7.2-19.2 14.8-26.4 7.6-7.1 16.4-11.3 26.6-12.4 31.7-3.6 79.6-5.4 143.8-5.4s112.1 1.8 143.8 5.4c10.1 1.1 19 5.3 26.7 12.4 7.6 7.1 12.6 15.9 14.9 26.4 2 9.3 3.5 19.8 4.6 31.6 1.1 11.8 1.7 21.5 1.8 29.3C383.9 167.6 384 178.3 384 192z"/></svg>
                            </a>
                          <?php } ?>
                        </div>
                <?php
                      }
                    endwhile;
                  }
                ?>
              </div>
          </div>
				</div>
			</div>
		</div>
		<div class="separador--big"></div>
	</section>

<?php get_footer(); ?>
