function sku_to_rating($example) {


    global $product;
    $sku = $product->get_sku();
    echo 'SKU:'.$sku;
    echo '<br />';
    echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' );
    echo '<br />';
    return $example;
}
add_filter('woocommerce_get_price_html', 'sku_to_rating');

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


/**
 * Change number of related products output
 */ 
function woo_related_products_limit() {
    global $product;
      
      $args['posts_per_page'] = 3;
      return $args;
  }
  add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
    function jk_related_products_args( $args ) {
      $args['posts_per_page'] = 3; // 3 related products
      $args['columns'] = 3; // arranged in 3 columns
      return $args;
  }


/**
 * Remove default thumbnail
 */ 
add_filter( 'woocommerce_cart_item_thumbnail', '__return_false' );


/**
 * Move thumbnail before the title
 */ 
  function sv_remove_cart_product_link( $product_link, $cart_item, $cart_item_key ) {
    global $product;
    $product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
    return $product->get_title();
}
add_filter( 'woocommerce_cart_item_name', 'sv_remove_cart_product_link', 10, 3 );
