<?php 
if(isset($_GET['psw_account_status']) && !empty($_GET['psw_account_status']) && strcmp($_GET['psw_account_status'], "active") === 0) {
    ?>
     <div id="generalError" class="ErrorMsg"><?php _e("Your account is activated", 'prositegeneralfeatures'); ?></div>
    <?php
} else {
        ?>
     <div id="generalError" class="ErrorMsg"></div>
    <?php
}
$post = get_queried_object(); 
$unique = uniqid().'ddd';
?>

<form id="pswlogform" method="POST" action="<?php echo htmlspecialchars(admin_url('admin-ajax.php')); ?>">
<h2><?php _e("Log in", 'prositegeneralfeatures'); ?></h2>
<div id="emailError" class="ErrorMsg"></div>
        <input type="text" name="your_email_address" id="your_email_address" class="client-info" placeholder="<?php _e("Your Email address or username", 'prositegeneralfeatures'); ?>" autocomplete="username">
        <div id="passwordError" class="ErrorMsg"></div>
		<input type="password" name="your_password" id="your_password" class="client-info" placeholder="<?php _e("Your password", 'prositegeneralfeatures'); ?>" autocomplete="current-password">
		<input type="hidden" name="current_page" id="current_page" value="<?php echo esc_url(get_permalink($post->ID)).'?auth='.$unique; ?>" autocomplete="current-password">

		<p>
		<input type="checkbox" class="toggle-password"> <?php _e('Show Password ', 'prositegeneralfeatures'); ?>
		</p>
		<input type="hidden" name="action" value="psw_registration">
		<a href="#" class="tab-a" data-id="tab3"><?php _e('Recovery password', 'prositegeneralfeatures'); ?></a>
		 <?php wp_nonce_field( 'ajax-login-nonce', 'pswloginform' ); ?>
		<button class="signin-button" type="submit"><?php _e('Log in', 'prositegeneralfeatures'); ?></button>
		<?php 
if ( get_option( 'users_can_register' ) ) {
?>
       <a href="#" class="tab-a" data-id="tab2"><?php _e("I don't have an account", 'prositegeneralfeatures'); ?></a>  
<?php 
}
?>
</form>