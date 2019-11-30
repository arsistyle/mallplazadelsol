<div class="banner">
  <div class="banner__image">
    <img
      src="<?php
          echo
              crop_image(
                  wp_get_attachment_image_src(
                      get_post_thumbnail_id(),
                      array(1200,500)
                  )[0],
                  1200*0.02,
                  500*0.02
              );
      ?>"
      data-src="<?php
          echo
              crop_image(
                  wp_get_attachment_image_src(
                      get_post_thumbnail_id(),
                      array(1200,500)
                  )[0],
                  1200,
                  500
              );
      ?>"
      alt=""
      class="lozad banner__img"
    >
  </div>
  <div class="frame">
    <div class="banner__container">
      <div class="banner__info">
        <h1 class="color--blanco titulo-hero"><?php the_title(); ?></h1>
        <?php if( get_field('subtitulo') ): ?>
          <h2 class="color--blanco"><?php echo the_field('subtitulo'); ?></h2>                      
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>