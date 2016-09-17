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
$role = get_field( 'role', $id );
$contact = get_field( 'contact_information', $id );
$email = get_field( 'email', $id );

if ( $name && $contact && $email ) :
?>

	<div class="contact-outer">
		<div class="contact-inner">
			<button id="js-contact" class="contact-button"><span class="screen-reader-text"><?php esc_attr_e( 'Contact us', 'uwc-website' ) ?></span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path class="contact-open" d="M21 6h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1zm-4 6V3c0-.55-.45-1-1-1H3c-.55 0-1 .45-1 1v14l4-4h10c.55 0 1-.45 1-1z"/><path class="contact-close" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg></button>
			<div class="contact-box">
				<div class="contact-header">
				<?php if( get_field( 'profile_picture', $id ) ) :
						$image = get_field( 'profile_picture', $id );
						$size = 'thumbnail';
						$url = $image['sizes'][ $size ];
						?>
					<div class="contact-image" style="background-image: url(<?php echo esc_url( $url ); ?>)"></div>
				<?php endif; ?>
					<div class="contact-headline">
						<h2 class="contact-name"><?php echo esc_html( $name ); ?></h2>
						<p class="contact-role"><?php echo esc_html( $role ); ?></p>
					</div>
				</div>
				<div class="contact-body">
					<p class="contact-info"><?php echo wp_kses( $contact, array(
					    'a' => array(
					        'href' => array(),
					        'title' => array(),
					    ),
					    'br' => array(),
					    'em' => array(),
					    'strong' => array(),
					) ); ?></p>
					<a href="mailto:<?php echo esc_html( $email ) ?>" class="contact-link"><?php echo esc_attr_e( 'Ask a question', 'uwc-website' ) ?></a>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>
