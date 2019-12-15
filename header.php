<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mallplazadelsol
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="icon" href="<?php bloginfo('template_directory'); ?>/favicon.png" type="">

  <script>
		
		// GOOGLE FONTS
		WebFontConfig = {
			google: {
				families: ['Montserrat:300,400,600,800']
			}
		};
		(function () {
			var wf = document.createElement('script');
			wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
				'://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js';
			wf.type = 'text/javascript';
			wf.async = 'true';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(wf, s);
		})();
	</script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <?php 

  // print_r(get_field('modo_mantencion', 'options') ? 'true' : 'false');
  $mantenimiento = '';
  
  if(get_field('modo_mantencion', 'options') && !is_user_logged_in()) {
    $mantenimiento = 'style="display:none;"';
    
    get_template_part( 'template-parts/mantenimiento' );
  
  } ?>

  <main <?php if(is_front_page() && get_field('banner_activar', 'options')) echo 'class="inicio-banner"'; ?> <?php echo $mantenimiento; ?>>

    <header class="header" id="header">
      <div class="header__container flex-xs align-middle-xs">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__item header__item--logo">
          <?php if ( is_front_page() ) : ?>
            <h1 class="texto-imagen">
              <img src="<?php bloginfo('template_directory'); ?>/img/logo-mpds.svg" alt="<?php bloginfo('name'); ?>" class="header__logo">
              <?php bloginfo('name'); ?>
            </h1>
          <?php else : ?>
            <img src="<?php bloginfo('template_directory'); ?>/img/logo-mpds.svg" alt="<?php bloginfo('name'); ?>" class="header__logo">
          <?php endif; ?>
        </a>

        <?php
        $menuConfig = [
          'theme_location' => 'principal',
          'menu_class' => 'menu__lista',
          'container' => 'nav',
          'container_class' => 'header__item header__item--menu menu'
        ];
          wp_nav_menu($menuConfig);
        ?>

        <div class="header__item burger flex-xs oculto-xl" onclick="menuResponsive.toggle();">
          <div class="burger__item"></div>
          <div class="burger__item"></div>
          <div class="burger__item"></div>
        </div>
      </div>
    </header>

    <div class="menu-responsive">
        <div class="menu-responsive__container">
          <?php
          $menuConfig = [
            'theme_location' => 'principal',
            'menu_class' => 'menu-responsive__lista',
            'container' => 'nav'
          ];
            wp_nav_menu($menuConfig);
          ?>
        </div>
    </div>
