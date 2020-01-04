<?php

/*
 * Crear columna en el Custom Post Type
 */
function add_eventos_columns ( $columns ) {
	return array_merge ( $columns, array ( 
		'eventos_destacado' => __ ( 'Destacado' ),
		'eventos_fecha_desde' => __ ( 'Fecha inicio' ),
		'eventos_fecha_hasta' => __ ( 'Fecha fin' ),
		'eventos_hora' => __ ( 'Hora inicio' ),
	) );
}
add_filter ( 'manage_eventos_posts_columns', 'add_eventos_columns' );

/*
* Añadir data a las columnas creadas arriba
*/
function eventos_custom_column ( $column, $post_id ) {
	switch ( $column ) {
		case 'eventos_fecha_desde':
			echo the_field('eventos_fecha_desde');
		break;
		case 'eventos_fecha_hasta':
			$hasta = null;
			if (get_field('eventos_fecha_hasta')) $hasta = get_field('eventos_fecha_hasta');
			echo $hasta;
		break;
		case 'eventos_hora':
			echo the_field('eventos_hora');
			break;
		case 'eventos_destacado':
			$destacado = null;
			if (get_field('eventos_destacado')) $destacado = 'Si';
				echo $destacado;
				break;
	}
}
add_action ( 'manage_eventos_posts_custom_column', 'eventos_custom_column', 10, 2 );

/*
 * Hacer las columnas sorteables 
 */
function eventos_sortable_columns( $columns ) {
	$columns['eventos_fecha_desde'] = 'eventos_fecha_desde';
	$columns['eventos_fecha_hasta'] = 'eventos_fecha_hasta';	
  return $columns;
}
add_filter( 'manage_edit-eventos_sortable_columns', 'eventos_sortable_columns' );

?>
