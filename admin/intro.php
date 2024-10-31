<div class="wrap">
<h1><?php echo '<img src="' . plugins_url( '_inc/images/newsfeeder32.png', dirname(__FILE__) ) . '" alt="Logo" width="auto" height="32" /> '; esc_attr_e( '  NewsFeeder WordPress Plugin V1.2', 'wp_admin_style' ); ?></h1>
<!-- Add tab menu-->
<div class="nav-tab-wrapper" style="overflow: hidden;">
	<button class="nav-tab nav-tab-active" onclick="openWelcome(event, 'welcome_tab')"><?php esc_attr_e( 'Welcome', 'wp_admin_style' ); ?></button>
	<button class="nav-tab" onclick="openWelcome(event, 'terms_tab')"><?php esc_attr_e( 'Terms', 'wp_admin_style' ); ?></button>
</div>

<!-- Welcome tab -->
<div id="welcome_tab" class="tabcontent">
	<div id="welcome-panel" class="welcome-panel">
		<div class="welcome-panel-content">						
			<h1><?php esc_attr_e( 'Welcome to NewsFeeder!', 'wp_admin_style' ); ?></h1>
				<p class="about-description"><?php esc_attr_e( 'NewsFeeder is a news headlines aggregator for your website. 
				You can make the news available by sidebar or enter them as posts, sorting by categories as you need them. When you enter news as posts, 
				it will automatically be generated: keyword tags, authors name, date of articles, titles, descriptions and featured images.', 'wp_admin_style' ); ?></p>
				<br>
				<p class="about-description"><?php esc_attr_e( 'To start searching for news, you can start the free search on the web through the "Web Search" menu, 
				or get the API key, for this you should make a brief registration with email and 
				password, then you will receive your API key, and you can start your search by inserting news content for your site through 
				posts and sidebar obtained from JSON results!', 'wp_admin_style' ); ?></p>
				<br>
				<p class="about-description"><b><?php esc_attr_e( 'To receive all JSON results with images, direct from 27 news channels around the world, get the API key. It\'s totally free!', 'wp_admin_style' ); ?></b></p>
				
				<br>
				<h2><?php esc_attr_e( 'Get your API key for free!', 'wp_admin_style' ); ?></h2>
				
				<div class="welcome-panel-column-container">					
					<div class="welcome-panel-column">									
						<h3><?php esc_attr_e( 'News by Channels', 'wp_admin_style' ); ?></h3>
						<p>
						<!-- Get API key-->
						<?php $url_newsapi = 'https://newsapi.org/register';?>
						<a class="button button-primary button-hero " href="<?php echo esc_url( $url_newsapi ); ?>" target="_blank">
							<?php esc_attr_e( 'Get API key!', 'wp_admin_style' ); ?></a></p>
						<p id="footer-left" class="alignleft"><?php esc_attr_e( 'Powered by News API', 'wp_admin_style' ); ?></p>
						<br>
					</div>
					
					<div class="welcome-panel-column">
						<h3><?php esc_attr_e( 'Useful steps', 'wp_admin_style' ); ?></h3>
						<?php $url_plugin = 'https://webberaction.com/newsfeeder-plugin/index.html#previewPlugin'; ?>
						<?php $url_doc = 'https://webberaction.com/newsfeeder-plugin/documentation/'; ?>
						<?php $url_donate = 'https://webberaction.com/newsfeeder-plugin/index.html#donate'; ?>
						<ul>
							<li><a href="<?php echo esc_url( $url_plugin ); ?>" class="welcome-icon welcome-view-site" target="blank"><?php esc_attr_e( 'NewsFeeder live preview', 'wp_admin_style' ); ?></a></li>
							<li><a href="<?php echo esc_url( $url_doc ); ?>" class="welcome-icon welcome-learn-more" target="blank"><?php esc_attr_e( 'See our documentation', 'wp_admin_style' ); ?></a></li>
							<li><a href="<?php echo esc_url( $url_donate ); ?>" class="welcome-icon dashicons-sos" target="blank"><?php esc_attr_e( 'Donate', 'wp_admin_style' ); ?></a></li>
							
						</ul>
					</div>
				</div>
				<br>			
		</div>
			
	</div>
</div><!-- #Welcome tab-->

<!-- Terms tab-->
<div id="terms_tab" class="tabcontent" style="display: none;">
	<div id="welcome-panel" class="welcome-panel">
		<div class="welcome-panel-content">
			<h2><?php esc_attr_e( 'Terms of use', 'wp_admin_style' ); ?></h2><br>
			<p class="about-description"><?php esc_attr_e( 'The NewsFeeder plugin is here to help you, which is to generate news content for your sites, you can use it without limitations, but for legal purposes, we make the terms of use available. This is short so please we ask you to read carefully.', 'wp_admin_style' ); ?></p><br>
			<p class="about-description"><?php esc_attr_e( 'The following terms of use serve to ensure the impartiality of the NewsFeeder plugin with the web search engine "www.faroo.com" and the news source API "https://newsapi.org" to which the plugin links.', 'wp_admin_style' ); ?></p>
			<p class="about-description"><?php esc_attr_e( 'Regarding the NewsFeeder plugin and these external services mentioned above, the following terms are used:', 'wp_admin_style' ); ?></p><br>
			<p class="about-description"><?php esc_attr_e( '1. The web search system is powered by the search engine "www.faroo.com" and according to its terms of use, is based on peer-to-peer architecture, is not managed by any authority, does not guarantee the quality and availability of the service. This service is not administered and does not belong to the NewsFeeder plugin.', 'wp_admin_style' ); ?></p>
			<p class="about-description"><?php esc_attr_e( '2. The NewsFeeder plugin is not owned, is not responsible, has no partnership and is not affiliated with the API source "https://newsapi.org".', 'wp_admin_style' ); ?></p>
			<p class="about-description"><?php esc_attr_e( '3. The NewsFeeder plugin has no responsibility for the services provided by both external sources mentioned above, and is not responsible for the availability of the contents, nor type of content quality.', 'wp_admin_style' ); ?></p>
			<p class="about-description"><?php esc_attr_e( '4. The NewsFeeder plugin is not responsible for your use of the information provided, nor for possible cancellations of your API key, nor damages and / or financial losses, or of any other type that it may cause to you.', 'wp_admin_style' ); ?></p>
			<p class="about-description"><?php esc_attr_e( '5. Image of people (famous, politician or notorious person), product brands or companies, flags of countries or images of places like cities and postcards that can appear in the site "https://webberaction.com/newsfeeder.html", as well as in the documentation of the NewsFeeder plugin, or in its user interface, are not part of the plugin and are not sold with it. The NewsFeeder Plugin does not have any partiality with the images that are political, religious or propaganda. The images were captured during the use of the plugin, and they are real news, but they serve in this case only as an example illustration of the plugin\'s features.', 'wp_admin_style' ); ?></p><br>
			<p class="about-description"><?php esc_attr_e( 'For more information on how to use API without restraints or cancellations, see the terms and conditions of the API source.', 'wp_admin_style' ); ?></p><br>
		</div>
	</div>
</div>
<!--#Terms tab-->

<script type="text/javascript">	
	function openWelcome(evt, welcomePage) {
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
		document.getElementById(welcomePage).style.display = "block";
		evt.currentTarget.className += " active";
	}
</script>

</div> 
<!-- #wrap -->
	