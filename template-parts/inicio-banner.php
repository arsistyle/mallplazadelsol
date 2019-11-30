<style>
  .banner-inicio {
    <?php if (get_field('banner_altura', 'options')) echo '--bannerAltura: '.get_field('banner_altura', 'options').';'; ?>
    <?php if (get_field('banner_color_fondo', 'options')) echo '--bannerColorFondo: '.get_field('banner_color_fondo', 'options').';'; ?>
  }
</style>
<div class="banner-inicio">
  <div class="banner__bg">
    <?php if (get_field('banner_imagen', 'options')) { ?>
      <img src="<?php echo get_field('banner_imagen', 'options'); ?>" alt="">
    <?php } ?>
  </div>
  <?php if (get_field('banner_titulo', 'options')) { ?>
    <div class="banner__contenido">
      <h1>
        <?php if (get_field('banner_etiqueta', 'options')) echo '<small>'.get_field('banner_etiqueta', 'options').'</small>'; ?>
        <?php echo get_field('banner_titulo', 'options'); ?>
      </h1>
    </div>
  <?php } ?>
</div>