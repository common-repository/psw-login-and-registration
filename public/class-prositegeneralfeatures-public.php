<?php
use Facebook\Facebook;
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.prositeweb.ca/
 * @since      1.0.0
 *
 * @package    Prositegeneralfeatures
 * @subpackage Prositegeneralfeatures/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Prositegeneralfeatures
 * @subpackage Prositegeneralfeatures/public
 * @author     Prositeweb Inc. <contact@prositeweb.ca>
 */
class Prositegeneralfeatures_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	
	private $facebook_app_id;
	
	private $facebook_app_secret; 
	private $facebook_oauth_version; 

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
        $psw_general_features_options = get_option( 'psw_general_features_option_name' );
			$psw_facebook_client_id = isset($psw_general_features_options['psw_facebook_client_id']) ? $psw_general_features_options['psw_facebook_client_id'] : ''; 
			 $psw_facebook_client_secret = isset($psw_general_features_options['psw_facebook_client_secret']) ? $psw_general_features_options['psw_facebook_client_secret'] : ''; 
			 if(empty($psw_facebook_client_id)) {
			  $psw_facebook_client_id = ""; 
			 }
			 
			 if(empty($psw_facebook_client_secret)) {
			     $psw_facebook_client_secret = "";
			 }
			 
			 
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->facebook_app_id = $psw_facebook_client_id;
		$this->facebook_app_secret = $psw_facebook_client_secret;
		$this->facebook_oauth_version = 'v21.0';
		

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Prositegeneralfeatures_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Prositegeneralfeatures_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
       if(!is_user_logged_in()) {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/prositegeneralfeatures-public.css', array(), $this->version, 'all' );
}
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Prositegeneralfeatures_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Prositegeneralfeatures_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
if(!is_user_logged_in()) {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/prositegeneralfeatures-public.js', array( 'jquery' ),filemtime(plugin_dir_path( __FILE__ ).'js/prositegeneralfeatures-public.js'), true );
}
	}
	public function check_post($key) {
    $valeur = ""; 
     if(isset($_POST) && array_key_exists($key, $_POST))  {
         $valeur = $_POST[$key];
     }
     return  $valeur; 
}

public function psw_get_facebook_client() {
$facebook_app_id = $this->facebook_app_id; 
$facebook_app_secret = $this->facebook_app_secret; 
if(empty($facebook_app_id) || empty($facebook_app_secret)) {
    return null; 
}
    $fb = new Facebook([
        'app_id' => $facebook_app_id,
        'app_secret' => $facebook_app_secret,
        'default_graph_version' => $this->facebook_oauth_version,
    ]);

    return $fb;
}

public  function psw_facebook_login_url() {
    // Initialize the Facebook client
    $fb = $this->psw_get_facebook_client();
    
    if(empty($fb)) {
        return ''; 
    }
    $helper = $fb->getRedirectLoginHelper();
    $permissions = ['email']; // Specify the data you want to access

    // Define the callback URL
    $callbackUrl = htmlspecialchars(home_url('/pswfbcallback/'));

    // Validate that the helper object and Facebook client are correctly set up
    if (empty($fb) || empty($helper)) {
        error_log("Facebook client or helper could not be initialized.");
        return '';  // Return a fallback URL or display an error message to the user
    }

    try {
        $loginUrl = $helper->getLoginUrl($callbackUrl, $permissions);

        // Verify that a valid URL is generated
        if (filter_var($loginUrl, FILTER_VALIDATE_URL)) {
            return $loginUrl;
        } else {
            error_log("Failed to generate a valid Facebook login URL.");
            return '';  // Fallback URL if the generated URL is invalid
        }
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        // Handle exceptions related to the Facebook SDK
        error_log("Facebook SDK returned an error: " . $e->getMessage());
        return '';  // Fallback URL in case of an SDK error
    }
}

