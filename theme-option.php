<?php
/**
 * Create A Simple Theme Options Panel
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'as_clock_admin' ) ) {

	class as_clock_option {

		/**
		 * Start things up
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// We only need to register the admin panel on the back-end
			if ( is_admin() ) {
				add_action( 'admin_menu', array( 'as_clock_option', 'add_admin_menu' ) );
				add_action( 'admin_init', array( 'as_clock_option', 'register_settings' ) );
			}

		}

		/**
		 * Returns all theme options
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_options() {
			return get_option( 'theme_options' );
		}

		/**
		 * Returns single theme option
		 *
		 * @since 1.0.0
		 */
		public static function get_theme_option( $id ) {
			$options = self::get_theme_options();
			if ( isset( $options[$id] ) ) {
				return $options[$id];
			}
		}

		/**
		 * Add sub menu page
		 *
		 * @since 1.0.0
		 */
		public static function add_admin_menu() {
			add_menu_page(
				esc_html__( 'Wall Clock', 'text-domain' ),
				esc_html__( 'Wall Clock', 'text-domain' ),
				'manage_options',
				'theme-settings',
				array( 'as_clock_option', 'create_admin_page' )
			);
		}

		/**
		 * Register a setting and its sanitization callback.
		 *
		 * We are only registering 1 setting so we can store all options in a single option as
		 * an array. You could, however, register a new setting for each option
		 *
		 * @since 1.0.0
		 */
		public static function register_settings() {
			register_setting( 'theme_options', 'theme_options', array( 'as_clock_option', 'sanitize' ) );
		}

		/**
		 * Sanitization callback
		 *
		 * @since 1.0.0
		 */
		public static function sanitize( $options ) {

			// If we have options lets sanitize them
			if ( $options ) {

				// Checkbox
				if ( ! empty( $options['checkbox_example'] ) ) {
					$options['checkbox_example'] = 'on';
				} else {
					unset( $options['checkbox_example'] ); // Remove from options if not checked
				}

				// Input
				if ( ! empty( $options['input_example'] ) ) {
					$options['input_example'] = sanitize_text_field( $options['input_example'] );
				} else {
					unset( $options['input_example'] ); // Remove from options if empty
				}

				// Select
				if ( ! empty( $options['select_example'] ) ) {
					$options['select_example'] = sanitize_text_field( $options['select_example'] );
				}

			}

			// Return sanitized options
			return $options;

		}

		/**
		 * Settings page output
		 *
		 * @since 1.0.0
		 */
		public static function create_admin_page() { ?>

			<div class="wrap">

				<h1><?php esc_html_e( 'Wall Clock Options', 'text-domain' ); ?></h1>

				<form method="post" action="options.php">

					<?php settings_fields( 'theme_options' ); ?>

					<table class="form-table wpex-custom-admin-login-table">
						<!---user location---->
						<!----
						Upcoming
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'User Location', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'user_loc' ); ?>
								<input type="checkbox" name="theme_options[user_loc]" <?php checked( $value, 'on' ); ?>> <?php esc_html_e( 'Automatic detect user location.', 'text-domain' ); ?>
							</td>
						</tr>
						---->
						<!-----Clock Type------>
						
						
						<!------show date------>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Enable Date', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'dt_clock_type' ); ?>
								<input type="checkbox" name="theme_options[dt_clock_type]" <?php checked( $value, 'on' ); ?>> <?php esc_html_e( 'Show date with clock', 'text-domain' ); ?>
								
							</td>
							
						</tr>
							
						
						
						<?php // Text input  ?>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Your Title', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'custom_title' ); ?>
								<input type="text" name="theme_options[custom_title]" value="<?php echo esc_attr( $value ); ?>">
							</td>
						</tr>

						<!------meridiem------>
						<tr valign="top">
							<th scope="row"><?php esc_html_e( 'Enable Meridiem', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'clock_meridiem' ); ?>
								<input type="checkbox" name="theme_options[clock_meridiem]" <?php checked( $value, 'on' ); ?>> <?php esc_html_e( 'Show AM / PM', 'text-domain' ); ?>
								
							</td>
							
						</tr>
						<?php // analog model ?>
						<tr valign="top" class="wpex-custom-admin-screen-background-section">
							<th scope="row"><?php esc_html_e( 'Choose Analog model', 'text-domain' ); ?></th>
							<td>
								<?php $value = self::get_theme_option( 'analog_model' ); ?>
								<select name="theme_options[analog_model]">
									<?php
									$options = array(
										'Mobel 1' => esc_html__( 'Model 1', 'text-domain' ),
										'Mobel 2' => esc_html__( 'Model 2', 'text-domain' ),
										'Mobel 3' => esc_html__( 'Model 3', 'text-domain' ),
										'Mobel 4' => esc_html__( 'Model 4', 'text-domain' ),
										'Mobel 5' => esc_html__( 'Model 5', 'text-domain' ),
									);
									foreach ( $options as $id => $label ) { ?>
										<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $value, $id, true ); ?>>
											<?php echo strip_tags( $label ); ?>
										</option>
									<?php } ?>
								</select>
							</td>
						</tr>

					</table>

					<?php submit_button(); ?>

				</form>

			</div><!-- .wrap -->
		<?php }

	}	

}
new as_clock_option();

// Helper function to use in your theme to return a theme option value
function myprefix_get_theme_option( $id = '' ) {
	return as_clock_option::get_theme_option( $id );
}
