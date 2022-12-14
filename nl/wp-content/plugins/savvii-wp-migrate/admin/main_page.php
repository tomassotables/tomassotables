<?php
		$_error = NULL;
		if (array_key_exists('error', $_REQUEST)) {
			$_error = $_REQUEST['error'];
		}
?>
		<div class="logo-container" style="padding: 50px 0px 10px 20px">
			<a href="https://www.savvii.com/" style="padding-right: 20px;"><img src="<?php echo plugins_url($this->getPluginLogo(), __FILE__); ?>" /></a>
			<a href="http://blogvault.net/"><img src="<?php echo plugins_url('../img/logo.png', __FILE__); ?>" /></a>
		</div>

		<div id="wrapper" class="toplevel_page_savvii-automated-migration">
			<h1>Migrate Your Site to Savvii</h1>
			<div class="grid">
				<div class="grid__col grid__col--6-of-12">
				<form id="savvii_migrate_form" dummy=">" action="<?php echo $this->bvinfo->appUrl(); ?>/home/migrate" onsubmit="document.getElementById('migratesubmit').disabled = true;" style="padding:0 2% 2em 1%;" method="post" name="signup">
				<p><font size="3">The Savvii WP Migrate plugin makes it very easy to migrate your entire site <br />from your previous hosting provider to Savvii.
									The required Savvii sFTP data <br />has been sent to your registered email address.</font></p>
<?php if ($_error == "email") { 
echo '<div class="error" style="padding-bottom:0.5%;"><p>There is already an account with this email.</p></div>';
		} else if ($_error == "blog") {
			echo '<div class="error" style="padding-bottom:0.5%;"><p>Could not create an account. Please contact <a href="http://blogvault.net/contact/">blogVault Support</a><br />
				<font color="red">NOTE: We do not support automated migration of locally hosted sites.</font></p></div>';
		} else if (($_error == "custom") && isset($_REQUEST['bvnonce']) && wp_verify_nonce($_REQUEST['bvnonce'], "bvnonce")) {
			echo '<div class="error" style="padding-bottom:0.5%;"><p>'.esc_html(base64_decode($_REQUEST['message'])).'</p></div>';
		}
?> 

					<input type="hidden" name="bvsrc" value="wpplugin" />
					<input type="hidden" name="migrate" value="savvii" />
					<input type="hidden" name="type" value="sftp" />
<?php echo $this->siteInfoTags(); ?>
					<div class="row-fluid">
						<div class="span5" style="border-right: 1px solid #EEE; padding-top:1%;">
							<label id='label_email'>Email</label>
							<div class="control-group">
								<div class="controls">
									<input type="text" id="email" name="email" placeholder="ex. user@mydomain.com">
								</div>
							</div>
							<label class="control-label" for="input02">Destination Site URL</label>
							<div class="control-group">
								<div class="controls">
									<input type="text" class="input-large" name="newurl" placeholder="http://example.com">
								</div>
							</div>
							<label class="control-label" for="inputip">sFTP Hostname</label>
							<div class="control-group">
								<div class="controls">
									<input type="text" class="input-large" placeholder="ex. example.savviihq.com" name="address">
								<p class="help-block"></p>
								</div>
							</div>
							<label class="control-label" for="input01">sFTP User</label>
							<div class="control-group">
								<div class="controls">
									<input type="text" class="input-large" placeholder="ex. installname" name="username">
									<p class="help-block"></p>
								</div>
							</div>
							<label class="control-label" for="input02">sFTP Password</label>
							<div class="control-group">
								<div class="controls">
									<input type="password" class="input-large" name="passwd">
								</div>
							</div>	
<?php if (array_key_exists('auth_required_source', $_REQUEST)) { ?>
							<div id="source-auth">
								<label class="control-label" for="input02" style="color:red">User <small>(for this site)</small></label>
								<div class="control-group">
									<div class="controls">
										<input type="text" class="input-large" name="httpauth_src_user">
									</div>
								</div>
								<label class="control-label" for="input02" style="color:red">Password <small>(for this site)</small></label>
								<div class="control-group">
									<div class="controls">
										<input type="password" class="input-large" name="httpauth_src_password">
									</div>
								</div>
							</div>
<?php } ?>
							<div class="control-group">
								<div class="controls">
									<input type="checkbox" name="consent" onchange="document.getElementById('migratesubmit').disabled = !this.checked;" value="1"/>I agree to Blogvault <a href="https://blogvault.net/tos" target="_blank" rel="noopener noreferrer">Terms of Service</a> and <a href="https://blogvault.net/privacy" target="_blank" rel="noopener noreferrer">Privacy Policy</a>
								</div>
							</div>
						</div>
					</div>
					<input type='submit' disabled id='migratesubmit' value='Migrate' class="button button-primary">
				</form>
				</div>
				<div class="grid__col grid__col--6-of-12">
					<div style="background-color:#FFF;padding:9px;">
						<div class="video-container">
							<iframe src="https://www.youtube.com/embed/joKfuSmCmLw?start=45"></iframe>
						</div>
						<div>
							<p>The above video will guide you through the migration process.</p>
						</div>
					</div>
				</div>
			</div>
		</div> <!-- wrapper ends here -->