public function psw_handle_facebook_callback() {
    // Get the full URL and parse query parameters
    $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $query_string = parse_url($actual_link, PHP_URL_QUERY);
    parse_str($query_string, $query_params);

    // Check if the code parameter exists
    if (!isset($query_params["code"])) {
        echo "Authorization code is missing.";
        return;
    }

    // Set up parameters for access token request
    $params = [
        'client_id' => $this->facebook_app_id,
        'client_secret' => $this->facebook_app_secret,
        'redirect_uri' => htmlspecialchars(home_url('/pswfbcallback/')),
        'code' => $query_params["code"]
    ];

    // Exchange the authorization code for an access token
    $token_url = 'https://graph.facebook.com/' . $this->facebook_oauth_version . '/oauth/access_token';
    $response = wp_remote_post($token_url, [
        'body' => $params
    ]);

    // Check for WP errors
    if (is_wp_error($response)) {
        echo 'Failed to retrieve access token: ' . $response->get_error_message();
        return;
    }

    // Decode the response to get the access token
    $body = wp_remote_retrieve_body($response);
    $response_data = json_decode($body, true);

    // Check for a valid access token in the response
    if (isset($response_data['access_token']) && !empty($response_data['access_token'])) {
        $access_token = $response_data['access_token'];

        // Retrieve user profile information with the access token
        $profile_url = 'https://graph.facebook.com/' . $this->facebook_oauth_version . '/me?fields=id,name,email,picture&access_token=' . $access_token;
        $profile_response = wp_remote_get($profile_url);

        // Check for WP errors in the profile request
        if (is_wp_error($profile_response)) {
            echo 'Failed to retrieve user profile: ' . $profile_response->get_error_message();
            return;
        }

        // Decode the response to get the user profile
        $profile_body = wp_remote_retrieve_body($profile_response);
        $profile = json_decode($profile_body, true);

        // Check if the user data includes an email
        if (isset($profile['email'])) {
            $email = $profile['email'];
            $name = $profile['name'];
            $picture_url = $profile['picture']['data']['url'];

            // Authenticate or register the user
            if (email_exists($email)) {
                // Log in the existing user
                $user = get_user_by('email', $email);
                wp_set_auth_cookie($user->ID);
                wp_set_current_user($user->ID);
                wp_redirect(home_url()); // Redirect after login
                exit;
            } else {
                // Register a new user
                $random_password = wp_generate_password(12, false);
                $user_id = wp_create_user($email, $random_password, $email);

                if (!is_wp_error($user_id)) {
                    $user = new WP_User($user_id);
                    $user->set_role('subscriber');

                    // Set user display name and other metadata
                    wp_update_user([
                        'ID' => $user_id,
                        'display_name' => $name
                    ]);

                    update_user_meta($user_id, 'profile_picture', $picture_url);

                    // Send welcome email with login password
                    wp_mail($email, 'Welcome to ' . get_bloginfo('name'), 'Your account has been created. You can log in with the following password: ' . $random_password);

                    // Log in the new user
                    wp_set_auth_cookie($user->ID);
                    wp_set_current_user($user->ID);
                    wp_redirect(home_url()); // Redirect after registration
                    exit;
                } else {
                    echo 'User registration failed.';
                }
            }
        } else {
            echo 'Failed to retrieve email from Facebook.';
        }
    } else {
        echo 'Failed to retrieve access token from Facebook.';
    }
}


public function login($nonce, $email, $password) {
	    if($nonce === 1) {
	  if(is_email($email))    { 
    $user = get_user_by('email', sanitize_email($email));
	  } else {
	     $user = get_user_by('login', sanitize_text_field($email));  
	  }
    if ($user) {
        
         $register_with_psw_form = get_user_meta($user->ID, "register_with_psw_form", true); 
    if(strcmp($register_with_psw_form, 'yes') === 0) {
       $psw_account_status = get_user_meta($user->ID,  'psw_account_status', true); 
       if(strcmp($psw_account_status, 1) === 0) {
           if ( $user && wp_check_password($password, $user->data->user_pass, $user->ID ) ) {
    wp_set_auth_cookie( $user->ID, 1, is_ssl() );
} else {
     echo esc_attr("wrong");
      
}
       } else {
 echo esc_attr("inactive");
    }
    }  else {
        
           if ( $user && wp_check_password($password, $user->data->user_pass, $user->ID ) ) {
    wp_set_auth_cookie( $user->ID, 1, is_ssl() );
} else {
     echo esc_attr("wrong");
      
}
}
    } else {
        echo esc_attr("wrong");
    }
	    }
	}
