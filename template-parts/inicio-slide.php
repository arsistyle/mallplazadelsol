<section class="section section--slide">
  <div class="container-fluid">
    <div class="frame">
      <?php
        $owl;
        count(get_field('grupo_slide', 'options')) > 1 ? $owl = 'js-slide owl-carousel' : '';
      ?>
      <div class="slide <?php echo $owl; ?>">
        <?php
          if( have_rows('grupo_slide', 'options') ): while ( have_rows('grupo_slide', 'options') ) : the_row();
          if (get_sub_field('slide_url')) {
        ?>
          <a href="<?php the_sub_field('slide_url'); ?> <?php if (get_sub_field('slide_nueva_pestana')) echo 'target="_blank"'; ?>" class="slide__item">
            <picture >
                <source srcset="<?php the_sub_field('slide_imagen_movil') ?>" media="(max-width: 540px)">
                <source srcset="<?php the_sub_field('slide_imagen') ?>" media="(min-width: 541px)">
                <img class="slide__img" src="<?php the_sub_field('slide_imagen') ?>" alt="<?php the_sub_field('slide_titulo') ?>">
            </picture>
          </a>
        <?php } else { ?>
          <div class="slide__item">
            <picture >
                <source srcset="<?php the_sub_field('slide_imagen_movil') ?>" media="(max-width: 540px)">
                <source srcset="<?php the_sub_field('slide_imagen') ?>" media="(min-width: 541px)">
                <img class="slide__img" src="<?php the_sub_field('slide_imagen') ?>" alt="<?php the_sub_field('slide_titulo') ?>">
            </picture>
          </div>
        <?php } ?>
        <?php 
          endwhile;
          endif;
        ?>
      </div>
    </div>
  </div>
</section>