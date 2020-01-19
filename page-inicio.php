<?php get_header(); ?>
<?php
  if( get_field('banner_activar', 'options')) {
    get_template_part( 'template-parts/inicio', 'banner' );
  }
?>
<?php
  if( get_field('slide_activar', 'options')) {
    get_template_part( 'template-parts/inicio', 'slide' );
  }
?>
<?php
  if( get_field('promociones_activar', 'options')) {
    get_template_part( 'template-parts/inicio', 'promociones' );
  }
?>
<?php get_footer(); ?>