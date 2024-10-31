<div class="wrap">

<div id="icon-options-general" class="icon32"></div>
	<h1><?php esc_attr_e( 'Settings Page for JSON results and posts inserted by NewsFeeder plugin', 'wp_admin_style' ); ?></h1>
<!-- Add tab menu-->
<div class="nav-tab-wrapper" style="overflow: hidden;">
	<button class="nav-tab nav-tab-active" onclick="openClean(event, 'clearSet_tab')"><?php esc_attr_e( 'Clear settings', 'wp_admin_style' ); ?></button>
</div>
	
	<div id="poststuff">
		<div id="post-body" class="metabox-holder columns-2">
			<!-- main content -->
			<div id="post-body-content">
				<div class="meta-box-sortables ui-sortable">
					
					<!-- #Clear Settings tab -->
					<div id="clearSet_tab" class="tabcontent">
						
						<div class="postbox" style="border-left-color: #ffba00; border-left-width: 4px;"> 
							<h2 class="hndle"><span><?php esc_attr_e( 'Attention! Changes in the options below can not be undone.', 'wp_admin_style' ); ?></span></h2>
						</div>
						
						<div class="postbox"> 
						
						<h2 class="hndle"><span><?php esc_attr_e( 'News by search', 'wp_admin_style' ); ?></span></h2>
							<div class="inside">
							
							<form method="post" action="">
								
								<fieldset>
									<p><?php esc_attr_e( 'Remove JSON search results from database?', 'wp_admin_style' ); ?></p>
									
									<!-- If this checkbox is selected, then all options such as api key and last valid categories 
										 will be removed from the database -->
									<input type="checkbox" name="clearOptionsSearch" /><?php esc_attr_e( 'Enabled', 'wp_admin_style' ); ?>	
																												
								</fieldset>	

								<br>
								<fieldset>
									<p><?php esc_attr_e( 'Remove posts inserted in the database?', 'wp_admin_style' ); ?></p>
									<!-- If this checkbox is selected, then all posts entered through categories 
										 will be removed from the data base -->
									<input type="checkbox" name="clearPostsSearch" /><?php esc_attr_e( 'Enabled', 'wp_admin_style' ); ?>		
																												
								</fieldset>	
								<br>
								
							</div>
							<h2 class="hndle"></h2>
							<h2 class="hndle"><span><?php esc_attr_e( 'News by channels', 'wp_admin_style' ); ?></span></h2>
							<div class="inside">								
								
								<fieldset>
									<p><?php esc_attr_e( 'Remove API key and JSON results from database?', 'wp_admin_style' ); ?></p>
									<!-- If this checkbox is selected, then all options such as api key and last valid channels 
										 will be removed from the database -->
									<input type="checkbox" name="clearOptionschannel" /><?php esc_attr_e( 'Enabled', 'wp_admin_style' ); ?>	
																												
								</fieldset>	

								<br>
								<fieldset>
									<p><?php esc_attr_e( 'Remove posts inserted in the database?', 'wp_admin_style' ); ?></p>
									<!-- If this checkbox is selected, then all posts entered through channels 
										 will be removed from the data base -->
									<input type="checkbox" name="clearPostsChannel" /><?php esc_attr_e( 'Enabled', 'wp_admin_style' ); ?>		
																												
								</fieldset>	
								<br>

								<p> <!-- Submit button -->
									<input class="button-primary" type="submit" name="nf-clear-submit" value="Save" />
								</p>
								<br>
							</form>
							</div>
							<!-- #inside -->
						</div>
						<!-- #postbox -->
					</div>
					<!-- #Clear settings tab -->
					
				</div>
				<!-- #meta-box-sortables -->
			</div>
			<!-- #post-body-content -->
			<!-- sidebar -->
					<div id="postbox-container-1" class="postbox-container">

						<div class="meta-box-sortables">
							
							<div class="postbox">

								<div class="handlediv" title="Click to toggle"><br></div>
								<!-- Toggle -->

								<h2 class="hndle"><span><?php esc_attr_e( 'What happens?', 'wp_admin_style' ); ?></span></h2>
								
								<div class="inside">								
									<i><?php esc_attr_e( 'In the "Clear settings" tab you can choose to delete one or more NewsFeeder plugin interactions with the database, such as API key, JSON results, and inserted posts.', 'wp_admin_style' ); ?>
									<h2 class="hndle"></h2>
									<?php esc_attr_e( 'You may want to leave your wordpress installation clean before you disable or uninstall the NewsFeeder plugin.', 'wp_admin_style' ); ?> </i>		
								</div>
								
							</div>
							<!-- .postbox -->
						

						</div>
						<!-- .meta-box-sortables -->
					</div>
					<!-- #postbox-container-1 .postbox-container -->
		</div>
		<!-- #post-body -->
	</div>
	<!-- #poststuff -->
	
	<script type="text/javascript">	
	function openClean(evt, cleanPage) {
		// Declare all variables
		var i, tabcontent, navtab;

		// Get all elements with class="tabcontent" and hide them
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
			tabcontent[i].style.display = "none";
		}

		// Get all elements with class="navtab" and remove the class "active"
		navtab = document.getElementsByClassName("navtab");
		for (i = 0; i < navtab.length; i++) {
			navtab[i].className = navtab[i].className.replace(" active", "");
		}

		// Show the current tab, and add an "active" class to the button that opened the tab
		document.getElementById(cleanPage).style.display = "block";
		evt.currentTarget.className += " active";
	}
</script>

</div>
<!-- #wrap -->
