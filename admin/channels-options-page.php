<div class="wrap">

	<div id="icon-options-general" class="icon32"></div>
	<h1><?php esc_attr_e( 'News Headlines Channels', 'wp_admin_style' ); ?></h1>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">
				
					<!-- Starts the options page if no value has been passed to function nf_api_categories__options_page() in newsFeeder.php --> 
					<?php if (!isset($wanf_channel) || $wanf_channel == '' ): ?>

					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->
						
						<h2 class="hndle"><span><?php esc_attr_e( 'Lets Get Started', 'wp_admin_style' ); ?></span></h2>

						<div class="inside">
							<form method="post" action="">

							<input type="hidden" name="nf-channel-form-submitted" value="Y" />
								<table class="form-table">
									<tr valign="top">
									
										<td scope="row"><label for="tablecell"><b><?php esc_attr_e( 'Select a Channel', 'wp_admin_style' ); ?></b></label></td>
										
											<td scope="row"><label for="tablecell">
											<!-- Html dropdown list with available channels. Each value of the option receives a value corresponding 
												 to a source of the json parameter. For example, to access JSON data from ABC News (AU), you will 
												 receive the parameter value "abc-news-au" -->
												<select name="select-channel">
													<option value="abc-news-au"><?php esc_attr_e( 'ABC News (AU)', 'wp_admin_style' ); ?></option>
													<option value="al-jazeera-english"><?php esc_attr_e( 'Al Jazeera English', 'wp_admin_style' ); ?></option>
													<option value="associated-press"><?php esc_attr_e( 'Associated Press', 'wp_admin_style' ); ?></option>													
													<option value="bbc-news"><?php esc_attr_e( 'BBC News', 'wp_admin_style' ); ?></option>
													<option value="bloomberg"><?php esc_attr_e( 'Bloomberg', 'wp_admin_style' ); ?></option>
													<option value="business-insider"><?php esc_attr_e( 'Business Insider', 'wp_admin_style' ); ?></option>
													<option value="cnn"><?php esc_attr_e( 'CNN', 'wp_admin_style' ); ?></option>
													<option value="daily-mail"><?php esc_attr_e( 'Daily Mail', 'wp_admin_style' ); ?></option>													
													<option value="entertainment-weekly"><?php esc_attr_e( 'Entertainment Weekly', 'wp_admin_style' ); ?></option>
													<option value="espn"><?php esc_attr_e( 'ESPN', 'wp_admin_style' ); ?></option>
													<option value="financial-times"><?php esc_attr_e( 'Financial Times', 'wp_admin_style' ); ?></option>												
													<option value="fox-sports"><?php esc_attr_e( 'Fox Sports', 'wp_admin_style' ); ?></option>
													<option value="google-news"><?php esc_attr_e( 'Google News', 'wp_admin_style' ); ?></option>
													<option value="mtv-news"><?php esc_attr_e( 'MTV News', 'wp_admin_style' ); ?></option>
													<option value="national-geographic"><?php esc_attr_e( 'National Geographic', 'wp_admin_style' ); ?></option>
													<option value="new-scientist"><?php esc_attr_e( 'New Scientist', 'wp_admin_style' ); ?></option>
													<option value="new-york-magazine"><?php esc_attr_e( 'New York Magazine', 'wp_admin_style' ); ?></option>
													<option value="nfl-news"><?php esc_attr_e( 'NFL News', 'wp_admin_style' ); ?></option>
													<option value="reddit-r-all"><?php esc_attr_e( 'Reddit /r/all', 'wp_admin_style' ); ?></option>
													<option value="reuters"><?php esc_attr_e( 'Reuters', 'wp_admin_style' ); ?></option>
													<option value="the-economist"><?php esc_attr_e( 'The Economist', 'wp_admin_style' ); ?></option>
													<option value="the-guardian-uk"><?php esc_attr_e( 'The Guardian (UK)', 'wp_admin_style' ); ?></option>
													<option value="the-new-york-times"><?php esc_attr_e( 'The New York Times', 'wp_admin_style' ); ?></option>
													<option value="the-wall-street-journal"><?php esc_attr_e( 'The Wall Street Journal', 'wp_admin_style' ); ?></option>
													<option value=""><?php esc_attr_e( 'The Washington Post', 'wp_admin_style' ); ?></option>
													<option value="time"><?php esc_attr_e( 'Time', 'wp_admin_style' ); ?></option>
													<option value="usa-today"><?php esc_attr_e( 'USA Today', 'wp_admin_style' ); ?></option>													
												</select>
											
											</label></td>
										
										<td scope="row"><label for="tablecell"><i><?php esc_attr_e( 'Select one of the available channels', 'wp_admin_style' ); ?></i></label></td>
									</tr>

									<tr valign="top">
										<!-- Text input for API key -->
										<td scope="row"><label for="tablecell"><b><?php esc_attr_e( 'API Key', 'wp_admin_style' ); ?></b></label></td>
										<td><input name="nf-channel-apikey" id="nf-channel-apikey" type="password" value="" class="regular-text" /></td>
										<td scope="row"><label for="tablecell"><i><?php esc_attr_e( 'Enter your API key', 'wp_admin_style' ); ?></i></label></td>
									</tr>
								</table>
								<p><!-- Button submit -->
									<input class="button-primary" type="submit" name="nf-channel-form-submit" value="Save" />
								</p>
								<h2 class="hndle"></h2>
								<p><i><b><?php esc_attr_e( 'Important!', 'wp_admin_style' ); ?></b><?php esc_attr_e( ' Uploading all JSON images will take a few seconds, depending on the speed of your internet connection and availability of external sources. Wait until complete. After the first upload is complete, the results will be available for instant use. The display of images depends on internet connection.', 'wp_admin_style' ); ?></i></p>
								
							<p><i><?php esc_attr_e( 'In this page you can choose one of the channels available to receive more general news. 
							After receiving the JSON results, you can enter them as posts by channel categories (BBC News, CNN, Fox Sports, etc ...)', 'wp_admin_style' ); ?></i></p>
							</form>
						<h2 class="hndle"></h2>
						<p id="footer-left" class="alignleft"><?php esc_attr_e( 'Powered by News API.', 'wp_admin_style' ); ?> 
							<a href="https://newsapi.org/terms" target="_blank"><?php esc_attr_e( 'Terms of Use', 'wp_admin_style' ); ?></a></p>
						</div>
						<!-- .inside -->						
						
					</div>
					<!-- .postbox -->

				 	<?php else: ?>
					<!-- If a categories and API key is already done, start here -->
					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle"><span><?php esc_attr_e( 'Currently Available Results', 'wp_admin_style' ); ?></span>
						</h2>

						<div class="inside">
						<!-- If the amount of json results is less than 10 then cancel the display -->
						
						  <p><i><?php esc_attr_e( 'Below are the results available for the channel chosen at this time. A maximum of 10 results will be displayed for each search.', 'wp_admin_style' ); ?></i></p>
						  
							<ul class="nf-news">				
							<!-- If the amount of json results is less than 10 then cancel the display -->
							<?php for( $i = 0; $i < 10; $i++ ):?>
								<?php if (isset($wanf_results_channel->{'articles'}[$i]->{'urlToImage'})): ?>
								<li>
									<ul><!-- Result of images json -->
									
										<li>
											<img width="120px" src="<?php echo $wanf_results_channel->{'articles'}[$i]->{'urlToImage'};?>">				
										</li>
									
										<!-- Article title and page url containing original article -->										
										<li class="nf-news-name">
											<a href="<?php echo $wanf_results_channel->{'articles'}[$i]->{'url'}; ?>" target="_blank">
												<?php echo $wanf_results_channel->{'articles'}[$i]->{'title'}; ?>
											</a>
										</li>
										<!-- Item description -->
										<li class="nf-news-paragraph">
											<p><?php echo $wanf_results_channel->{'articles'}[$i]->{'description'}; ?></p>
										</li>
									</ul>									
								</li>									
								<?php endif; ?>	
							<?php endfor; ?>
							 
							</ul>
						
						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->				
				
				<div class="postbox-container" style="margin-top: 40px;">

					<div class="handlediv" title="Click to toggle"><br></div>
					<!-- Toggle -->

					<h2 class="hndle"><span><?php esc_attr_e( 'JSON Feeds', 'wp_admin_style' ); ?></span></h2>

					<div class="inside">
						<!-- Json results -->
						<pre><code><?php var_dump($wanf_results_channel); ?></code></pre>	

					</div>
					<!-- .inside -->

				</div>
				<!-- .postbox -->
				<?php endif; ?>
				</div>
				<!-- .meta-box-sortables .ui-sortable -->

			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">

					<?php if (isset($wanf_channel) && $wanf_channel != '' ): ?>
					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle"><span><?php esc_attr_e( 'Settings', 'wp_admin_style' ); ?></span></h2>

						<div class="inside">
						<!-- Form that will be displayed if a json API query has already been successfully done -->
						<!-- This is the same form that appears above if no categories has been done -->
							<form method="post" action="">

							<input type="hidden" name="nf-channel-form-submitted" value="Y" />							
									
								<p><td scope="row"><label for="tablecell"><b><?php esc_attr_e( 'Select a Channel', 'wp_admin_style' ); ?></b></label></td></p>
								
								<!-- Condition that checks the value of the variable $wanf_channel received in the form 
									 dropdown and defines what will be the value of the variable $wanf_channel_return -->
								<?php if ($wanf_channel == "abc-news-au") :
									$wanf_channel_return = "ABC News (AU)"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "al-jazeera-english") :
									$wanf_channel_return = "Al Jazeera English"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "associated-press") :
									$wanf_channel_return = "Associated Press"; ?>									
								<?php endif;?>								
								<?php if ($wanf_channel == "bbc-news") :
									$wanf_channel_return = "BBC News"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "bloomberg") :
									$wanf_channel_return = "Bloomberg"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "business-insider") :
									$wanf_channel_return = "Business Insider"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "cnn") :
									$wanf_channel_return = "CNN"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "daily-mail") :
									$wanf_channel_return = "Daily Mail"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "entertainment-weekly") :
									$wanf_channel_return = "Entertainment Weekly"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "espn") :
									$wanf_channel_return = "ESPN"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "financial-times") :
									$wanf_channel_return = "Financial Times"; ?>									
								<?php endif;?>								
								<?php if ($wanf_channel == "fox-sports") :
									$wanf_channel_return = "Fox Sports"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "google-news") :
									$wanf_channel_return = "Google News"; ?>									
								<?php endif;?>	
								<?php if ($wanf_channel == "mtv-news") :
									$wanf_channel_return = "MTV News"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "national-geographic") :
									$wanf_channel_return = "National Geographic"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "new-scientist") :
									$wanf_channel_return = "New Scientist"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "new-york-magazine") :
									$wanf_channel_return = "New York Magazine"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "nfl-news") :
									$wanf_channel_return = "NFL News"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "reddit-r-all") :
									$wanf_channel_return = "Reddit /r/all"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "reuters") :
									$wanf_channel_return = "Reuters"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "the-economist") :
									$wanf_channel_return = "The Economist"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "the-guardian-uk") :
									$wanf_channel_return = "The Guardian (UK)"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "the-new-york-times") :
									$wanf_channel_return = "The New York Times"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "the-wall-street-journal") :
									$wanf_channel_return = "The Wall Street Journal"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "the-washington-post") :
									$wanf_channel_return = "The Washington Post"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "time") :
									$wanf_channel_return = "Time"; ?>									
								<?php endif;?>
								<?php if ($wanf_channel == "usa-today") :
									$wanf_channel_return = "USA Today"; ?>									
								<?php endif;?>
								<p>
									<td scope="row"><label for="tablecell">
										<!--Condition that checks the value of the $ nf_channel_return variable 
											and sets the value of the dropdown option-->
										<select name="select-channel">
											<option selected="selected" value="<?php echo $wanf_channel ?>"><?php echo $wanf_channel_return; ?></option>
											<?php if ($wanf_channel_return != "ABC News (AU)") : ?>
												<option value="abc-news-au"><?php esc_attr_e( 'ABC News (AU)', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "Al Jazeera English") : ?>
												<option value="al-jazeera-english"><?php esc_attr_e( 'Al Jazeera English', 'wp_admin_style' ); ?></option>
											<?php endif;?>	
											<?php if ($wanf_channel_return != "Associated Press") : ?>
												<option value="associated-press"><?php esc_attr_e( 'Associated Press', 'wp_admin_style' ); ?></option>
											<?php endif;?>											
											<?php if ($wanf_channel_return != "BBC News") : ?>
												<option value="bbc-news"><?php esc_attr_e( 'BBC News', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "Bloomberg") : ?>
												<option value="bloomberg"><?php esc_attr_e( 'Bloomberg', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "Business Insider") : ?>
												<option value="business-insider"><?php esc_attr_e( 'Business Insider', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "CNN") : ?>
												<option value="cnn"><?php esc_attr_e( 'CNN', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "Daily Mail") : ?>
												<option value="daily-mail"><?php esc_attr_e( 'Daily Mail', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "Entertainment Weekly") : ?>
												<option value="entertainment-weekly"><?php esc_attr_e( 'Entertainment Weekly', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "ESPN") : ?>
												<option value="espn"><?php esc_attr_e( 'ESPN', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "Financial Times") : ?>
												<option value="financial-times"><?php esc_attr_e( 'Financial Times', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "Fox Sports") : ?>
												<option value="fox-sports"><?php esc_attr_e( 'Fox Sports', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "Google News") : ?>
												<option value="google-news"><?php esc_attr_e( 'Google News', 'wp_admin_style' ); ?></option>
											<?php endif;?>	
											<?php if ($wanf_channel_return != "MTV News") : ?>
												<option value="mtv-news"><?php esc_attr_e( 'MTV News', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "National Geographic") : ?>
												<option value="national-geographic"><?php esc_attr_e( 'National Geographic', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "New Scientist") : ?>
												<option value="new-scientist"><?php esc_attr_e( 'New Scientist', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "New York Magazine") : ?>
												<option value="new-york-magazine"><?php esc_attr_e( 'New York Magazine', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "NFL News") : ?>
												<option value="nfl-news"><?php esc_attr_e( 'NFL News', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "Reddit /r/all") : ?>
												<option value="reddit-r-all"><?php esc_attr_e( 'Reddit /r/all', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "Reuters") : ?>
												<option value="reuters"><?php esc_attr_e( 'Reuters', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "The Economist") : ?>
												<option value="the-economist"><?php esc_attr_e( 'The Economist', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "The Guardian (UK)") : ?>
												<option value="the-guardian-uk"><?php esc_attr_e( 'The Guardian (UK)', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "The New York Times") : ?>
												<option value="the-new-york-times"><?php esc_attr_e( 'The New York Times', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "The Wall Street Journal") : ?>
												<option value="the-wall-street-journal"><?php esc_attr_e( 'The Wall Street Journal', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "The Washington Post") : ?>
												<option value="the-washington-post"><?php esc_attr_e( 'The Washington Post', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "Time") : ?>
												<option value="time"><?php esc_attr_e( 'Time', 'wp_admin_style' ); ?></option>
											<?php endif;?>
											<?php if ($wanf_channel_return != "USA Today") : ?>
												<option value="usa-today"><?php esc_attr_e( 'USA Today', 'wp_admin_style' ); ?></option>
											<?php endif;?>											
										</select>
									
									</label></td>																			
								</p>
							
								<!-- Text input for API key -->
								<p>
									<td scope="row"><label for="tablecell"><b><?php esc_attr_e( 'API Key', 'wp_admin_style' ); ?></b></label></td>
									<input name="nf-channel-apikey" id="nf-channel-apikey" type="password" value="<?php echo $wanf_channel_apikey; ?>" class="all-options" />
								</p>
						
								<p><!-- Button submit -->
									<input class="button-primary" type="submit" name="nf-channel-form-submit" value="Save" />
								</p>
											
								<!-- Here you start the settings for inserting posts when the query is executed successfully -->
								<fieldset class="insertPost">
									<p><i><?php esc_attr_e( 'Before clicking "Auto insert posts", click the "Save" button to update the results', 'wp_admin_style' ); ?></i></p>
									<p><i><?php esc_attr_e( 'To insert posts, click on the checkbox below, choose the options and click on the "save" button', 'wp_admin_style' ); ?></i></p>
									<p><b><?php esc_attr_e( 'Auto insert posts', 'wp_admin_style' ); ?></b></p>
	
										<!-- If this checkbox is selected, then the posts will be included -->
										<input id="checkBoxPost" type="checkbox" name="checkBoxPost" value="1" onclick="valueChanged()"/> Enabled		
																												
								</fieldset>							
								
								<fieldset id="optionPost" style="display: none;" >
								<p><i><?php esc_attr_e( 'The process for inserting posts will take a few seconds to complete, please wait! JSON results with larger images take longer to complete insertion.', 'wp_admin_style' ); ?></i></p>
								<hr>
									<p>	
										<b><?php esc_attr_e( 'Select a categories for post', 'wp_admin_style' ); ?></b>
									</p>
									<p>
									<!-- Here is the dropdown that stores the categories that were previously created for the posts -->
									<form name="cat[]" method="post" multiple="multiple">
																						
											<?php 
												$args =  array(
													'show_option_all' => 'Select',
													'orderby' => 'name',
													'order'   => 'ASC',
													'type'    => 'post',
													'hide_empty' => 0,
													'hierarchical' => true,
													'multiple' => true
													);
												wp_dropdown_categories($args);
											?>
											
										</form>
									</p>
										<p><i><?php esc_attr_e( 'Categories that were created in the Admin menu: Posts -> Categories', 'wp_admin_style' ); ?></i></p>
																												
									<hr>
									<p>
										<b><?php esc_attr_e( 'Open the article link on the same tab?', 'wp_admin_style' ); ?></b>
									</p><!-- If this checkbox is selected, then the author link will open in a new tab -->
										<input type="checkbox" name="check-blank" value="ck-blank" /><?php esc_attr_e( 'Enabled', 'wp_admin_style' ); ?>									
										<p><?php esc_attr_e( 'When you click on the news link, it will open in a new tab. If you choose this option, it will open on the same tab.', 'wp_admin_style' ); ?></p>
									
									<hr>									
										<p><b><?php esc_attr_e( 'Remove attribution link to API source?', 'wp_admin_style' ); ?></b></p>
										<!-- If this checkbox is selected, then the author link will open in a new tab -->
										<input type="checkbox" name="check-atribution" value="ck-atribution" /><?php esc_attr_e( 'Enabled', 'wp_admin_style' ); ?>									
										<p><?php esc_attr_e( 'If you choose this option, the API source attribution link will disappear from the bottom right of the news article.', 'wp_admin_style' ); ?></p>
									
								</fieldset>								
							</form>
						<h2 class="hndle"></h2>
						<p id="footer-left" class="alignleft"><?php esc_attr_e( 'Powered by News API.', 'wp_admin_style' ); ?> 
							<a href="https://newsapi.org/terms" target="_blank"><?php esc_attr_e( 'Terms of Use', 'wp_admin_style' ); ?></a></p>
						</div>
						<!-- .inside -->
						
					</div>
					<!-- .postbox -->
				<?php endif; ?>

				</div>
				<!-- .meta-box-sortables -->
			</div>
			<!-- #postbox-container-1 .postbox-container -->
		</div>
		<!-- #post-body .metabox-holder .columns-2 -->
		<br class="clear">		
	</div>
	<!-- #poststuff -->
	
	<!-- Javascript to show or hide posts options -->	
	<script type="text/javascript">
		function valueChanged() {
			var $ = jQuery.noConflict();
			$('input[type="checkbox"]').on("click", function() {
				var item = $(this);
				var relatedItem = $("#" + item.attr("optionPost")).parent();
				$('.toggling').fadeOut(); //hide all									
			});
														
			$('#checkBoxPost').change(function() {
				if ($(this).is(":checked")) {
					$("#optionPost").show();
				} else {
					$("#optionPost").hide();
				}
			}); 
		}
	</script>
		
</div> <!-- .wrap -->