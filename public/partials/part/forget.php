   <div id="passwError" class="ErrorMsg"></div>
   <div class="wrongcomb ErrorMsg"></div>
<form id="pswresetform" method="POST" action="<?php echo htmlspecialchars(admin_url('admin-ajax.php')); ?>">
    <h2><?php _e("Reset password", 'prositegeneralfeatures'); ?></h2>
    <div id="emailErrorc" class="ErrorMsg"></div>
          <input type="email" class="client-info" placeholder="<?php _e("Your Email address", 'prositegeneralfeatures'); ?>" name="your_email_address" id="youremail_address">
          <div id="pswtoken" class="ErrorMsg"></div>
           <p class="show_passwords">
		<input type="checkbox" class="toggle-password"> <?php _e('Show Password ', 'prositegeneralfeatures'); ?>
		</p>
	<a href="#" class="tab-a active-a" data-id="tab1"><?php _e("Go back to log in", 'prositegeneralfeatures'); ?></a>	
		<input type="hidden" name="action" value="psw_registration">
		 <?php wp_nonce_field( 'ajax-login-nonce', 'pswforgetform' ); ?>
		<button class="signin-button" id="restbtn"><?php _e('Reset', 'prositegeneralfeatures'); ?></button>    
		
				<?php 
if ( get_option( 'users_can_register' ) ) {
?>
       <a href="#" class="tab-a" data-id="tab2"><?php _e("I don't have an account", 'prositegeneralfeatures'); ?></a>  
<?php 
}
?>
</form>