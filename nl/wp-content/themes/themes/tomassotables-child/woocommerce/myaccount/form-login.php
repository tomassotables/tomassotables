<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<div class="u-columns row" id="customer_login">
	<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
		<div class="u-column2 col-sm-6 col-lg-4 d-flex">
			<form method="post"
			      class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >
				<h2><?php esc_html_e( 'Registreer', 'woocommerce' ); ?></h2>

				<p><?php _e( 'Aangenaam kennis te maken.' ); ?></p>

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_username" class="d-none"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span
								class="required">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text"
						       placeholder="<?php esc_html_e( 'Username', 'woocommerce' ); ?>*" name="username"
						       id="reg_username" autocomplete="username"
						       value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
					</p>

				<?php endif; ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_email" class="d-none"><?php esc_html_e( 'E-mailadres', 'woocommerce' ); ?>
						&nbsp;<span class="required">*</span></label>
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email"
					       placeholder="<?php esc_html_e( 'E-mailadres', 'woocommerce' ); ?>*" id="reg_email"
					       autocomplete="email"
					       value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_password"><?php esc_html_e( 'Wachtwoord', 'woocommerce' ); ?>&nbsp;<span
								class="required">*</span></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text"
						       name="password"
						       id="reg_password" autocomplete="new-password"/>
					</p>

				<?php else : ?>

					<p><?php esc_html_e( 'Er wordt een link naar je e-mailadres gestuurd om een wachtwoord in te stellen.', 'woocommerce' ); ?></p>

				<?php endif; ?>

				<?php do_action( 'woocommerce_register_form' ); ?>

				<div class="woocommerce-form-row form-row mb-0">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit"
					        class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit"
					        name="registreer"
					        value="<?php esc_attr_e( 'Registreer', 'woocommerce' ); ?>"><?php esc_html_e( 'Registreer', 'woocommerce' ); ?></button>
				</div>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>
		</div>
	<?php endif; ?>

	<div class="u-column1 col-sm-6 col-lg-4 d-flex">
		<form class="woocommerce-form woocommerce-form-login login" method="post">
			<h2><?php esc_html_e( 'Inloggen', 'woocommerce' ); ?></h2>

			<p><?php _e( 'Wat leuk om je weer te zien.' ); ?></p>

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username" class="d-none"><?php esc_html_e( 'Gebruikersnaam of e-mailadres', 'woocommerce' ); ?>
					&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username"
				       id="username" autocomplete="username"
				       placeholder="<?php esc_html_e( 'Gebruikersnaam of e-mailadres', 'woocommerce' ); ?>*"
				       value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password" class="d-none"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span
						class="required">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password"
				       placeholder="<?php esc_html_e( 'Password', 'woocommerce' ); ?>*" id="password"
				       autocomplete="current-password"/>
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<label
					class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme"
					       type="checkbox" id="rememberme" value="forever"/>
					<span><?php esc_html_e( 'Onthoud mij', 'woocommerce' ); ?></span>
				</label>

				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login"
				        value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
			</p>

			<div class="woocommerce-LostPassword lost_password text-center mb-0">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Wachtwoord vergeten?', 'woocommerce' ); ?></a>
			</div>

			<?php do_action( 'woocommerce_login_form_end' ); ?>
		</form>
	</div>

	<?php if ( ( $features = get_field( 'account_features', 'option' ) ) && ! empty( $features ) ) : ?>
		<div class="u-column3 col-lg-4 d-flex">
			<form class="register account__features">
				<?php echo $features; ?>
			</form>
		</div>
	<?php endif; ?>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
