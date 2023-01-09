<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _s
 */


if (is_front_page() ) {
    $classes = ['col-md-4'];
}else{
    $classes = [];
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
    	<?php 
            if ( is_front_page() ) :
                ylia_post_thumbnail(); 
            endif;
        ?>
	<header class="entry-header">
		<?php
		if ( !is_front_page() && is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
                ?>
	</header><!-- .entry-header -->
        <div class="entry-content">
        <?php
            if ( !is_front_page() && is_singular() ) :
                the_content();
            endif;
        ?>
        </div>
</article><!-- #post-<?php the_ID(); ?> -->