public function forget($nonce, $token, $email) {
	   if($nonce === 1 && (!isset($token) || empty($token))) {
   $user = get_user_by('email', sanitize_email($email));
    if ($user) {
$email = sanitize_email($email); 
  $to = $email;
  $key = rand(4000,9999);
$subject = get_bloginfo( 'name' ).esc_html__(" account password reset", 'prositegeneralfeatures');
$body = get_bloginfo( 'name' ).esc_html__(" account", 'prositegeneralfeatures')."
<h3>".esc_html__(" Password reset code", 'prositegeneralfeatures')."</h3>".esc_html__(" Please use this code to reset the password for the", 'prositegeneralfeatures').get_bloginfo( 'name' ).esc_html__(" account ", 'prositegeneralfeatures').esc_attr($email)."<br/><br/>."
.esc_html__("Here is your code:", 'prositegeneralfeatures')." <h3>".esc_attr($key)."<h3><br/><br/>
"
.esc_html__("If you don't recognise the ", 'prositegeneralfeatures').get_bloginfo( 'name' )." account ".esc_attr($email).esc_html__(", you can ignore the email or reach out to us from our website ", 'prositegeneralfeatures').home_url()."<br/><br/>".esc_html__("Thanks", 'prositegeneralfeatures').",<br/><br/>
".get_bloginfo( 'name' ).esc_html__(" account team", 'prositegeneralfeatures');
$headers = array('Content-Type: text/html; charset=UTF-8');
 
wp_mail( $to, $subject, $body, $headers );
update_user_meta($user->ID, 'website_security_token', $key);
update_user_meta($user->ID, 'website_security_token_time', date("l jS \of F Y h:i:s A"));
    } else {
        echo esc_html__("If there is an account associated to ", 'prositegeneralfeatures').esc_attr($email).esc_html__(", you will received an instruction to reset your password by email", 'prositegeneralfeatures');
    }
}elseif($nonce === 1 && isset($token) && !empty($token)) {
   $user = get_user_by('email', sanitize_email($email));
   $token  = sanitize_text_field($token);
    if ($user) {
$tokens  = get_user_meta( $user->ID, 'website_security_token' , true );
$date = get_user_meta( $user->ID, 'website_security_token_time' , true );
if($token == $tokens) {
    echo '<label class="ErrorMsg">', esc_html__("Please type your new password", 'prositegeneralfeatures'),'</label><input type="hidden" name="token_validation" value="'.esc_attr($token).'" ><input type="password" class="client-info" name="new_password" placeholder="', esc_html__("Enter your new password", 'prositegeneralfeatures'), '" id="the_password" required/><input type="password" class="client-info" name="new_password_validation" placeholder="',esc_html__("Re-enter your new password", 'prositegeneralfeatures'), '" id="the_password_2" required/>';
}
    }
} 
	}
public function validation($nonce, $token, $email, $password) {
    if($nonce === 1 && isset($token) && !empty($token)) {
  $token  = sanitize_text_field($token);  
    $user = get_user_by('email', sanitize_email($email));
    if ($user) {
    $tokens  = get_user_meta( $user->ID, 'website_security_token' , true );
$date = get_user_meta( $user->ID, 'website_security_token_time' , true );
if($token == $tokens && !empty($password)) {
    wp_set_password( $password, $user->ID);
    update_user_meta($user->ID, 'psw_account_status', 1); 
    ?>
<p class="ErrorMsg"><?php _e("We have reset your password, you can now log in", 'prositegeneralfeatures'); ?></p>
    <?php
}
}
}
}

public function token_validation() {
    if(isset($_GET) && isset($_GET["token"]) && !empty($_GET["token"]) && isset($_GET["user_id"]) && !empty($_GET["user_id"])  && isset($_GET["pageid"]) && !empty($_GET["pageid"]) && !is_user_logged_in()) { 
    $token = sanitize_key($_GET["token"]); 
    $user_id = sanitize_title($_GET["user_id"]); 
    $pageid = sanitize_title($_GET["pageid"]);
    if(is_numeric($user_id)) {
    /* Check if register with psw form */ 
    $register_with_psw_form = get_user_meta( $user_id, "register_with_psw_form", true); 
    if(strcmp($register_with_psw_form, 'yes') === 0) {
       $check_token = get_user_meta( $user_id,  'psw_validation_token', true); 
       if(strcmp($check_token, $token) === 0) {
           update_user_meta( $user_id, 'psw_account_status', 1); 
           $url  = get_permalink($_GET["pageid"])."?psw_account_status=active";
           wp_redirect( $url );
exit;
       } else {
$url  = get_permalink($_GET["pageid"]);
wp_redirect( $url );
exit;
    }
    } 
    } else {
$url  = get_permalink($_GET["pageid"]);
wp_redirect( $url );
exit;
    }
    }
    
}

