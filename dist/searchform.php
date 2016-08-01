<?php
/**
 * Template for displaying search forms in NC Template
 *
 * @package NC Template
 */

?><form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_attr_x( 'Search for:', 'label', 'nc-template' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'nc-template' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
</form>
