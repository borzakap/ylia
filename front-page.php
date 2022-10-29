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
            <?php if(get_option( 'show_on_front' ) == 'page' ) : 
                $p = get_page(get_option( 'page_on_front' )); ?>
            <section class="page-front">
                <div class="section-cover">
                    <div class="container">
                        <div class="row">
                            <h2 class="col-md-12"><?= apply_filters('post_title', $p->post_title) ?></h2>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                            <?= get_the_post_thumbnail( $p->ID, 'thumbnail' ); ?>
                            </div>
                            <div class="col-md-9">
                            <?= apply_filters('the_content', $p->post_content); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php endif; ?>
            <?php
                dynamic_sidebar( 'home-sidebar-1' );
                dynamic_sidebar( 'home-sidebar-2' );
                dynamic_sidebar( 'home-sidebar-3' );
            ?>
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
