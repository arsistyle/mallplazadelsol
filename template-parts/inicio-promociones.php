<?php

    $loop = array(
        'post_type' => 'promociones',
        'posts_per_page'=> 4,
        'orderby'   => 'rand',
    );
    $query = new WP_Query( $loop );

?>

<?php if ($query->have_posts()) {?>
  <section class="section section--accesos">
    <div class="container-fluid">
      <div class="frame">
        <div class="ars1-galeria js-galeria row" data-group="promocion">
          
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
        </div>
        <div class="text-align-right-xs">
          <div class="separador"></div>
          <a href="/promociones" class="btn btn--primario btn--borde">Todas las promociones</a>
        </div>
      </div>
    </div>
    <div class="separador--big"></div>
  </section>
<?php } ?>