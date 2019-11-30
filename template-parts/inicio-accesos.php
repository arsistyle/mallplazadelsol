<section class="section section--accesos">
  <div class="container-fluid">
    <div class="frame">
      <div class="accesos">
        <div class="row">
          <?php
            if( have_rows('grupo_accesos', 'options') ): while ( have_rows('grupo_accesos', 'options') ) : the_row();
          ?>
            <div class="col-xs-12 col-md-6 col-lg-3">
              <a href="<?php the_sub_field('accesos_url'); ?> <?php if (get_sub_field('accesos_nueva_pestana')) echo 'target="_blank"'; ?>" class="accesos__item">
                <picture >
                  <img class="accesos__img" src="<?php the_sub_field('accesos_imagen') ?>" alt="<?php the_sub_field('accesos_titulo') ?>">
                </picture>
              </a>
            </div>
          <?php 
            endwhile;
            endif;
          ?>
        </div>
      </div>
    </div>
  </div>
</section>