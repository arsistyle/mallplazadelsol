<?php get_header(); ?>
<?php
  if( get_field('banner_activar', 'options')) {
    get_template_part( 'template-parts/inicio', 'banner' );
  }
?>
<?php // get_template_part( 'template-parts/inicio', 'cartelera' ); ?>
<?php // get_template_part( 'template-parts/inicio', 'intereses' ); ?>
<?php get_footer(); ?>