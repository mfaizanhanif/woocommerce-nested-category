<?php
/**
* Plugin Name: Nested Category
* Plugin URI: https://faizanhanif.com/plugins/nested-category
* Description: Display products and categories / subcategories as two separate lists in product archive pages
* Version: 1.0
* Author: Faizan Hanif
* Author URI: https://faizanhanif.com
*
*
*/

function faizan_product_cats_css() {
    /* register the stylesheet */
    wp_register_style( 'faizan_product_cats_css', plugins_url( 'css/style.css', __FILE__ ) );
    /* enqueue the stylesheet */
    wp_enqueue_style( 'faizan_product_cats_css' );
}
 
add_action( 'wp_enqueue_scripts', 'faizan_product_cats_css' );

function faizan_product_subcategories( $args = array() ) {
 $parentid = get_queried_object_id();
 
$args = array(
    'parent' => $parentid
);
 
$terms = get_terms( 'product_cat', $args );
 
if ( $terms ) {
    echo '<ul class="product-cats">';
 
    foreach ( $terms as $term ) {
        echo '<li class="category">';                 
            woocommerce_subcategory_thumbnail( $term );
            echo '<h2>';
                echo '<a href="' .  esc_url( get_term_link( $term ) ) . '" class="' . $term->slug . '">';
                    echo $term->name;
                echo '</a>';
            echo '</h2>';
        echo '</li>';
    }
 
    echo '</ul>';
}
}
 
add_action( 'woocommerce_before_shop_loop', 'faizan_product_subcategories', 20 );