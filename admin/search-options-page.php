<div class="wrap">
	<div id="icon-options-general" class="icon32"></div>
	<h1><?php esc_attr_e( 'Search News Headlines', 'wp_admin_style' ); ?></h1>

	<div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

				<div class="meta-box-sortables ui-sortable">
				
					<!-- Starts the options page if no value has been passed to function wanfv12_search_options_page() in newsFeeder.php --> 
					<?php if (!isset($wanf_input_search) || $wanf_input_search == '' ): ?>

					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->
						
						<h2 class="hndle"><span><?php esc_attr_e( 'Lets Get Started', 'wp_admin_style' ); ?></span></h2>

						<div class="inside">
							<form method="post" action="">

							<input type="hidden" name="nf-form-submitted" value="Y" />
								<table class="form-table">
									<tr valign="top">
										<!-- Text input for search keyword -->
										<td scope="row"><label for="tablecell"><b><?php esc_attr_e( 'Search', 'wp_admin_style' ); ?></b></label></td>										
										<td><input name="nf-search" id="nf-search" type="text" value="" class="regular-text" /></td>
										<td scope="row"><label for="tablecell"><i><?php esc_attr_e( 'Enter one or more keywords', 'wp_admin_style' ); ?></i></label></td>
									</tr>

								</table>
								<p><!-- Button submit -->
									<input class="button-primary" type="submit" name="nf-form-submit" value="Save" />
								</p>
								<!-- Add a nounce -->
								<?php wp_nonce_field( 'submit_search' ); ?>
								<h2 class="hndle"></h2>
								<p><i><b><?php esc_attr_e( 'Important!', 'wp_admin_style' ); ?></b><?php esc_attr_e( ' To view search results you need internet connection. The number of results will depend on availability at the time of the search. A maximum of 10 results will be returned per search.', 'wp_admin_style' ); ?></i></p>
								
								<p><i><?php esc_attr_e( 'On this page you can search for news on the web. After receiving the JSON results, these will be available to add as posts by categories according to your search (Fashion, Business, Politics, etc...).', 'wp_admin_style' ); ?></i></p>
							</form>
						<h2 class="hndle"></h2>
						<p id="footer-left" class="alignleft"><?php esc_attr_e( 'Powered by Faroo web search.', 'wp_admin_style' ); ?> 
							<a href="http://www.faroo.com/hp/p2p/faq.html" target="_blank"><?php esc_attr_e( 'FAQ', 'wp_admin_style' ); ?></a></p>
						</div>
						<!-- .inside -->						
						
					</div>
					<!-- .postbox -->

				 	<?php else: ?>
					<!-- If a search and API key is already done, start here -->
					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle"><span><?php esc_attr_e( 'Currently Available Results', 'wp_admin_style' ); ?></span>
						</h2>

						<div class="inside">
						<!-- If the amount of json results is less than 10 then cancel the display -->
						 
						  <p><i><?php esc_attr_e( 'Below are the results available for this search at this time.', 'wp_admin_style' ); ?></i></p>
						  
							<ul class="nf-news">				
							<!-- If the amount of json results is less than 10 then cancel the display -->
							<?php for( $i = 0; $i < 10; $i++ ):?>
								<li>
									<ul><!-- Result of images json -->
									<?php if (isset($wanf_results_search->{'results'}[$i]->{'iurl'})) : ?>
										<li>
											<img width="120px" src="<?php echo $wanf_results_search->{'results'}[$i]->{'iurl'};?>">				
										</li>
										<!-- Article title and page url containing original article -->										
										<li class="nf-news-name">
											<a href="<?php echo $wanf_results_search->{'results'}[$i]->{'url'}; ?>" target="_blank">
												<?php echo $wanf_results_search->{'results'}[$i]->{'title'}; ?>
											</a>
										</li>
										<!-- Item description -->
										<li class="nf-news-paragraph">
											<p><?php echo $wanf_results_search->{'results'}[$i]->{'kwic'}; ?></p>
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

				<div class="postbox-container" style="margin-top:30px;">

					<div class="handlediv" title="Click to toggle"><br></div>
					<!-- Toggle -->

					<h2 class="hndle"><span><?php esc_attr_e( 'JSON Feeds', 'wp_admin_style' ); ?></span></h2>

					<div class="inside">
						<!-- Json results -->
						<pre><code><?php var_dump($wanf_results_search); ?></code></pre>	

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

					<?php if (isset($wanf_input_search) && $wanf_input_search != '' ): ?>
					<div class="postbox">

						<div class="handlediv" title="Click to toggle"><br></div>
						<!-- Toggle -->

						<h2 class="hndle"><span><?php esc_attr_e( 'Settings', 'wp_admin_style' ); ?></span></h2>

						<div class="inside">
						<!-- Form that will be displayed if a json API query has already been successfully done -->
						<!-- This is the same form that appears above if no search has been done -->
							<form method="post" action="">

							<input type="hidden" name="nf-form-submitted" value="Y" />
							
								<p>
									<td scope="row"><label for="tablecell"><b><?php esc_attr_e( 'Search', 'wp_admin_style' ); ?></b></label></td>
									<input name="nf-search" id="nf-search" type="text" value="<?php echo $wanf_input_search; ?>" class="all-options" />
								</p>
																	
								<p>
									<input class="button-primary" type="submit" name="nf_form_submit" value="Save" />
								</p>
								<!-- Add a nounce -->
								<?php wp_nonce_field( 'submit_search' ); ?>		
								<!-- Here you start the settings for inserting posts when the query is executed successfully -->
								<fieldset class="insertPost">
									<p><i><?php esc_attr_e( 'Before clicking "Auto insert posts", click the "Save" button to update the results', 'wp_admin_style' ); ?></i></p>
									<p><i><?php esc_attr_e( 'To insert posts, click on the checkbox below, choose the options and click on the "save" button', 'wp_admin_style' ); ?></i></p>
									<p><b><?php esc_attr_e( 'Auto insert posts', 'wp_admin_style' ); ?></b></p>
									
										<!-- If this checkbox is selected, then the posts will be included -->
										<input id="checkBoxPost" type="checkbox" name="checkBoxPost" value="1" onclick="valueChanged()"/> Enabled		
																												
								</fieldset>							
								
								<fieldset id="optionPost" style="display: none;" >
									<p><i><?php esc_attr_e( 'The process for inserting posts will take a few seconds to complete, please wait! ', 'wp_admin_style' ); ?></i></p>
									<p><?php esc_attr_e( 'Repeated results will be deleted.', 'wp_admin_style' ); ?></p>
									<p><?php esc_attr_e( 'News with or without images will depend on the source site that provides the news.', 'wp_admin_style' ); ?></p>
									<hr>
									<p>	
										<b><?php esc_attr_e( 'Select a category for post', 'wp_admin_style' ); ?></b>
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
										<b><?php esc_attr_e( 'Open the author link on the same tab?', 'wp_admin_style' ); ?></b>
									</p><!-- If this checkbox is selected, then the author link will open in a new tab -->
										<input type="checkbox" name="check-blank" value="ck-blank" /><?php esc_attr_e( 'Enabled', 'wp_admin_style' ); ?>									
									<p><?php esc_attr_e( 'When you click on the author link, you will be directed to the news source page in a new tab. If you check this option the news will open on the same tab.', 'wp_admin_style' ); ?></p>
																		
								</fieldset>								
							</form>
						<h2 class="hndle"></h2>
						<p id="footer-left" class="alignleft"><?php esc_attr_e( 'Powered by Faroo web search.', 'wp_admin_style' ); ?> 
							<a href="http://www.faroo.com/hp/p2p/faq.html" target="_blank"><?php esc_attr_e( 'FAQ', 'wp_admin_style' ); ?></a></p>							
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