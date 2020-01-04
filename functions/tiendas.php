<?php

/**
 * 
 * Crear columna en el Custom Post Type
 * 
 */
function add_tiendas_columns ( $columns ) {
	return array_merge ( $columns, array ( 
		'tienda_numero_local' => __ ( 'Local' ),
		'tienda_piso' => __ ( 'Piso' ),
	) );
}
add_filter ( 'manage_tiendas_posts_columns', 'add_tiendas_columns' );


/**
 * 
* Añadir data a las columnas creadas arriba

*/
function tiendas_custom_column ( $column, $post_id ) {
	switch ( $column ) {
		case 'tienda_numero_local':
			echo the_field('tienda_numero_local');
		break;
		case 'tienda_piso':
			echo the_field('tienda_piso');
		break;
		// case 'eventos_fecha_hasta':
		// 	$hasta = null;
		// 	if (get_field('eventos_fecha_hasta')) $hasta = get_field('eventos_fecha_hasta');
		// 	echo $hasta;
		// break;
		// case 'eventos_hora':
		// 	echo the_field('eventos_hora');
		// 	break;
		// case 'eventos_destacado':
		// 	$destacado = null;
		// 	if (get_field('eventos_destacado')) $destacado = 'Si';
		// 		echo $destacado;
		// 		break;
	}
}
add_action ( 'manage_tiendas_posts_custom_column', 'tiendas_custom_column', 10, 2 );


/**
 * 
 * Hacer las columnas sorteables 
 * 
 */
function tiendas_sortable_columns( $columns ) {
	$columns['tienda_numero_local'] = 'tienda_numero_local';	
	$columns['tienda_piso'] = 'tienda_piso';	
  return $columns;
}
add_filter( 'manage_edit-tiendas_sortable_columns', 'tiendas_sortable_columns' );


/**
 * 
 * Ordenar filas por valor numérico 
 * 
 */
function eventos_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'tienda_numero_local' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'tienda_numero_local',
            'orderby' => 'tienda_numero_local',
        ) );
    }
    if ( isset( $vars['orderby'] ) && 'tienda_piso' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'tienda_piso',
            'orderby' => 'tienda_piso',
        ) );
    }

    return $vars;
}
add_filter( 'request', 'eventos_column_orderby' );

//join postmeta for search
add_filter( 'posts_join' , function($join){
    global $wpdb;
    if(is_search() && is_admin() && $_GET['post_type'] == 'tiendas')
    {
     $join .= " LEFT JOIN $wpdb->postmeta ON $wpdb->posts.ID = $wpdb->postmeta.post_id ";
    }
     return $join;
});

//search [your_postmeta_key] for search string
add_filter( 'posts_where', function( $where )
{
    global $wpdb;
    if(is_search() && is_admin() && $_GET['post_type'] == 'tiendas')
    {
        $searchstring = '%' . $wpdb->esc_like( $_GET['s'] ) . '%';
        //search [your_postmeta_key] as well
        $where .= $wpdb->prepare(" OR ($wpdb->postmeta.meta_key = 'tienda_numero_local' AND $wpdb->postmeta.meta_value LIKE %s) ", $searchstring);   
        $where .= $wpdb->prepare(" OR ($wpdb->postmeta.meta_key = 'tienda_piso' AND $wpdb->postmeta.meta_value LIKE %s) ", $searchstring);   
    }
    return $where;
});

//group by post ID
add_filter( 'posts_groupby', function ($groupby, $query) {

    global $wpdb;
    if(is_search() && is_admin() && $_GET['post_type'] == 'tiendas')
    {
        $groupby = "{$wpdb->posts}.ID";
    }
    return $groupby;

}, 10, 2 );

?>
