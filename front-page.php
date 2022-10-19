<?php
/**
 * The template for displaying front page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package khmarska
 */

get_header();
?>

	<main id="primary">
            <section id="slider" class="home-slider">
                <ul>
                <?php
                $slider_args = array(
                    'post_type' => 'slider',
                    'order' => 'ASC',
                    'posts_per_page' => 5,
                );

                $sliders = new WP_Query($slider_args);

                while($sliders->have_posts()) : 
                    $sliders->the_post();
                    get_template_part('template-parts/content', 'slider');
                endwhile;
                wp_reset_postdata();
                ?>
                </ul>
            </section>
            <!-- prodact categories -->
            <section class="product-categories">
                <div class="container">
                    <h2 class="main-page-header"><?= __('Main Categories','ylia') ?></h2>
                    <div class="main-page-categories">
                        <?php ylia_woocommerce_prodact_categories(); ?>
                    </div>
                </div>
            </section>
            <?php
                dynamic_sidebar( 'home-sidebar-1' );
                dynamic_sidebar( 'home-sidebar-2' );
                dynamic_sidebar( 'home-sidebar-3' );
            ?>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
