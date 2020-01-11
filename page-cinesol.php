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

	<section class="section section--interior movies">
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
          <div class="row">

            <?php 
              $api = array_filter(CallAPI('https://cinesol.cl/wp-json/wp/v2/cartelera?status=publish'));
              foreach ( $api as $movie ) {
            ?>
                <div class="col-xs-12 col-md-6 col-lg-3">
                  <a href="<?php echo $movie->link; ?>" class="movies__item" target="_blank">
                    <div class="movies__image">
                      <?php if( $movie->estreno ): ?>
                        <div class="movies__estreno">Estreno</div>                      
                      <?php endif; ?>
                      <img src="<?php echo $movie->fimg_url[1]; ?>" data-src="<?php echo $movie->fimg_url[0]; ?>" alt="<?php echo $movie->title->rendered ?>" class="movies__img lozad">
                      <img src="<?php echo $movie->fimg_url[1]; ?>" data-src="<?php echo $movie->fimg_url[0]; ?>" alt="<?php echo $movie->title->rendered ?>" class="movies__sombra lozad">
                    </div>
                    <div class="movies__info">
                      <h3 class="movies__title"><?php echo $movie->title->rendered ?></h3>
                    </div>
                  </a>
                </div>
            <?php
              }
            ?>

            <div class="col-xs-12 text-align-right-xs">
              <div class="separador--big"></div>
              <a href="https://www.cinesol.cl/" class="btn btn--primario btn--borde" target="_blank">Ir a Cinesol</a>
            </div>
              
          </div>
				</div>
			</div>
		</div>
		<div class="separador--big"></div>
	</section>

<?php get_footer(); ?>
