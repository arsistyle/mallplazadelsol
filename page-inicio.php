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
  if( get_field('accesos_activar', 'options')) {
    get_template_part( 'template-parts/inicio', 'accesos' );
  }
?>
<?php get_footer(); ?>