public function register_user_front_end() {
	  $new_user_name = sanitize_text_field($this->check_post('new_user_name'));
	  $new_user_email = sanitize_email($this->check_post('new_user_email'));
	  $first_name = sanitize_text_field($this->check_post('first_name'));
	  $last_name = sanitize_text_field($this->check_post('last_name'));

$new_user_password = 	$this->check_post('new_user_password');
$role = "subscriber";
 $admin_email = get_option( 'admin_email' );
	      $psw_general_features_options = get_option( 'psw_general_features_option_name' );
	      if(!empty($psw_general_features_options) && is_array($psw_general_features_options)) {
	          $user_registration_default_role_0 = $psw_general_features_options['user_registration_default_role_0'] ?: "subscriber";
	        $role =    $user_registration_default_role_0;
	      $extra_emails_comma_separated_1 = $psw_general_features_options['extra_emails_comma_separated_1'];
	       $extra_emails_comma_separated_1 = str_replace(" ", "", $extra_emails_comma_separated_1);
	     if(!empty($extra_emails_comma_separated_1)) {
	         $emails = explode(",", $extra_emails_comma_separated_1);
	     }
	      $user_registration_page_2 = $psw_general_features_options['user_registration_page_2'] ?: get_option('page_on_front');
	      }
	  $user_nice_name = sanitize_email(strtolower($this->check_post('new_user_email')));
	  if(!username_exists($new_user_name) && !email_exists($new_user_email)) {
	  $user_data = array(
	      'user_login' => $new_user_name,
	      'user_email' => $new_user_email,
	      'user_pass' => $new_user_password,
	      'user_nicename' => $first_name." ".$last_name,
	      'display_name' =>  $first_name." ".$last_name,
	      'first_name' =>  $first_name,
	      'last_name' => $last_name,
	      'role' => $role
	  	);
	  $user_id = wp_insert_user($user_data);
	  	if (!is_wp_error($user_id)) {
	  	    
	  	   $user_id;
$accont_status = 0;
$str = $first_name." ".$last_name;
$validation_token = strtolower(md5($str).uniqid());
add_user_meta( $user_id, 'psw_account_status', $accont_status); 
add_user_meta( $user_id, 'psw_validation_token', $validation_token); 
add_user_meta( $user_id, 'register_with_psw_form', "yes"); 
echo'<h4>', esc_html__('Hello ', 'prositegeneralfeatures'), esc_attr($first_name)." ".esc_attr($last_name),  '</h4>', '<p>', esc_html__('Thanks for creating an account on our website. Please check your email for activation link. If you  can not see the email in the inbox folder, you may have to check the spam folder.', 'prositegeneralfeatures'), '</p>'
	      ;
echo esc_attr('2022');
	     
	      if(!empty($admin_email)) {
	   $admin = $admin_email; 
	      }
	      $to = $new_user_email;
	  
$subject = esc_html__('Welcome to ', 'prositegeneralfeatures') .home_url().esc_html__('. And the Password to login', 'prositegeneralfeatures') ;
$body = '<h3>'.esc_html__('Hi  ', 'prositegeneralfeatures').$new_user_name.'</h3>';
 $body .= '<p>'.esc_html__('Thank you for creating an account on ', 'prositegeneralfeatures').home_url().'</p>';
$body .= '<p>'.esc_html__('Please click on the link ', 'prositegeneralfeatures') .'<a href="'.get_permalink($user_registration_page_2)."?token=".$validation_token.'&user_id='.$user_id.'&pageid='.$user_registration_page_2.'">'.get_permalink($user_registration_page_2).'</a>'.esc_html__(' to activate your account', 'prositegeneralfeatures') .'</p>';
$body .= '<br/><br/>';
$body .= get_bloginfo( 'name' ).esc_html__(' Team', 'prositegeneralfeatures');
$headers = array('Content-Type: text/html; charset=UTF-8');
 
   $message = '<p>'.esc_html__('A new user just created an account on ', 'prositegeneralfeatures').home_url().esc_html__(' website ', 'prositegeneralfeatures').'</p> <p>'.esc_html__('See details below ', 'prositegeneralfeatures').'</p><hr/>';
   $message .= esc_html__('username ', 'prositegeneralfeatures')." = ".$new_user_name."<br/>";
    $message .= esc_html__('email ', 'prositegeneralfeatures')." = ".$new_user_email."<br/>";
wp_mail( $to, $subject, $body, $headers );
if(isset($emails) && !empty($emails)) {
    foreach($emails as $email) {
        if(is_email($email)) {
$headers[] = 'Cc: '.$email;
}
}
}
wp_mail( $admin, $subject, $message, $headers );
	  	} else {
	  	   
	    	if (isset($user_id->errors['empty_user_login'])) {
	          $notice_key =  esc_html__('User Name and Email are mandatory', 'prositegeneralfeatures');
	          echo esc_attr($notice_key);
	      	} elseif (isset($user_id->errors['existing_user_login'])) {
	          echo  esc_html__('User name already exixts.', 'prositegeneralfeatures');
	      	} else {
	          echo esc_html__('Error Occured please fill up the sign up form carefully.', 'prositegeneralfeatures');
	      	}
	  	}
	  } else {
	       echo '<h3 class="text-danger">', esc_html__('Your username or email already exists', 'prositegeneralfeatures'), '</h3>';
	  }
	die;
}

 public function customer_registration() {
    
	$pswloginform = sanitize_key($this->check_post('pswloginform'));
	$pswforgetform = sanitize_key($this->check_post('pswforgetform'));
	
	if(is_email($this->check_post('your_email_address')))    { 
    $your_email_address = sanitize_email($this->check_post('your_email_address'));
	  } else {
	      $your_email_address = sanitize_text_field($this->check_post('your_email_address'));
	  }
	  
	  
	
	$token_validation = sanitize_text_field($this->check_post('token_validation'));
	$password = $this->check_post('your_password'); 
$verify = wp_verify_nonce( $pswloginform, 'ajax-login-nonce' );
$forget = wp_verify_nonce( $pswforgetform, 'ajax-login-nonce' );
$this->login($verify, $your_email_address, $password); 
if(!isset($token_validation) || empty($token_validation)) {
$this->forget($forget, sanitize_text_field($this->check_post('token')), $your_email_address);
} else {
$new_password = $this->check_post('new_password');
$this->validation($forget, $token_validation, $your_email_address, $new_password);
}
  exit;   
}

		public function overwrite_the_content($content ) {
		    global $post;
   $psw_general_features_options = get_option( 'psw_general_features_option_name' );
   $user_registration_page_2 = "";
    if(!empty($psw_general_features_options) && is_array($psw_general_features_options)) {
	      $user_registration_page_2 = $psw_general_features_options['user_registration_page_2'];
	      }
   
if(is_singular() && !empty($user_registration_page_2) && $post->ID == $user_registration_page_2 && !is_user_logged_in()) {
$content = "[psw_registration]";
}
     return $content;


	}

