<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NC_Template
 */

?>

	</div>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-widgets">
			<?php if ( is_active_sidebar( 'footer-left' ) ) : ?>
				<div class="footer-widget footer-left">
					<?php dynamic_sidebar( 'footer-left' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-center' ) ) : ?>
				<div class="footer-widget footer-center">
					<?php dynamic_sidebar( 'footer-center' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( is_active_sidebar( 'footer-right' ) ) : ?>
				<div class="footer-widget footer-right">
					<?php dynamic_sidebar( 'footer-right' ); ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="footer-info">
			<p>&#xa9; <?php bloginfo( 'name' ); ?>. <?php echo esc_html__( 'All rights reserved.', 'nc-template' ); ?>
				<?php printf( esc_html__( 'Website by %s.', 'nc-template' ), '<a href="http://connorbaer.io/" rel="designer">Connor B&#228;r</a>' ); ?>
			</p>
		</div>

	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>
