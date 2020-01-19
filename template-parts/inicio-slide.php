<?php
  $slides = array_filter(get_field('grupo_slide', 'options'));
  $owl;
  count($slides) > 1 ? $owl = 'js-slide owl-carousel' : '';
?>

<section class="section section--slide">
  <div class="container-fluid">
    <div class="frame">
      <div class="slide <?php echo $owl; ?>">
        <?php 
          foreach($slides as $slide) {
        ?>

          <a href="<?php echo $slide['slide_url']; ?>" class="slide__item">
            <picture>
              <source srcset="<?php echo $slide['slide_imagen_movil'] ?>" media="(max-width: 540px)">
              <source srcset="<?php echo $slide['slide_imagen'] ?>" media="(min-width: 541px)">
              <img class="slide__img" src="<?php echo $slide['slide_imagen'] ?>" alt="<?php echo $slide['slide_titulo'] ?>">
            </picture>
          </a>

        <?php
          }
        ?>
      </div>
    </div>
  </div>
</section>