public function psw_get_google_client() {
     $psw_general_features_options = get_option( 'psw_general_features_option_name' );
     $psw_google_client_id = isset($psw_general_features_options['psw_google_client_id']) ? $psw_general_features_options['psw_google_client_id'] : ''; 
      $psw_google_client_secret = isset($psw_general_features_options['psw_google_client_secret']) ? $psw_general_features_options['psw_google_client_secret'] : ''; 
      if(empty($psw_google_client_id) || empty($psw_google_client_secret)) {
          return ''; 
      }
    $client = new Google_Client();
    
  //  print_r($client);
    if(empty($client)) {
        return; 
    }
    $client->setClientId($psw_google_client_id);
    $client->setClientSecret($psw_google_client_secret);
    $client->setRedirectUri(home_url('/pswcallback/'));
    $client->addScope("email");
    $client->addScope("profile");
    return $client;
}

public function psw_handle_google_callback() {
// Log message to server logs
    echo __("Callback accessed", "prositegeneralfeatures");  // Simple output to confirm it's being accessed

    // Get the full URL
    $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    // Print the full URL for debugging
    print_r($actual_link);

    // Parse the URL to get the query string and manually extract parameters
    $query_string = parse_url($actual_link, PHP_URL_QUERY);
    parse_str($query_string, $query_params);

    // Check if the code parameter exists in the parsed query parameters
    if (isset($query_params["code"])) {
        $code = $query_params['code'];
        echo "Authorization code: " . $code;

        // Initialize the Google Client
        $client = $this->psw_get_google_client();

        // Fetch the access token using the authorization code
        $token = $client->fetchAccessTokenWithAuthCode($code);
        if (isset($token['error'])) {
            error_log("Token error: " . $token['error']);
            echo "Error retrieving token.";
            return;
        }

        $client->setAccessToken($token['access_token']);
        $google_service = new Google_Service_Oauth2($client);
        $data = $google_service->userinfo->get();

        // Extract the user's email, first name, and last name from Google data
        $email = sanitize_email($data->email);
        $first_name = sanitize_text_field($data->givenName);  // Get first name
        $last_name = sanitize_text_field($data->familyName);  // Get last name
        $full_name = $first_name . ' ' . $last_name;

        if (email_exists($email)) {
            // User exists, so log them in automatically
            $user = get_user_by('email', $email);
            wp_set_auth_cookie($user->ID);
            wp_set_current_user($user->ID);
            wp_redirect(home_url());  // Redirect to home page after login
            exit;
        } else {
            // User does not exist, so create a new user
            $random_password = wp_generate_password(12, false); // Generate a random password
            $user_id = wp_create_user($email, $random_password, $email);
            if (is_wp_error($user_id)) {
                echo "Failed to create user.";
                error_log("User creation failed: " . $user_id->get_error_message());
                return;
            }

            // Set user role to subscriber
            $user = new WP_User($user_id);
            $user->set_role('subscriber');

            // Update user meta information
            update_user_meta($user_id, 'first_name', $first_name);
            update_user_meta($user_id, 'last_name', $last_name);

            // Update display name to the full name
            wp_update_user(array(
                'ID' => $user_id,
                'display_name' => $full_name,
                'nickname' => $full_name
            ));

            // Send the random password to the user by email
            wp_mail($email, 'Welcome to ' . get_bloginfo('name'), 'Your account has been created. You can log in with the following password: ' . $random_password);

            // Log the user in automatically
            wp_set_auth_cookie($user->ID);
            wp_set_current_user($user->ID);
            wp_redirect(home_url());  // Redirect to home page after login
            exit;
        }

        // Log user data for debugging
        error_log("User data: " . print_r($data, true));
    } 
}

