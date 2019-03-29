<?php
 
/**
 * Add engraving fields to all products in
 * the product edit general tab.
 */
function iconic_add_engraving_fields() {
	global $post;

	$engraving_data = iconic_get_engraving_data( $post->ID );
	?>
	<div class="options_group">
		<?php
		woocommerce_wp_checkbox( array(
			'id'                => '_iconic_engraving_enable',
			'value'             => $engraving_data['enable'] ? 'yes' : '',
			'label'             => __( 'Enable Engraving', 'iconic' ),
			'description'       => __( 'Enable this to allow the customer to enter engraving text for this product.', 'iconic' ),
		) );

		woocommerce_wp_text_input( array(
			'id'                => '_iconic_engraving_limit',
			'value'             => $engraving_data['limit'],
			'label'             => __( 'Engraving limit', 'iconic' ),
			'placeholder'       => __( 'Unlimited', 'iconic' ),
			'description'       => __( 'Limit the engraving text characters.', 'iconic' ),
			'type'              => 'number',
			'custom_attributes' => array(
				'step' 	=> '1',
				'min'	=> '0',
			),
		) );
		?>
	</div>
	<?php
}

add_action( 'woocommerce_product_options_general_product_data', 'iconic_add_engraving_fields', 40 );

/**
 * Save engraving fields.
 *
 * @param int $post_id
 */
function iconic_save_engraving_fields( $post_id ) {
	if ( empty( $_POST['post_type'] ) || $_POST['post_type'] !== 'product' ) {
		return;
	}

	$data = array(
		'_iconic_engraving_enable' => ! empty( $_POST['_iconic_engraving_enable'] ),
		'_iconic_engraving_limit' => '' === $_POST['_iconic_engraving_limit'] ? '' : absint( $_POST['_iconic_engraving_limit'] ),
	);

	foreach( $data as $key => $value ) {
		update_post_meta( $post_id, $key, $value );
	}
}

add_action( 'save_post', 'iconic_save_engraving_fields', 10 );

/**
 * Get engraving data for product.
 *
 * @param $product_id
 *
 * @return array
 */
function iconic_get_engraving_data( $product_id ) {
	$data = array(
		'enable' => (bool) get_post_meta( $product_id, '_iconic_engraving_enable', true ),
		'limit' => absint( get_post_meta( $product_id, '_iconic_engraving_limit', true ) ),
	);

	if ( empty( $data['limit'] ) ) {
		$data['limit'] = '';
	}

	return $data;
}

/**
 * Output engraving field.
 */
function iconic_output_engraving_field() {
	global $product;

	$engraving_data = iconic_get_engraving_data( $product->get_id() );

	if ( ! $engraving_data['enable'] ) {
		return;
	}

	?>
	<p class="iconic-engraving-field form-row form-row-wide">
		<label for="iconic-engraving"><?php printf( __( 'Engraving (%d characters)', 'iconic' ), $engraving_data['limit'] ); ?></label>
		<input type="text" id="iconic-engraving" class="input-text " name="iconic-engraving" placeholder="<?php _e( 'Enter engraving text', 'iconic' ); ?>" maxlength="<?php echo esc_attr( $engraving_data['limit'] ); ?>">
	</p>
	<?php
}

add_action( 'woocommerce_before_add_to_cart_button', 'iconic_output_engraving_field', 10 );

/**
 * Add engraving text to cart item.
 *
 * @param array $cart_item_data
 * @param int   $product_id
 * @param int   $variation_id
 *
 * @return array
 */
function iconic_add_engraving_text_to_cart_item( $cart_item_data, $product_id, $variation_id ) {
	$engraving_text = filter_input( INPUT_POST, 'iconic-engraving' );

	if ( empty( $engraving_text ) ) {
		return $cart_item_data;
	}

	$cart_item_data['iconic-engraving'] = $engraving_text;

	return $cart_item_data;
}

add_filter( 'woocommerce_add_cart_item_data', 'iconic_add_engraving_text_to_cart_item', 10, 3 );

/**
 * Display engraving text in the cart.
 *
 * @param array $item_data
 * @param array $cart_item
 *
 * @return array
 */
function iconic_display_engraving_text_cart( $item_data, $cart_item ) {
	if ( empty( $cart_item['iconic-engraving'] ) ) {
		return $item_data;
	}

	$item_data[] = array(
		'key'     => __( 'Engraving', 'iconic' ),
		'value'   => wc_clean( $cart_item['iconic-engraving'] ),
		'display' => '',
	);

	return $item_data;
}

add_filter( 'woocommerce_get_item_data', 'iconic_display_engraving_text_cart', 10, 2 );

/**
 * Add engraving text to order.
 *
 * @param WC_Order_Item_Product $item
 * @param string                $cart_item_key
 * @param array                 $values
 * @param WC_Order              $order
 */
function iconic_add_engraving_text_to_order_items( $item, $cart_item_key, $values, $order ) {
	if ( empty( $values['iconic-engraving'] ) ) {
		return;
	}

	$item->add_meta_data( __( 'Engraving', 'iconic' ), $values['iconic-engraving'] );
}

add_action( 'woocommerce_checkout_create_order_line_item', 'iconic_add_engraving_text_to_order_items', 10, 4 );