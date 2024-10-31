<?php 
if ( get_option( 'users_can_register' ) ) {
    $nonce = wp_create_nonce( 'pswregistration' );
?>
          <h2><?php _e("Create an account", 'prositegeneralfeatures'); ?></h2>
                        <div class="text-center">
 <p class="register-message ErrorMsg" style="display:none" ></p>
 </div>
    <form action="<?php echo htmlspecialchars(admin_url('admin-ajax.php')); ?>" method="POST" name="register-form" class="register-form signup-form" id="registrationform">
      <fieldset> 
                <div class="form-group">
                    <div id="registration_firstname_error" class="ErrorMsg"></div>
          <input type="text"  name="first_name" placeholder="<?php _e("First Name", 'prositegeneralfeatures'); ?>" id="first_name" class="client-info" autocomplete="firstname">
          </div>
             <div class="form-group">
                  <div id="registration_lastname_error" class="ErrorMsg"></div>
          <input type="text"  name="last_name" placeholder="<?php _e("Last Name", 'prositegeneralfeatures'); ?>" id="last_name" class="client-info" autocomplete="lastname">
          </div>
          
             <div class="form-group">
                 <div id="registration_username_error" class="ErrorMsg"></div>
          <input type="text"  name="new_user_name" placeholder="<?php _e("Username", 'prositegeneralfeatures'); ?>" id="new_username" class="client-info" autocomplete="username">
          </div>

                            <div class="form-group">
                                <div id="registration_email_error" class="ErrorMsg"></div>
<input type="email"  name="new_user_email" placeholder="<?php _e("Email address", 'prositegeneralfeatures'); ?>" id="new_useremail" class="client-info" autocomplete="email">
           </div>
                    <div class="form-group">
                        <div id="registration_password_error" class="ErrorMsg"></div>
<input type="password"  name="new_user_password" placeholder="<?php _e("Enter your password", 'prositegeneralfeatures'); ?>" id="new_password" class="client-info" autocomplete="current-password">
           </div>
                <div class="form-group">
                    <div id="registration_password_error_validation" class="ErrorMsg"></div>
<input type="password"  name="new_user_password_confirmation" placeholder="<?php _e("Confirm your password", 'prositegeneralfeatures'); ?>" id="new_password_confirmation" class="client-info" autocomplete="current-password-validation">
           </div>
           <input type="hidden" name="action" value="register_user_front_end" />
          <input type="hidden" name="psw_form" value="<?php echo $nonce ?>">
           <p>
		<input type="checkbox" class="toggle-password"> <?php _e('Show Password ', 'prositegeneralfeatures'); ?>
		</p>
           <a href="#" class="tab-a active-a" data-id="tab1"><?php _e("I already have an account", 'prositegeneralfeatures'); ?></a>
                        <div class="signup-btn text-center">
          <input type="submit"  class="signin-button loginform"  id="register-button" value="<?php _e("Register", 'prositegeneralfeatures'); ?>" >
           </div>
      </fieldset>
    </form> 
    
<?php 
} else {
    ?>
    <h3><?php _e("Registration is disabled", 'prositegeneralfeatures'); ?></h3>
    <?php 
}
?>