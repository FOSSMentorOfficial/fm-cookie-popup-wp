<?php

namespace GDPRCookieMaker;

class CI_Admin {

	/**
	 * return instance from class
	 */
	public static function get_instance() {
		new CI_Admin();
	}

	/**
	 * CI_Admin constructor.
	 */
	public function __construct() {

		add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_scripts' ) );
		add_action( 'admin_notices', array( $this, 'admin_notice' ) );
		add_action( 'wp_ajax_ci_dismiss_notice', array( $this, 'dismiss_admin_notice' ) );

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		$settings = new CI_Settings();

		/* Tab: columns */

		$settings->add_section(
			array(
				'id'    => 'gdprcookiemaker_options',
				'title' => __( 'General Settings', 'GDPRCookieMaker' ),
			)
		);

		$settings->add_field(
			'gdprcookiemaker_options',
			array(
				'id'   => 'gdprcookiemaker_cookie_texts_headline',
				'type' => 'title',
				'name' => '<h3>' . __( 'Content', 'GDPRCookieMaker' ) . '</h3>',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_options',
			array(
				'id'      => 'gdprcookiemaker_cookie_message_headline',
				'type'    => 'text',
				'name'    => __( 'Cookie Notification Headline', 'GDPRCookieMaker' ),
				'default' => __( 'Cookies & Privacy', 'GDPRCookieMaker' ),
			)
		);

		$settings->add_field(
			'gdprcookiemaker_options',
			array(
				'id'      => 'gdprcookiemaker_cookie_message',
				'type'    => 'wysiwyg',
				'name'    => __( 'Cookie Notification Message', 'GDPRCookieMaker' ),
				'default' => __( 'This website uses cookies to ensure you get the best experience on our website.', 'GDPRCookieMaker' ),
			)
		);

		$settings->add_field(
			'gdprcookiemaker_options',
			array(
				'id'      => 'gdprcookiemaker_select_privacy_link',
				'type'    => 'text',
				'name'    => __( 'Privacy Page Link Text', 'GDPRCookieMaker' ),
				'default' => __( 'More Information', 'GDPRCookieMaker' ),
			)
		);

		$settings->add_field(
			'gdprcookiemaker_options',
			array(
				'id'      => 'gdprcookiemaker_button_label',
				'type'    => 'text',
				'name'    => __( 'Accept Button Label', 'GDPRCookieMaker' ),
				'default' => __( 'Accept', 'GDPRCookieMaker' ),
			)
		);


		$settings->add_field(
			'gdprcookiemaker_options',
			array(
				'id'      => 'gdprcookiemaker_customise_label',
				'type'    => 'text',
				'name'    => __( 'Customise Button Label', 'GDPRCookieMaker' ),
				'default' => __( 'Customise', 'GDPRCookieMaker' ),
			)
		);

		$settings->add_field(
			'gdprcookiemaker_options',
			array(
				'id'   => 'gdprcookiemaker_cookie_settings_headline',
				'type' => 'title',
				'name' => '<h3>' . __( 'Settings', 'GDPRCookieMaker' ) . '</h3>',
			)
		);


		$settings->add_field(
			'gdprcookiemaker_options',
			array(
				'id'                => 'gdprcookiemaker_seconds_before_trigger',
				'type'              => 'number',
				'name'              => __( 'Popup delay (seconds)', 'GDPRCookieMaker' ),
				'default'           => 3,
				'sanitize_callback' => 'intval',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_options',
			array(
				'id'                => 'gdprcookiemaker_expiration_time',
				'type'              => 'number',
				'name'              => __( 'Cookie Expiration (days)', 'GDPRCookieMaker' ),
				'default'           => 30,
				'sanitize_callback' => 'intval',
			)
		);
		$settings->add_field(
			'gdprcookiemaker_options',
			array(
				'id'      => 'gdprcookiemaker_select_privacy_slug',
				'type'    => 'text',
				'name'    => __( 'Privacy Page slug', 'GDPRCookieMaker' ),
				'default' => __( 'privacy', 'GDPRCookieMaker' ),
			)
		);

		$settings->add_field(
			'gdprcookiemaker_options',
			array(
				'id'      => 'gdprcookiemaker_select_imprint_slug',
				'type'    => 'text',
				'name'    => __( 'Imprint Page slug', 'GDPRCookieMaker' ),
				'default' => __( 'imprint', 'GDPRCookieMaker' ),
			)
		);

		/* Tab: styling */

		$settings->add_section(
			array(
				'id'    => 'gdprcookiemaker_style',
				'title' => __( 'Design', 'GDPRCookieMaker' ),
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'   => 'gdprcookiemaker_cookie_banner_styles',
				'type' => 'title',
				'name' => '<h3>' . __( 'Cookie Banner', 'GDPRCookieMaker' ) . '</h3>',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'      => 'gdprcookiemaker_message_position',
				'type'    => 'select',
				'name'    => __( 'Banner Position', 'GDPRCookieMaker' ),
				'default' => 'bottom_right',
				'options' => array(
					'center'       => __( 'center', 'GDPRCookieMaker' ),
					'bottom'       => __( 'bottom', 'GDPRCookieMaker' ),
					'bottom_right' => __( 'bottom-right', 'GDPRCookieMaker' ),
				),
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'   => 'gdprcookiemaker_headline_styles',
				'type' => 'title',
				'name' => '<h3>' . __( 'Headline', 'GDPRCookieMaker' ) . '</h3>',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'      => 'gdprcookiemaker_headline_font_color',
				'type'    => 'color',
				'name'    => __( 'Headline Font Color', 'GDPRCookieMaker' ),
				'default' => '#8224e3',
			)
		);

			$settings->add_field(
				'gdprcookiemaker_style',
				array(
					'id'      => 'gdprcookiemaker_headline_font_size',
					'type'    => 'number',
					'name'    => __( 'Headline Font Size (px)', 'GDPRCookieMaker' ),
					'default' => 20,
				)
			);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'   => 'gdprcookiemaker_message_styles',
				'type' => 'title',
				'name' => '<h3>' . __( 'Message', 'GDPRCookieMaker' ) . '</h3>',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'      => 'gdprcookiemaker_message_background_color',
				'type'    => 'color',
				'name'    => __( 'Message Background Color', 'GDPRCookieMaker' ),
				'default' => '#ffffff',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'      => 'gdprcookiemaker_message_font_color',
				'type'    => 'color',
				'name'    => __( 'Message Font Color', 'GDPRCookieMaker' ),
				'default' => '#23282d',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'      => 'gdprcookiemaker_message_font_size',
				'type'    => 'number',
				'name'    => __( 'Message Font Size (px)', 'GDPRCookieMaker' ),
				'default' => 14,
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'      => 'gdprcookiemaker_link_font_color',
				'type'    => 'color',
				'name'    => __( 'Link Font Color', 'GDPRCookieMaker' ),
				'default' => '#000000',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'   => 'gdprcookiemaker_button_styles',
				'type' => 'title',
				'name' => '<h3>' . __( 'Buttons', 'GDPRCookieMaker' ) . '</h3>',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'      => 'gdprcookiemaker_accept_background_color',
				'type'    => 'color',
				'name'    => __( 'Accept Button Background Color', 'GDPRCookieMaker' ),
				'default' => '#8224e3',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'      => 'gdprcookiemaker_accept_font_color',
				'type'    => 'color',
				'name'    => __( 'Accept Button Font Color', 'GDPRCookieMaker' ),
				'default' => '#ffffff',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'      => 'gdprcookiemaker_customise_background_color',
				'type'    => 'color',
				'name'    => __( 'Customise Button Background Color', 'GDPRCookieMaker' ),
				'default' => '#23282d',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'      => 'gdprcookiemaker_customise_font_color',
				'type'    => 'color',
				'name'    => __( 'Customise Button Font Color', 'GDPRCookieMaker' ),
				'default' => '#ffffff',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'      => 'gdprcookiemaker_button_font_size',
				'type'    => 'number',
				'name'    => __( 'Button Font Size (px)', 'GDPRCookieMaker' ),
				'default' => 14,
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'   => 'gdprcookiemaker_overlay_styles',
				'type' => 'title',
				'name' => '<h3>' . __( 'Overlay', 'GDPRCookieMaker' ) . '</h3>',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'      => 'gdprcookiemaker_overlay_status',
				'type'    => 'toggle',
				'default' => 'off',
				'name'    => __( 'Use overlay until cookie accepted', 'GDPRCookieMaker' ),
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'      => 'gdprcookiemaker_overlay_transparency',
				'type'    => 'text',
				'name'    => __( 'Overlay transparency', 'GDPRCookieMaker' ),
				'default' => '0.5',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'      => 'gdprcookiemaker_overlay_z_index',
				'type'    => 'number',
				'name'    => __( 'Overlay z-index', 'GDPRCookieMaker' ),
				'default' => 999,
			)
		);

		$settings->add_field(
			'gdprcookiemaker_style',
			array(
				'id'      => 'gdprcookiemaker_overlay_banner_z_index',
				'type'    => 'number',
				'name'    => __( 'Banner z-index', 'GDPRCookieMaker' ),
				'default' => 9999,
			)
		);

		/* Tab: GDPR */

		$settings->add_section(
			array(
				'id'    => 'gdprcookiemaker_gdpr',
				'title' => __( 'Scripts', 'GDPRCookieMaker' ),
			)
		);

		$settings->add_field(
			'gdprcookiemaker_gdpr',
			array(
				'id'          => 'gdprcookiemaker_ga_code_label',
				'type'        => 'text',
				'name'        => __( 'Google Analytics Label', 'GDPRCookieMaker' ),
				'placeholder' => __( 'Marketing', 'GDPRCookieMaker' ),
			)
		);

		$settings->add_field(
			'gdprcookiemaker_gdpr',
			array(
				'id'          => 'gdprcookiemaker_ga_code',
				'type'        => 'text',
				'name'        => __( 'Google Analytics ID', 'GDPRCookieMaker' ),
				'placeholder' => 'UA-XXXXX-Y',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_gdpr',
			array(
				'id'          => 'gdprcookiemaker_fb_code_label',
				'type'        => 'text',
				'name'        => __( 'Facebook Label', 'GDPRCookieMaker' ),
				'placeholder' => __( 'Social Media', 'GDPRCookieMaker' ),
			)
		);

		$settings->add_field(
			'gdprcookiemaker_gdpr',
			array(
				'id'          => 'gdprcookiemaker_fb_code',
				'type'        => 'text',
				'name'        => __( 'Facebook ID', 'GDPRCookieMaker' ),
				'placeholder' => 'FB_PIXEL_ID',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_gdpr',
			array(
				'id'   => 'gdprcookiemaker_tracking_iframes',
				'type' => 'title',
				'name' => '<h3>' . __( 'iframes', 'GDPRCookieMaker' ) . '</h3>',
			)
		);

		$settings->add_field(
			'gdprcookiemaker_gdpr',
			array(
				'id'      => 'gdprcookiemaker_toggle_iframes',
				'type'    => 'toggle',
				'default' => 'off',
				'name'    => __( 'Block iframes until cookie accepted', 'GDPRCookieMaker' ),
			)
		);

		$settings->add_field(
			'gdprcookiemaker_gdpr',
			array(
				'id'          => 'gdprcookiemaker_iframe_label',
				'type'        => 'text',
				'name'        => __( 'Checkbox-Label', 'GDPRCookieMaker' ),
				'placeholder' => 'Youtube, Google Maps, Vimeo',
				'default'     => __( 'Youtube', 'GDPRCookieMaker' ),
			)
		);

		$settings->add_field(
			'gdprcookiemaker_gdpr',
			array(
				'id'      => 'gdprcookiemaker_iframe_alternate_content',
				'type'    => 'textarea',
				'name'    => __( 'Alternate Content', 'GDPRCookieMaker' ),
				'default' => __( 'To see this content you have to accept our cookies.', 'GDPRCookieMaker' ),
			)
		);

		$settings->add_field(
			'gdprcookiemaker_gdpr',
			array(
				'id'   => 'gdprcookiemaker_custom_tracking_headline',
				'type' => 'title',
				'name' => '<h3>' . __( 'Custom Tracking Codes', 'GDPRCookieMaker' ) . '</h3>',
			)
		);
		$settings->add_field(
			'gdprcookiemaker_gdpr',
			array(
				'id'          => 'gdprcookiemaker_custom_code_1_label',
				'type'        => 'text',
				'name'        => __( 'Checkbox-Label', 'GDPRCookieMaker' ),
				'placeholder' => __( 'Google Tag Manager', 'GDPRCookieMaker' ),

			)
		);

		$settings->add_field(
			'gdprcookiemaker_gdpr',
			array(
				'id'          => 'gdprcookiemaker_custom_code_1_description',
				'type'        => 'textarea',
				'name'        => __( 'Description', 'GDPRCookieMaker' ),
				'placeholder' => '',

			)
		);

		$settings->add_field(
			'gdprcookiemaker_gdpr',
			array(
				'id'   => 'gdprcookiemaker_custom_code_1',
				'type' => 'code',
				'name' => __( 'Tracking-Code', 'GDPRCookieMaker' ),
				'desc' => __( 'Enter your Tracking Code (Example: Google Tag Manager)', 'GDPRCookieMaker' ),

			)
		);

		$settings->add_field(
			'gdprcookiemaker_gdpr',
			array(
				'id'          => 'gdprcookiemaker_custom_code_2_label',
				'type'        => 'text',
				'name'        => __( 'Checkbox-Label', 'GDPRCookieMaker' ),
				'placeholder' => __( 'Google Adsense', 'GDPRCookieMaker' ),

			)
		);

		$settings->add_field(
			'gdprcookiemaker_gdpr',
			array(
				'id'          => 'gdprcookiemaker_custom_code_2_description',
				'type'        => 'textarea',
				'name'        => __( 'Description', 'GDPRCookieMaker' ),
				'placeholder' => '',

			)
		);

		$settings->add_field(
			'gdprcookiemaker_gdpr',
			array(
				'id'   => 'gdprcookiemaker_custom_code_2',
				'type' => 'code',
				'name' => __( 'Tracking-Code', 'GDPRCookieMaker' ),
				'desc' => __( 'Enter your Tracking Code (Example: Google Adsense)', 'GDPRCookieMaker' ),

			)
		);

	}


	/**
	 * Enqueue admin styles and scripts for settings page.
	 */
	public function add_admin_scripts() {
		$min = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : 'min.';

		wp_enqueue_style( 'GDPRCookieMaker-admin', PLUGIN_URL . '/assets/admin/GDPRCookieMaker-admin.' . $min . 'css', '1.0', 'all' );
		wp_enqueue_script( 'ci-admin-notices', PLUGIN_URL . '/assets/admin/backend-admin-notices.' . $min . 'js', array( 'jquery' ), '1.0', true );
		wp_localize_script( 'ci-admin-notices', 'ci_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}

	/**
	 * Outputs admin notice.
	 *
	 * @return void
	 */
	public function admin_notice() {
		$activate_notice = get_option( 'ci_admin_notice', false );

		$text = sprintf( __( 'Thanks for installing GDPRCookieMaker. Start to <a href="%s">configure it</a>', 'GDPRCookieMaker' ), admin_url( 'options-general.php?page=cookii_settings', 'https' ) );

		if ( false === $activate_notice ) {
			echo '<div class="notice notice-success is-dismissible GDPRCookieMaker-dismiss"><p>' . $text . '</p></div>';
		}
	}

	/**
	 * Deactivate admin notice.
	 *
	 * @return void
	 */
	public function dismiss_admin_notice() {
		update_option( 'ci_admin_notice', true );
	}
}
