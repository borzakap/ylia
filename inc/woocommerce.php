<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package _s
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function ylia_woocommerce_setup() {
    add_theme_support(
            'woocommerce',
            array(
                'thumbnail_image_width' => 250,
                'single_image_width' => 500,
                'product_grid' => array(
                    'default_rows' => 3,
                    'min_rows' => 1,
                    'default_columns' => 4,
                    'min_columns' => 1,
                    'max_columns' => 6,
                ),
            )
    );
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}

add_action('after_setup_theme', 'ylia_woocommerce_setup');

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function ylia_woocommerce_scripts() {
    wp_enqueue_style('_ylia-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _YLIA_VERSION);

    $font_path = WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

    wp_add_inline_style('_ylia-woocommerce-style', $inline_font);
}

add_action('wp_enqueue_scripts', 'ylia_woocommerce_scripts');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function ylia_woocommerce_active_body_class($classes) {
    $classes[] = 'woocommerce-active';

    return $classes;
}

add_filter('body_class', 'ylia_woocommerce_active_body_class');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function ylia_woocommerce_related_products_args($args) {
    $defaults = array(
        'posts_per_page' => 4,
        'columns' => 4,
    );

    $args = wp_parse_args($defaults, $args);

    return $args;
}

add_filter('woocommerce_output_related_products_args', 'ylia_woocommerce_related_products_args');

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('ylia_woocommerce_wrapper_before')) {

    /**
     * Before Content.
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function ylia_woocommerce_wrapper_before() {
        ?>
        <main id="primary" class="site-main container">
            <?php
        }

    }
    add_action('woocommerce_before_main_content', 'ylia_woocommerce_wrapper_before');

    if (!function_exists('ylia_woocommerce_wrapper_after')) {

        /**
         * After Content.
         *
         * Closes the wrapping divs.
         *
         * @return void
         */
        function ylia_woocommerce_wrapper_after() {
            ?>
        </main><!-- #main -->
        <?php
    }

}
add_action('woocommerce_after_main_content', 'ylia_woocommerce_wrapper_after');

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
  <?php
  if ( function_exists( 'ylia_woocommerce_header_cart' ) ) {
  ylia_woocommerce_header_cart();
  }
  ?>
 */
if (!function_exists('ylia_woocommerce_cart_link_fragment')) {

    /**
     * Cart Fragments.
     *
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param array $fragments Fragments to refresh via AJAX.
     * @return array Fragments to refresh via AJAX.
     */
    function ylia_woocommerce_cart_link_fragment($fragments) {
        ob_start();
        ylia_woocommerce_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }

}
add_filter('woocommerce_add_to_cart_fragments', 'ylia_woocommerce_cart_link_fragment');
// Remove the category count for WooCommerce categories
add_filter( 'woocommerce_subcategory_count_html', '__return_null' );
// remove ordering
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

if (!function_exists('ylia_woocommerce_cart_link')) {

    /**
     * Cart Link.
     *
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * @return void
     */
    function ylia_woocommerce_cart_link() {
            ?>
            <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'fijis'); ?>">
                <?php
                $item_count_text = sprintf(
                        /* translators: number of items in the mini cart. */
                        _n('%d', '%d', WC()->cart->get_cart_contents_count(), 'fijis'),
                        WC()->cart->get_cart_contents_count()
                );
                ?>
                <span class="count"><?php echo esc_html($item_count_text); ?></span>
            </a>
            <?php
    }

}

if (!function_exists('ylia_woocommerce_header_cart')) {

    /**
     * Display Header Cart.
     *
     * @return void
     */
    function ylia_woocommerce_header_cart() {
        if (!is_cart() && !is_checkout() && !is_checkout_pay_page()) {
            ?>
            <div id="cd-shadow-layer" class=""></div>
            <div id="cd-cart-trigger">
                <?php ylia_woocommerce_cart_link(); ?>
            </div>
            <div id="cd-cart" class="">
                <div id="site-header-cart" class="cd-cart-items site-header-cart">
                    <h2 class="cart-title"><?= __('Cart', 'ylia') ?> <a href="#" id="hide-mini-cart">??</a></h2>

                    <?php
                    $instance = array(
                        'title' => '',
                    );

                    the_widget('WC_Widget_Cart', $instance);
                    ?>
                </div>
            </div>
            <?php
        }
    }

}

/**
 * Show the shortcode phoduct_categories on template
 */
if (!function_exists('ylia_woocommerce_prodact_categories')) {

    function ylia_woocommerce_prodact_categories() {

        $columns = get_option('product_catgories_numbers', 100);
        if ((int) $columns < 1) {
            $columns = 3;
        }

        $atts = array(
            'limit' => $columns,
            'columns' => 4,
            'parent' => 0,
            'hide_empty' => false,
            'orderby' => 'menu_order',
            'order' => 'ASC',
        );

        $var = WC_Shortcodes::product_categories($atts);
        echo $var;
    }

}