public  function psw_process_callback() {
    if (get_query_var('pswcallback')) {
        // Google OAuth callback processing code goes here
        $this->psw_handle_google_callback();
        exit;
    }
}

public  function psw_process_fb_callback() {
    if (get_query_var('pswfbcallback')) {
        // Facebook OAuth callback processing code goes here
       $this->psw_handle_facebook_callback();
        exit;
    }
}




public	function custom_login(){
 global $pagenow;
  $psw_general_features_options = get_option( 'psw_general_features_option_name' );
   $redirect_custom_page = "";
   $user_registration_page_2 = "";
    if(!empty($psw_general_features_options) && is_array($psw_general_features_options)) {
	  $redirect_custom_page = $psw_general_features_options['enable_a_blank_design_3'];
	  $user_registration_page_2 = $psw_general_features_options['user_registration_page_2'];
	      }
 if(strpos($pagenow, 'wp-login.php') !== false  && !is_user_logged_in() && $redirect_custom_page == 'yes' && is_numeric($user_registration_page_2) && !empty(get_post($user_registration_page_2))) {
  wp_redirect(get_permalink($user_registration_page_2));
  exit();
 }
}
/**
* Add page templates.
*
* @param  array  $templates  The list of page templates
*
* @return array  $templates  The modified list of page templates
*/
public function sf_add_page_template_to_dropdown( $templates )
{
   $templates[plugin_dir_path( __FILE__ ) . 'templates/page-template.php'] = __( 'PSW registration template', 'prositegeneralfeatures' );

   return $templates;
}

/**
 * Change the page template to the selected template on the dropdown
 * 
 * @param $template
 *
 * @return mixed
 */
function pt_change_page_template($template)
{
    if (is_page()) {
        $meta = get_post_meta(get_the_ID());

        if (!empty($meta['_wp_page_template'][0]) && $meta['_wp_page_template'][0] != $template) {
            $template = $meta['_wp_page_template'][0];
        }
    }

    return $template;
}

		public function registration_forms() {
	    ob_start();
 require plugin_dir_path( __FILE__ ) . 'partials/registration_form.php';
	     return ob_get_clean();
	    
	}
		public function register_shortcodes() {
  add_shortcode( 'psw_registration', array( $this, 'registration_forms') );
  add_action('wp_ajax_psw_registration', array( $this,'customer_registration'));
add_action('wp_ajax_nopriv_psw_registration', array( $this,'customer_registration'));

 add_action('wp_ajax_register_user_front_end', array( $this,'register_user_front_end'), 0);
add_action('wp_ajax_nopriv_register_user_front_end', array($this,'register_user_front_end'));
add_filter('the_content', array( $this, 'overwrite_the_content'), 10, 1 );

}



}
