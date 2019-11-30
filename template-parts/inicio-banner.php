<style>
  .banner-inicio {
    <?php if (get_field('banner_altura', 'options')) echo '--bannerAltura: '.get_field('banner_altura', 'options').';'; ?>
    <?php if (get_field('banner_imagen', 'options')) echo '--bannerImagen: url('.get_field('banner_imagen', 'options').');'; ?>
    <?php if (get_field('banner_color_fondo', 'options')) echo '--bannerColorFondo: '.get_field('banner_color_fondo', 'options').';'; ?>
  }
</style>
<div class="banner-inicio">
  <div class="banner-inicio__bg rellax" data-rellax-speed="3"></div>
  <?php if (get_field('banner_titulo', 'options')) { ?>
    <div class="banner-inicio__contenido">
      <h1 class="banner-inicio__titulo rellax" data-rellax-speed="-2">
        <?php if (get_field('banner_etiqueta', 'options')) echo '<small>'.get_field('banner_etiqueta', 'options').'</small>'; ?>
        <?php echo get_field('banner_titulo', 'options'); ?>
      </h1>
    </div>
  <?php } ?>
</div>