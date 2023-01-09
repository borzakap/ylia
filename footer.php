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
                    <div class="col-md-3 col-xs-12">
                        <ul class="address-footer">
                            <?php if($contact_address = get_theme_mod('contact_address')) : ?>
                            <li class="location"><?= $contact_address ?></li>
                            <?php endif; ?>
                            <?php if($contact_email = get_theme_mod('contact_email')) : ?>
                            <li class="location"><a href="mailto:<?= $contact_email ?>"><?= $contact_email ?></a></li>
                            <?php endif; ?>
                            <?php if($contact_phone = get_theme_mod('contact_phone')) : ?>
                            <li class="location"><a href="tel:<?= $contact_phone ?>"><?= $contact_phone ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
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
