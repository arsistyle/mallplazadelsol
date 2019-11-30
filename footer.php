<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cinesol
 */

?>

	

	<footer class="footer">
    <div class="footer__container flex-md justify-between-md text-align-center-xs text-align-left-md">
      <div class="footer__item">
        <img src="<?php bloginfo('template_directory'); ?>/img/logo-mpds-blanco.svg" alt="<?php bloginfo('name'); ?>" class="footer__logo">
        <p class="footer__copy">© <?php echo date("Y"); ?> Todos los derechos reservados </p>
        <div class="separador oculto-md"></div>
      </div>
      <?php
        $menuFooterConfig = [
          'menu' => 'footer',
          'menu_class' => 'footer__item footer__item--menu menu-footer oculto-xs block-md',
          'container' => 'nav',
          // 'container_class' => 'footer__item footer__item--menu menu-footer'
        ];
          wp_nav_menu($menuFooterConfig);
        ?>
      <div class="footer__item">
        <?php if ( is_active_sidebar( 'contacto-footer-1' ) ) : ?>
            <?php dynamic_sidebar( 'contacto-footer-1' ); ?>
        <?php endif; ?>
        <div class="separador oculto-md"></div>
      </div>
      <div class="footer__item">
        <div class="footer__redes flex-xs justify-center-xs justify-start-md">
          <?php if( get_field('facebook', 'options') ): ?>
            <a href="<?php get_field('facebook', 'options') ?>" target="_blank" rel="noopener noreferrer" class="footer__red">
              <svg xmlns="http://www.w3.org/2000/svg" width="384" height="384" viewBox="0 0 384 384" class="svg svg--blanco"><rect class="svg--transparente" width="384" height="384"/><path d="M273.4 129.4H218V93.1c0-13.7 9-16.8 15.4-16.8h39.1v-60L218.6 16c-59.8 0-73.4 44.8-73.4 73.4v40h-34.6v61.9h34.6v175.1H218v-175h49.1L273.4 129.4z"/></svg>
            </a>
          <?php endif; ?>
          <?php if( get_field('instagram', 'options') ): ?>
            <a href="<?php get_field('instagram', 'options') ?>" target="_blank" rel="noopener noreferrer" class="footer__red">
              <svg xmlns="http://www.w3.org/2000/svg" width="384" height="384" viewBox="0 0 384 384" class="svg svg--blanco"><rect class="svg--transparente" width="384" height="384"/><path d="M366.9 119.4c-0.8-18.8-3.8-31.6-8.2-42.7C349.6 53 331 34.4 307.3 25.2c-11.1-4.4-24.1-7.4-42.7-8.2S239.9 16 192 16s-53.9 0.1-72.6 1.1 -31.6 3.8-42.7 8.2C53 34.4 34.4 53 25.3 76.7c-4.4 11.2-7.4 24.1-8.2 42.7S16 144.1 16 192s0.1 53.9 1.1 72.6 3.8 31.6 8.2 42.7c9.1 23.6 27.8 42.3 51.4 51.4 11.2 4.4 24.1 7.4 42.7 8.2s24.7 1.1 72.6 1.1 53.9-0.1 72.6-1.1 31.6-3.8 42.7-8.2c23.6-9.1 42.3-27.8 51.4-51.4 4.4-11.1 7.4-24.1 8.2-42.7s1.1-24.8 1.1-72.6S367.9 138.1 366.9 119.4zM335.2 263.1c-0.8 17.1-3.7 26.5-6.1 32.6 -2.8 7.6-7.3 14.6-13.2 20.2 -5.7 5.8-12.6 10.4-20.3 13.2 -6.3 2.5-15.5 5.3-32.6 6.1 -18.6 0.8-24.1 1.1-71.1 1.1s-52.6-0.1-71.1-1.1c-17.1-0.8-26.5-3.7-32.6-6.1 -15.4-5.9-27.5-18.1-33.5-33.5 -2.5-6.3-5.3-15.5-6.1-32.6 -0.8-18.6-1.1-24.2-1.1-71.1s0.1-52.6 1.1-71.1c0.8-17.1 3.7-26.5 6.1-32.7C57.5 80.6 62 73.7 67.8 68c5.7-5.8 12.6-10.4 20.3-13.2 6.3-2.5 15.5-5.3 32.6-6.1 18.6-0.8 24.2-1.1 71.1-1.1s52.6 0.1 71.1 1.1c17.1 0.8 26.5 3.7 32.6 6.1 7.7 2.8 14.6 7.3 20.3 13.2 5.8 5.7 10.3 12.6 13.2 20.2 2.5 6.3 5.3 15.5 6.1 32.7 0.8 18.6 1.1 24.2 1.1 71.1S336 244.6 335.2 263.1z"/><path d="M191.9 101.5c-50 0-90.4 40.5-90.4 90.4s40.5 90.5 90.4 90.5 90.4-40.5 90.4-90.5l0 0C282.3 142.1 241.8 101.6 191.9 101.5zM191.9 250.8c-32.5 0-58.8-26.3-58.8-58.8s26.3-58.8 58.8-58.8 58.8 26.3 58.8 58.8C250.6 224.4 224.3 250.8 191.9 250.8L191.9 250.8z"/><circle cx="285.9" cy="98" r="21.1"/></svg>
            </a>
          <?php endif; ?>
          <?php if( get_field('twitter', 'options') ): ?>
            <a href="<?php get_field('twitter', 'options') ?>" target="_blank" rel="noopener noreferrer" class="footer__red">Twitter</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </footer>
</main>

<?php wp_footer(); ?>

</body>
</html>
