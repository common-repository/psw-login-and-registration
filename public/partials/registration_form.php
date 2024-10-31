<?php 
if(!is_user_logged_in()) {
$js_variables = array(
esc_html__('Please enter a valid email address or username', 'prositegeneralfeatures'), 
esc_html__('Please enter a valid password', 'prositegeneralfeatures'),
esc_html__('Wrong email or password', 'prositegeneralfeatures'),
esc_html__('Your account is not active. Please check your email to validate your account. If you can not find the email, please click on the reset link to reset your password.', 'prositegeneralfeatures'),
esc_html__("The two passwords are not the same", 'prositegeneralfeatures'),
esc_html__('Please enter a valid email address', 'prositegeneralfeatures'),
esc_html__("Security token", 'prositegeneralfeatures'),
esc_html__("Please check your email address for the security token", 'prositegeneralfeatures'),
esc_html__("Update", 'prositegeneralfeatures'),
esc_html__("Please enter a username", 'prositegeneralfeatures'),
esc_html__("Please type your first name", 'prositegeneralfeatures'),
esc_html__("Please type your last name", 'prositegeneralfeatures'),
esc_html__("Please type your password", 'prositegeneralfeatures'),
esc_html__("Your passwords do not match", 'prositegeneralfeatures'),
esc_html__("Please type a valid email address", 'prositegeneralfeatures')
); 

$new = json_encode($js_variables); 
$token = "dddd.";
?>
<div class="prositeweb_registration">
    <div id="content-wrapper" data-variables='<?php echo esc_html($new); ?>'>
<div class="tab-container">
   <div  class="tab tab-active" data-id="tab1">
       <?php 
       require plugin_dir_path( __FILE__ ) . 'part/login.php';
       ?>
   </div><!--end of tab one--> 

   <div  class="tab " data-id="tab2">
        <?php 
       require plugin_dir_path( __FILE__ ) . 'part/register.php';
       ?>
   </div><!--end of tab two--> 
      <div  class="tab " data-id="tab3">
      <?php 
       require plugin_dir_path( __FILE__ ) . 'part/forget.php';
       ?>
   </div><!--end of tab three--> 
</div><!--end of container-->

<?php 
$client = $this->psw_get_google_client();

if (!empty($client) && is_object($client) && method_exists($client, 'createAuthUrl')) {
    $login_url = $client->createAuthUrl(). '&platform=google';

    echo '<a href="' . esc_url($login_url) . '" class="btn-social btn-google">
            <img src="' . plugin_dir_url(__FILE__) . 'img/g_icon.png" alt="Google Icon">'.__("Sign in with Google", "prositegeneralfeatures").'
          </a>';
}

// Output the Facebook login button
$fb_login_url = $this->psw_facebook_login_url();
if(!empty($fb_login_url)) {
    
  $fb_login_url =  $fb_login_url . '&platform=facebook';
echo '<a href="' . esc_url($fb_login_url) . '" class="btn-social btn-facebook">
        <img src="' . plugin_dir_url(__FILE__) . 'img/fb.webp" alt="Facebook Icon">'.__("Sign in with Facebook", "prositegeneralfeatures").'
      </a>';
}
?>
                                        
	</div>
</div>
<!-- partial -->
<?php 
}
?>