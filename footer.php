<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _ylia
 */

?>

	<footer id="colophon" class="site-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-xs-12">
                        <div class="footer-logo">
                            <?php the_custom_logo(); ?>
                        </div>
                        <ul class="social-buttons">
                            <?php if($contact_facebook = get_theme_mod( 'contact_facebook' )) : ?>
                            <li class="link">
                                <a class="facebook" href="<?= $contact_facebook ?>" target="_blank"></a>
                            </li>
                            <?php endif; ?>
                            <?php if($contact_instagram = get_theme_mod( 'contact_instagram' )) : ?>
                            <li class="link">
                                <a class="instagram" href="<?= $contact_instagram ?>" target="_blank"></a>
                            </li>
                            <?php endif; ?>
                            <?php if($contact_youtube = get_theme_mod( 'contact_youtube' )) : ?>
                            <li class="link">
                                <a class="youtube" href="<?= $contact_youtube ?>" target="_blank"></a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-md-3 col-xs-12"></div>
                    <div class="col-md-3 col-xs-12"></div>
                    <div class="col-md-3 col-xs-12"></div>
                </div>
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'ylia' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'ylia' ), 'ZenSadhu' );
				?>
			</a>
		</div><!-- .site-info -->
            </div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<!-- cart -->
<?php
if ( function_exists( 'ylia_woocommerce_header_cart' ) ) {
    ylia_woocommerce_header_cart();
}
?>

</body>
</html>
