=== PSW Front-end Login & Registration ===
Contributors: empoweringprowebsite, Prositeweb
Donate link: https://www.prositeweb.ca/
Tags: login, registration, front-end login, user registration, custom login, secure login
Requires at least: 4.0.1
Tested up to: 6.6.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A WordPress plugin to create customizable login and registration forms on any page of your website, with added security and custom redirect options.

== Description ==

**We added a new feature for Facebook and Google Log in - Check the documentation for more details**

PSW Front-end Login & Registration plugin allows you to seamlessly create and manage login and registration forms on your website, directing users to specific pages for these actions. By redirecting from the standard `wp-admin` or `wp-login.php` URLs, you improve your site’s security by reducing exposure to common cyberattacks targeting these login points.

This plugin also includes options to disable the default login and set up email-based account validation. It’s perfect for site administrators who want a user-friendly and more secure way for users to log in and register.

**Key Features:**
* Supports multiple languages, including French and English (translation-ready with a .pot file).
* Fully responsive design that works on mobile, tablet, and desktop devices.
* Streamlined redirection process to improve user experience.
* Secure password recovery for registered users via token-based authentication.
* Option to disable the default login URL and replace it with a custom URL.
* Social login integration (Google and Facebook) for easier access.

**Note:** To enable the registration form, ensure that user registration is activated in your site settings. Go to *Settings -> General*, and check the option *Membership - Anyone can register*.

== Installation ==

**From within WordPress:**
1. Navigate to *Plugins -> Add New*.
2. Click on *Upload Plugin* and choose the `.zip` file.
3. Click *Install Now*.
4. Once installed, click *Activate Plugin*.

**Manual Installation:**
1. Upload the plugin `.zip` file to the `/wp-content/plugins/` directory.
2. Go to *Plugins* in WordPress and activate the plugin.

**After Activation:**
1. Go to *Settings -> PSW - Front-end Login & Registration* to configure the plugin.
2. Select the default user role for new registrations.
3. Add email addresses for additional account creation notifications.
4. Choose the page on which the login or registration form should appear.
5. (Optional) Disable the default WordPress login link for added security.

== Screenshots ==

1. **Plugin Settings** - Configure default user roles, notification emails, and page selection.
2. **Login Form** - Front-end login form for users.
3. **Registration Form** - Custom registration form for new account creation.
4. **Password Reset** - Form for users to reset their passwords securely.

== Changelog ==

= 1.0.0 =
* Initial release with core features.
* Added functionality to login with Google and Facebook.

Under *Settings -> PSW Login & Registration*, you will find options to integrate Google and Facebook API keys for social login.

**Documentation:**
* [How to generate Facebook API keys](https://www.prositeweb.ca/connexion-avec-facebook-comment-generer-un-identifiant-et-un-secret-api-facebook/)
* [How to generate Google API keys](https://www.prositeweb.ca/connexion-avec-google-comment-generer-un-identifiant-et-un-secret-api-google/)

== Upgrade Notice ==

Upgrade to version 1.0.0 for new social login features (Google and Facebook) for easier and faster user access.

== Additional Information ==

To translate the plugin, use the .pot file included in the plugin folder. Upload translations to the `/languages/` directory, and WordPress will automatically load them based on the site’s language settings.

== Markdown Example ==

This README file demonstrates the proper formatting of WordPress plugin documentation. Follow WordPress best practices when using or modifying this plugin to ensure maximum compatibility and security.

