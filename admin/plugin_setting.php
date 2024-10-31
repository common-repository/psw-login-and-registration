<?php 
/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

class PSWGeneralFeatures {
	private $psw_general_features_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'psw_general_features_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'psw_general_features_page_init' ) );
	}

	public function psw_general_features_add_plugin_page() {
		add_options_page(
			esc_html__('PSW -  Front-end Login and registration', 'prositegeneralfeatures'), // page_title
			esc_html__('PSW -  Front-end Login and registration', 'prositegeneralfeatures'), // menu_title
			'manage_options', // capability
			'psw-general-features', // menu_slug
			array( $this, 'psw_general_features_create_admin_page' ) // function
		);
	}

	public function psw_general_features_create_admin_page() {
		$this->psw_general_features_options = get_option( 'psw_general_features_option_name' ); ?>

		<div class="wrap" id="psw_front_end_registration">
			<h2><?php echo esc_html__('PSW -  Front-end Login and registration', 'prositegeneralfeatures'); ?> </h2>
			<p></p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'psw_general_features_option_group' );
					do_settings_sections( 'psw-general-features-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }

	public function psw_general_features_page_init() {
		register_setting(
			'psw_general_features_option_group', // option_group
			'psw_general_features_option_name', // option_name
			array( $this, 'psw_general_features_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'psw_general_features_setting_section', // id
			esc_html__('Settings', 'prositegeneralfeatures'), // title
			array( $this, 'psw_general_features_section_info' ), // callback
			'psw-general-features-admin' // page
		);

		add_settings_field(
			'user_registration_default_role_0', // id
			esc_html__('User registration default role', 'prositegeneralfeatures'), // title
			array( $this, 'user_registration_default_role_0_callback' ), // callback
			'psw-general-features-admin', // page
			'psw_general_features_setting_section' // section
		);

		add_settings_field(
			'extra_emails_comma_separated_1', // id
			esc_html__('Extra emails (comma separated)', 'prositegeneralfeatures'), // title
			array( $this, 'extra_emails_comma_separated_1_callback' ), // callback
			'psw-general-features-admin', // page
			'psw_general_features_setting_section' // section
		);

		add_settings_field(
			'user_registration_page_2', // id
			esc_html__('user registration page', 'prositegeneralfeatures'), // title
			array( $this, 'user_registration_page_2_callback' ), // callback
			'psw-general-features-admin', // page
			'psw_general_features_setting_section' // section
		);

		add_settings_field(
			'enable_a_blank_design_3', // id
			esc_html__('Disable the default login and registration (wp-login.php)', 'prositegeneralfeatures'), // title
			array( $this, 'enable_a_blank_design_3_callback' ), // callback
			'psw-general-features-admin', // page
			'psw_general_features_setting_section' // section
		);
		
			add_settings_field(
			'psw_google_client_id', // id
			esc_html__('Google Client ID - API', 'prositegeneralfeatures'), // title
			array( $this, 'psw_google_client_id' ), // callback
			'psw-general-features-admin', // page
			'psw_general_features_setting_section' // section
		);
		
			add_settings_field(
			'psw_google_client_secret', // id
			esc_html__('Google Client Secret - API', 'prositegeneralfeatures'), // title
			array( $this, 'psw_google_client_secret' ), // callback
			'psw-general-features-admin', // page
			'psw_general_features_setting_section' // section
		);
		
		
				add_settings_field(
			'psw_facebook_client_id', // id
			esc_html__('facebook Client ID - API', 'prositegeneralfeatures'), // title
			array( $this, 'psw_facebook_client_id' ), // callback
			'psw-general-features-admin', // page
			'psw_general_features_setting_section' // section
		);
		
			add_settings_field(
			'psw_facebook_client_secret', // id
			esc_html__('facebook Client Secret - API', 'prositegeneralfeatures'), // title
			array( $this, 'psw_facebook_client_secret' ), // callback
			'psw-general-features-admin', // page
			'psw_general_features_setting_section' // section
		);
	}

	public function psw_general_features_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['user_registration_default_role_0'] ) ) {
			$sanitary_values['user_registration_default_role_0'] = $input['user_registration_default_role_0'];
		}

		if ( isset( $input['extra_emails_comma_separated_1'] ) ) {
			$sanitary_values['extra_emails_comma_separated_1'] = sanitize_text_field( $input['extra_emails_comma_separated_1'] );
		}

		if ( isset( $input['user_registration_page_2'] ) ) {
			$sanitary_values['user_registration_page_2'] = $input['user_registration_page_2'];
		}

		if ( isset( $input['enable_a_blank_design_3'] ) ) {
			$sanitary_values['enable_a_blank_design_3'] = $input['enable_a_blank_design_3'];
		}
		
			if ( isset( $input['psw_google_client_id'] ) ) {
			$sanitary_values['psw_google_client_id'] = $input['psw_google_client_id'];
		}
		
		
				if ( isset( $input['psw_google_client_secret'] ) ) {
			$sanitary_values['psw_google_client_secret'] = $input['psw_google_client_secret'];
		}
		
				if ( isset( $input['psw_facebook_client_id'] ) ) {
			$sanitary_values['psw_facebook_client_id'] = $input['psw_facebook_client_id'];
		}


		if ( isset( $input['psw_facebook_client_secret'] ) ) {
			$sanitary_values['psw_facebook_client_secret'] = $input['psw_facebook_client_secret'];
		}


		return $sanitary_values;
	}

	public function psw_general_features_section_info() {
		
	}

	public function user_registration_default_role_0_callback() {
		?> <select name="psw_general_features_option_name[user_registration_default_role_0]" id="user_registration_default_role_0">
			<?php $selected = (isset( $this->psw_general_features_options['user_registration_default_role_0'] ) && $this->psw_general_features_options['user_registration_default_role_0'] === 'subscriber') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>subscriber</option>
			<?php $selected = (isset( $this->psw_general_features_options['user_registration_default_role_0'] ) && $this->psw_general_features_options['user_registration_default_role_0'] === 'editor') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>editor</option>
			<?php $selected = (isset( $this->psw_general_features_options['user_registration_default_role_0'] ) && $this->psw_general_features_options['user_registration_default_role_0'] === 'author') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>author</option>
			<?php $selected = (isset( $this->psw_general_features_options['user_registration_default_role_0'] ) && $this->psw_general_features_options['user_registration_default_role_0'] === 'administrator') ? 'selected' : '' ; ?>
			<option <?php echo $selected; ?>>administrator</option>
		</select> <?php
	}

	public function extra_emails_comma_separated_1_callback() {
		printf(
			'<input class="regular-text" type="text" name="psw_general_features_option_name[extra_emails_comma_separated_1]" id="extra_emails_comma_separated_1" value="%s">',
			isset( $this->psw_general_features_options['extra_emails_comma_separated_1'] ) ? esc_attr( $this->psw_general_features_options['extra_emails_comma_separated_1']) : ''
		);
	}


  public function psw_google_client_id() {
		printf(
			'<input class="regular-text" type="password" name="psw_general_features_option_name[psw_google_client_id]" id="psw_google_client_id" value="%s">',
			isset( $this->psw_general_features_options['psw_google_client_id'] ) ? esc_attr( $this->psw_general_features_options['psw_google_client_id']) : ''
		);
	}
	
	
	   public function psw_google_client_secret() {
		printf(
			'<input class="regular-text" type="password" name="psw_general_features_option_name[psw_google_client_secret]" id="psw_google_client_secret" value="%s">',
			isset( $this->psw_general_features_options['psw_google_client_secret'] ) ? esc_attr( $this->psw_general_features_options['psw_google_client_secret']) : ''
		);
	}
	
		public function psw_facebook_client_id() {
			printf(
				'<input class="regular-text" type="password" name="psw_general_features_option_name[psw_facebook_client_id]" id="psw_facebook_client_id" value="%s">',
				isset( $this->psw_general_features_options['psw_facebook_client_id'] ) ? esc_attr( $this->psw_general_features_options['psw_facebook_client_id']) : ''
			);
		}
		
		
		   public function psw_facebook_client_secret() {
			printf(
				'<input class="regular-text" type="password" name="psw_general_features_option_name[psw_facebook_client_secret]" id="psw_facebook_client_secret" value="%s">',
				isset( $this->psw_general_features_options['psw_facebook_client_secret'] ) ? esc_attr( $this->psw_general_features_options['psw_facebook_client_secret']) : ''
			);
		}
		
		
	public function user_registration_page_2_callback() {
	    
	    $mypages = get_pages( array('sort_column' => 'post_date', 'sort_order' => 'desc' ) );
 

		?> <select name="psw_general_features_option_name[user_registration_page_2]" id="user_registration_page_2">
		    	<option>Select an option</option>
		   <?php 
		   foreach( $mypages as $page ) {
		       if($this->psw_general_features_options['user_registration_page_2'] == $page->ID ) {
		            $selected = 'selected';
		       } else {
		           $selected = '';
		       }
		       ?>
		       <option value="<?php echo $page->ID; ?>" <?php echo $selected; ?>><?php echo $page->post_title; ?></option>
		       <?php
		   }
		      ?>
		</select> <?php
	}

	public function enable_a_blank_design_3_callback() {
		?> <fieldset><?php $checked = ( isset( $this->psw_general_features_options['enable_a_blank_design_3'] ) && $this->psw_general_features_options['enable_a_blank_design_3'] === 'no' ) ? 'checked' : '' ; ?>
		<label for="enable_a_blank_design_3-0"><input type="radio" name="psw_general_features_option_name[enable_a_blank_design_3]" id="enable_a_blank_design_3-0" value="no" <?php echo $checked; ?>> no</label><br>
		<?php $checked = ( isset( $this->psw_general_features_options['enable_a_blank_design_3'] ) && $this->psw_general_features_options['enable_a_blank_design_3'] === 'yes' ) ? 'checked' : '' ; ?>
		<label for="enable_a_blank_design_3-1"><input type="radio" name="psw_general_features_option_name[enable_a_blank_design_3]" id="enable_a_blank_design_3-1" value="yes" <?php echo $checked; ?>> yes</label><br>
		</fieldset> <?php
	}

}
if ( is_admin() )
	$psw_general_features = new PSWGeneralFeatures();

/* 
 * Retrieve this value with:
 * $psw_general_features_options = get_option( 'psw_general_features_option_name' ); // Array of All Options
 * $user_registration_default_role_0 = $psw_general_features_options['user_registration_default_role_0']; // User registration default role
 * $extra_emails_comma_separated_1 = $psw_general_features_options['extra_emails_comma_separated_1']; // Extra emails (comma separated)
 * $user_registration_page_2 = $psw_general_features_options['user_registration_page_2']; // user registration page
 * $enable_a_blank_design_3 = $psw_general_features_options['enable_a_blank_design_3']; // Enable a blank design
 */