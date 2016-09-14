<?php
/**
 * Template part for displaying contact button.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package UWC_Website
 */

$id = get_the_ID();
if ( wp_get_post_parent_id( $id ) ) {
	$id = wp_get_post_parent_id( $id );
}
$name = get_field( 'name', $id );
$contact = get_field( 'contact_information', $id );
$email = get_field( 'email', $id );

if ( $name && $contact && $email ) :
?>

	<div class="contact-outer">
		<div class="contact-inner">
			<button id="js-contact" class="contact-button"><span class="screen-reader-text"><?php esc_attr_e( 'Contact us', 'uwc-website' ) ?></span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-4 6V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10c.55 0 1-.45 1-1z"/></svg></button>
			<div class="contact-box">
				<h2 class="contact-headline"><?php echo esc_html( $name ); ?></h2>
				<p class="contact-text"><?php echo esc_html( $contact ); ?></p>
				<a href="mailto:<?php echo esc_html( $email ) ?>" class="contact-link"><?php echo esc_attr_e( 'Ask a question', 'uwc-website' ) ?></a>
			</div>
		</div>
	</div>

<?php endif; ?>
