<?php 
/**
 * @package newsFeeder
 * @since 1.0.0
 *
 * Plugin Name: NewsFeeder - Headline Generator
 * Plugin URI: https://webberaction.com/newsfeeder-plugin/
 * Description: It provides news through web searches and over 27 news channels around the world, with hundreds if not thousands of news stories every day. You can make the news available to your audience in the form of feeds and posts, and display them on the front-end using the plugin's template features, with blocks ready to be used and combined, thus generating multiple types of design. Use your imagination and create amazing front-pages and news headlines sites.
 * Version: 1.2.0
 * Author: WebberAction
 * Author URI: https://webberaction.com/
 * Text Domain: newsfeeder
 * Tags: WordPress, WordPress Plugins, NewsFeeder, news, headlines, api, template, template news, news channels, web search news, news api, news generator
 */
 

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'This plugin is powered by WordPress.';
	exit;
}

// Sets the plugin constants
define( 'WANFV12_VERSION', '1.2' );
define( 'WANFV12_MINIMUM_WP_VERSION', '3.7' );
define( 'WANFV12_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

// Register function activation
register_activation_hook( __FILE__, 'wanfv12_plugin_activation' );

/**
 * Initializes WordPress hooks
 * More details about each function follows throughout this file  
 */
add_filter( 'wp_dropdown_cats', 'wanfv12_dropdown_cats_multiple', 10, 2 );
add_action( 'admin_menu','wanfv12_admin_menu' );
add_action( 'admin_head', 'wanfv12_backend_styles' );

//Create a function called "wanfv12_plugin_activation" if it doesn't already exist
if ( !function_exists( 'wanfv12_plugin_activation' ) ) {
	// Compare the current version of Wordpress with the WANFV12_MINIMUM_WP_VERSION constant of plugin
	function wanfv12_plugin_activation() {
		if ( version_compare( $GLOBALS['wp_version'], WANFV12_MINIMUM_WP_VERSION, '<' ) ) {					
			$message = '<strong>'.sprintf(esc_html__( 'NewsFeeder %s requires WordPress %s or higher.' , 'newsfeeder'), WANFV12_VERSION, WANFV12_MINIMUM_WP_VERSION ).'</strong> '.sprintf(__('Please <a href="%1$s">upgrade WordPress</a> to a current version.' ), 'https://codex.wordpress.org/Upgrading_WordPress', 'https://wordpress.org/extend/plugins/akismet/download/');
			wp_die( $message );
			
		}
	}
}

//Create a function called "wanfv12_admin_menu" if it doesn't already exist
if ( !function_exists( 'wanfv12_admin_menu' ) ) {
	// Menu function
	function wanfv12_admin_menu(){
			
		//create custom top-level menu
		 add_menu_page( 'NewsFeeder', 'NewsFeeder',
		 'manage_options', __FILE__, 'wanfv12_welcome_page', plugins_url( '_inc/images/newsfeeder16.png', __FILE__)	 );

		 //create submenu items
		 add_submenu_page( __FILE__, 'NewsFeeder - Welcome', 'Welcome', 'manage_options',
		 __FILE__, 'wanfv12_welcome_page' );
		 
		 add_submenu_page( __FILE__, 'NewsFeeder - Web Search', 'Web Search', 'manage_options',
		 __FILE__.'_keyword', 'wanfv12_search_options_page' );
		 
		 add_submenu_page( __FILE__, 'NewsFeeder - Channels', 'Channels', 'manage_options',
		 __FILE__.'_channel', 'wanfv12_channels_options_page' );
		 
		 add_submenu_page( __FILE__, 'NewsFeeder Option', 'Options', 'manage_options',
		 __FILE__.'_cleaning', 'wanfv12_settings_page' );
		 
	}
}

//Create a function called "wanfv12_welcome_page" if it doesn't already exist
if ( !function_exists( 'wanfv12_welcome_page' ) ) {
	// Function that calls the file that contains the welcome page code
	function wanfv12_welcome_page(){
		
		// Verify if user is admin
		if (!current_user_can('manage_options')){
			wp_die('You do not have enough permission to view this page');
		}
		
		require( WANFV12_PLUGIN_DIR . 'admin/intro.php' );
		
	}
}

//Create a function called "wanfv12_search_options_page" if it doesn't already exist
if ( !function_exists( 'wanfv12_search_options_page' ) ) {
	
	function wanfv12_search_options_page(){

		// Verify if user is admin
		if (!current_user_can('manage_options')){
			wp_die('You do not have enough permission to view this page');
		} else {	
		
			// Now we can process the submission
			if ( is_user_logged_in() && isset( $_POST['nf-form-submitted'] ) && isset( $_POST['nf-search'] ) ) {
				
				global $post_author_link;
				
				// Declaration of the $wanf_options variable that will store and return all the input data
				$wanf_options = array();
				// NewsFeeder search options page function
				// This function references the search-options-page.php file, all html elements that are called in this function are from this file
				
				// By default, we can find the nonce in the "_wpnonce" request parameter.
				$nonce = $_REQUEST['_wpnonce'];
				if ( ! wp_verify_nonce( $nonce, 'submit_search' ) ) {
				  exit; // Get out of here, the nonce is rotten!
				}
				
				$hidden_field = $_POST['nf-form-submitted'];
			   /** 
				* Initiates passing of form's input values ​​from file search-options-page.php
				* through sanitize_text_field($_POST['input-name']) to $wanf_input_search variable;
				*/
				if($hidden_field == 'Y'){				
					
					// Sanitize and Validate
					$wanf_input_search = sanitize_text_field($_POST['nf-search']);
					if ( ! $wanf_input_search ) {
					  $wanf_input_search = '';
					}
					
					// Assigning json result to $wanf_results_search variable						
					$wanf_results_search = wanfv12_search_url_json($wanf_input_search);
					
					// Verify is exists internet conection
					if(!isset($wanf_results_search->{'results'}) || empty($wanf_results_search->{'results'}) || count($wanf_results_search->{'results'}) < 1 ){				
						?>
						<div id="message" class="error notice">
							<p><strong><?php _e('No results.') ?></strong></p>
						</div> <?php
						
						?>
						<div id="message" class="error notice">
							<p><strong><?php _e('Your search did not return any results. There are 2 possible causes for this:<br><br><i>1. No listings were found to match your search.<br>2. There is no internet connection or the external servers are unavailable.</i><br><br>Make sure your internet has a good connection and is not overloaded.<br>If you have internet connection try your search again, external errors happen but are not permanent.<br>To return, go to <i>NewsFeeder</i> menu.<br>') ?></strong></p>
						</div> <?php
						
						wp_die();								
						
					} elseif (isset($wanf_results_search->{'results'})){
						?>
						<div id="message" class="updated notice">
							<p><strong><?php _e('Saved successfully!') ?></strong></p>
						</div> <?php
					}									

				   /**
					************************ CRUD *******************************
					* Create or add new entries 
					* Create string values in option_value field from wp_options table
					* with parameters passed to $wanf_options variable
					*/			
					$wanf_options['wa_nf__input_search'] = $wanf_input_search;
					$wanf_options['last_updated'] = time();
					
				   /**
					* Attributing $wanf_results_search variable to $wanf_options variable for generate a string nf_api_results 
					* in option_value field table
					*/
					$wanf_options['wa_nf__results_search'] = $wanf_results_search;
					
				   /**
					* Crete a row in wp_options table with nf_web_search__news value to option_name field, 
					* and $wanf_options variable to options_value field
					*/
					update_option('wa_nf__search_options', $wanf_options);
					
					/*************************************************************/
					
					// If the "Auto insert posts" check box is selected, then it starts the process for insertion	
					if( !empty($_POST["checkBoxPost"]) ) {
			
					   /**
						* Auto insert post options 
						* Here are the options to add API results as posts if you choose. 
						* You can add posts automatically, choose categories and more ...
						*/		
						
						// This is a fixed reference constant for future cleaning uninstall of inserted posts
						define('WANF_REF_VALUE_SEARCH', '9999999');
						
						// Variables that will count if posts are inserted or update
						$value_insert = 0;
						$value_update = 0;
						
						//Variables that will store boolean values ​​to serve as reference for each type of message displayed
						$value_insert_boolean = false;
						$value_update_boolean = false;				
						
						// Global variables that will be called from within coding instructions
						global $wpdb;																
						global $author_news;
						global $keywords;
						global $source_news;
						global $snippet;
						global $multimedia;	

						set_time_limit(300);
																						
					   /*
						* Condition that will count each result, in case 10 results will always be returned, 
						* less than 10 the call is canceled, as seen previously
						*/
						for( $i = 0; $i < 10; $i++ ){	
								
							/**
							 * Assignment of json elements to their respective variables, 
							 * elements including pictures of news, titles, description, article page url, 
							 * author copywriter and date article
							 */
							if (!empty($wanf_results_search->{'results'}[$i]->{'iurl'})) {
								// Assigning JSON results to image in $multimedia variable
								$multimedia = $wanf_results_search->{'results'}[$i]->{'iurl'};
							} else {
								$multimedia = '';
							}
							// Assigning JSON results to title in $headline variable 
							$headline = $wanf_results_search->{'results'}[$i]->{'title'};
							// Assigning JSON results to description in $snippet variable
							$snippet = $wanf_results_search->{'results'}[$i]->{'kwic'};
							// Assigning JSON results to source news in $source_news variable
							$source_news = $wanf_results_search->{'results'}[$i]->{'domain'};							
							// Assigning JSON results to url news in $url_news variable
							$url_news = $wanf_results_search->{'results'}[$i]->{'url'};								
							// Assigning JSON results to author news in $author_news variable
							if (!empty($wanf_results_search->{'results'}[$i]->{'author'})) {
								$author_news = $wanf_results_search->{'results'}[$i]->{'author'};
							} else {
								$author_news = $source_news;
							}
							
							$post_author = $author_news;																				
							
						   /** 
							* Assigning the form id on page search-options-page.php to $cat variable 
							* This refers to the category chosen by the user in the options page
							*/
							// In this case, validate an array by confirming that it is set
							$categories = isset( $_POST['cat'] ) ? (array) $_POST['cat'] : array();
							
							foreach ( $categories as $cat => $val ) {
								$new_cat[ $cat ] = sanitize_text_field( $val );
								break;
							}
							
						   /**
							* If the checkbox is empty, the article will display the author copywriter, 
							*/
							
							// If checkbox is selected, then the article link will open in a same tab
							if( !empty($_POST["check-blank"]) ) {
								$author_news_link = "<a href=' $url_news '>$post_author</a>";
							} else {
								$author_news_link = "<a href=' $url_news ' target='_blank'>$post_author</a>";
							}
							
							$post_author_link = $author_news_link;	
							
							
							// Search posts by title in the database table wp_posts
							// Assignment of result to $posts_count_title_search variable
							$posts_count_title_search = $wpdb->get_var($wpdb->prepare( 
								"
									SELECT count(post_title) 
									FROM $wpdb->posts 
									WHERE post_title = %s
									AND post_type = %s
									", $headline, 'post'
									)
							);									
							
						  /** 
						   * If the user enters any json result as a post, and it already exists in the database, 
						   * then the existing post will be updated 
						   */
							if($posts_count_title_search != 0 ){
								
								/**
								* Selects the main id of the post title that will serve as reference 
								* to insert the feature image and postmeta value
								*/
								$id_post_search = $wpdb->get_var($wpdb->prepare( 
								"
									SELECT ID 
									FROM $wpdb->posts 
									WHERE post_title = %s
									AND post_type = %s
									", $headline, 'post'
									)
								);

								// Update post 
								$update_post = array(
									'ID'           => $id_post_search,
									'post_content' => "<p>" . $snippet . "</p>" . "<p>" . $post_author_link . "</p>",		'post_category' => $new_cat,
								);
								
								// stop revisions
								remove_action( 'post_updated', 'wp_save_post_revision' );

								// Update the post into the database
								wp_update_post( $update_post );
								
								//  enable revisions again  
								add_action( 'post_updated', 'wp_save_post_revision' );						
								
								$value_update_boolean = true;								
								$value_update++;										
							}
							
							// If query $posts_count_title_search returns 0 results, then the element 
							// contained in the looping will be inserted
							if($posts_count_title_search == 0 ){								
																							
								$insert_post = array(
									'post_title' => $headline,
									'post_content' => "<p>" . $snippet . "</p>" . "<p>" . $post_author_link . "</p>",		'post_category' => $new_cat,
									'tags_input' => $wanf_input_search . ','. $headline,
									'post_parent' => WANF_REF_VALUE_SEARCH,
									'post_status' => 'publish',
									'post_type' => 'post',
								);								
								
								$post_id = wp_insert_post( $insert_post);
								
								// insert the json image into the wordpress media 
								if (!empty($multimedia)) {
									
									$image_id = media_sideload_image( $multimedia, $post_id );
									
									if (is_wp_error($image_id)){
										$image_id = '';
									}
									
									if(!is_wp_error($image_id)){																
									
										$thumbnail_id = $wpdb->get_var($wpdb->prepare( 
										"
											SELECT ID 
											FROM $wpdb->posts 
											WHERE post_parent = %d
											", $post_id 
											)
										);									
										
										set_post_thumbnail( $post_id, $thumbnail_id );
										
									}									
								}																
								
								$value_insert_boolean = true;							
								$value_insert++;	
							}										
						}
						
						/**
						 * Conditional statements to check the Boolean value of the $value_update_boolean 
						 * and $value_insert_boolean variables and decide which message to display
						 */
						if($value_insert_boolean == true && $value_update_boolean == false){
							?>
							<div id="message" class="updated notice">
								<p><strong><?php _e( $value_insert . ' Post(s) were inserted successfully!') ?></strong></p>
							</div> <?php
						}
						if($value_update_boolean == true && $value_insert_boolean == false){
							?>
							<div id="message" class="updated notice">
							<p><strong><?php _e( $value_update . ' Existing post(s) were successfully updated!') ?></strong></p>
							</div> <?php	
						}
						if ($value_insert_boolean == true && $value_update_boolean == true ){
							?>
							<div id="message" class="updated notice">
								<p><strong><?php _e( $value_insert . ' Post(s) were inserted successfully!') ?></strong></p>
							</div> <?php					
							?>
							<div id="message" class="updated notice">
							<p><strong><?php _e( $value_update . ' Existing post(s) were successfully updated!') ?></strong></p>
							</div> <?php
						}
					}
				}						
			}	
			
		   /** 
			* Read, retrieve, search, or view existing entries
			* Get nf_web_search__news value from option_name field in wp_options table
			*/	
			$wanf_options = get_option('wa_nf__search_options');
			// if exists a row in wp_options table, then retrieve values from option_value field table
			if ($wanf_options !== ''){
				$wanf_input_search = $wanf_options['wa_nf__input_search'];
				$wanf_results_search = $wanf_options['wa_nf__results_search'];		
			} 

		   /**
			* Point to search-options-page.php file to get the values passed and return 
			* the record values from table database (wp_options/option_name='wa_nf__search_options', 
			* option_value='nf_search, nf_apikey, nf_api_results')
			*/	
			require( WANFV12_PLUGIN_DIR . 'admin/search-options-page.php' );
		}
	}	
}

//Create a function called "wanfv12_search_url_json" if it doesn't already exist
if ( !function_exists( 'wanfv12_search_url_json' ) ) {
	/**
	 * Function that makes the connection to the API source through a url and gets the result according API and keyword informed
	 * @param $wanf_input_search which receives the search string keyword Informed on the page form search-options-page.php
	 */
	function wanfv12_search_url_json($wanf_input_search){
		
		// Get the API url with the parameters passed by imput form
		$json_feed_url = 'http://www.faroo.com/instant.json?q=' . urlencode($wanf_input_search) .'&start=1&length=10&l=en&src=web&i=false&c=false';
		
		$json_feed = wp_remote_get($json_feed_url);
		$json_feed_body = wp_remote_retrieve_body( $json_feed );
		
		try {
			 
			// Note that we decode the body's response since it's the actual JSON feed
			$wanf_results_search = json_decode( $json_feed_body );
	 
		} catch ( Exception $ex ) {
			$wanf_results_search = null;
		} // end try/catch	
			 
		return $wanf_results_search;	
	}
}

//Create a function called "wanfv12_channels_options_page" if it doesn't already exist
if ( !function_exists( 'wanfv12_channels_options_page' ) ) {
	// NewsFeeder channels page function
	// This function references the channels-options-page.php file, all html elements that are called in this function are from this file
	function wanfv12_channels_options_page(){

	// Verify if user is admin
		if (!current_user_can('manage_options')){
			wp_die('You do not have enough permission to view this page');
		}
		
		global $wanf_options_channel;
		global $post_author_link_channel;	

		if (isset($_POST['nf-channel-form-submitted'])){
			$hidden_field_channel = sanitize_text_field($_POST['nf-channel-form-submitted']);

		   /** 
			* Initiates passing of form's input values ​​from file options-page-wrapper.php
			* through sanitize_text_field($_POST['input-name']) to $wanf_channel and $wanf_channel_apikey variables;
			*/
			if($hidden_field_channel == 'Y'){
				
				// Sanitize
				$wanf_channel = trim( $_POST['select-channel'] );
				// Sanitize and validate
				$wanf_channel_apikey = sanitize_text_field($_POST['nf-channel-apikey']);	
				if ( ! $wanf_channel_apikey ) {
				  $wanf_channel_apikey = '';
				}				
				
				// Assigning json result to $wanf_results_channel variable						
				$wanf_results_channel = wanfv12_channel_url_json($wanf_channel, $wanf_channel_apikey);
				
				// If the result is not set, then display error message and cancel the categories with wp_die()
				if(!isset($wanf_results_channel->{'articles'})) {				
					?>
					<div id="message" class="error notice">
						<p><strong><?php _e('No results.') ?></strong></p>
					</div> <?php
					
					?>
					<div id="message" class="error notice">
						<p><strong><?php _e('Your search did not return any feed API results. There are 2 possible causes for this:<br><br><i>1. Confirm that you entered the correct API number.<br>2. Failed to connect to the internet or external API servers.</i><br><br>Make sure your internet has a good connection and is not overloaded.<br>If you entered a valid API key and has internet connection, 
						try the connection again with the same or another channel. <br/>External factors may occur but not persistent.<br>To return, go to <i>NewsFeeder</i> menu.<br>') ?></strong></p>
					</div> <?php
					
					wp_die();			
				} 
					
				// If the result is set, then display sucess message 
				if (isset($wanf_results_channel->{'articles'})){
					?>
					<div id="message" class="updated notice">
						<p><strong><?php _e('Saved successfully!') ?></strong></p>
					</div> <?php
				}									

			   /**
				************************ CRUD *******************************
				* Create or add new entries 
				* Create string values in option_value field from wp_options table
				* with parameters passed to $wanf_options_channel variable
				*/			
				$wanf_options_channel['wa_nf__channel'] = $wanf_channel;
				$wanf_options_channel['wa_nf__channel_apikey'] = $wanf_channel_apikey;
				$wanf_options_channel['last_updated_channel'] = time();
				
			   /**
				* Attributing $wanf_results_channel variable to $wanf_options_channel variable for generate a string nf_api_results_channel 
				* in option_value field table
				*/
				$wanf_options_channel['wa_nf__results_channel'] = $wanf_results_channel;
				
			   /**
				* Crete a row in wp_options table with nf_api_channel__news value to option_name field, 
				* and $wanf_options_channel variable to options_value field
				*/
				update_option('wa_nf__channel_options', $wanf_options_channel);
				
				/*************************************************************/

				// If the "Auto insert posts" check box is selected, then it starts the process for insertion
				if( !empty($_POST["checkBoxPost"]) ) {
		
				   /**
					* Auto insert post options 
					* Here are the options to add API results as posts if you choose. 
					* You can add posts automatically, choose categories and more ...
					*/		
					
					// This is a fixed reference constant for future cleaning uninstall of inserted posts
					define('WANF_REF_VALUE_CHANNEL', '9999998');
					
					// Variables that will count if posts are inserted or update
					$value_insert = 0;
					$value_update = 0;
					
					//Variables that will store boolean values ​​to serve as reference for each type of message displayed
					$value_insert_boolean = false;
					$value_update_boolean = false;				
					
					// Global variables that will be called from within coding instructions
					global $wpdb;	
					global $post_source_channel;
					global $post_source;
					
					set_time_limit(300);
					 /*
					  * Condition that will count each result, in case 10 results will be returned
					  */
					for( $i = 0; $i < 10; $i++ ){					
						if (!empty($wanf_results_channel->{'articles'}[$i]->{'urlToImage'})) {	
							/* Here each variable receives a JSON return type */
							$multimedia_channel = $wanf_results_channel->{'articles'}[$i]->{'urlToImage'};
							$headline_channel = $wanf_results_channel->{'articles'}[$i]->{'title'};
							$paragraph_channel = $wanf_results_channel->{'articles'}[$i]->{'description'};
							$url_channel = $wanf_results_channel->{'articles'}[$i]->{'url'};						
							
							/* Assigning chosen channel from the dropdown list to $post_channel variable*/
							$post_channel = trim( $_POST['select-channel'] );
							
							/** 
							 * Condition that defines the variable source channel according to the result 
							 * received by the variable $post_channel
							 */
							 if ($post_channel == "abc-news-au") :
								$post_source_channel= "ABC News (AU)"; 									
							 endif;
							 if ($post_channel == "al-jazeera-english") :
								$post_source_channel= "Al Jazeera English"; 									
							 endif;
							 if ($post_channel == "associated-press") :
								$post_source_channel= "Associated Press"; 									
							 endif;
							 if ($post_channel == "bbc-news") :
								$post_source_channel= "BBC News"; 									
							 endif;
							 if ($post_channel == "bloomberg") :
								$post_source_channel= "Bloomberg"; 									
							 endif;
							 if ($post_channel == "business-insider") :
								$post_source_channel= "Business Insider"; 									
							 endif;
							 if ($post_channel == "cnn") :
								$post_source_channel= "CNN"; 									
							 endif;
							 if ($post_channel == "daily-mail") :
								$post_source_channel= "Daily Mail"; 									
							 endif;
							 if ($post_channel == "entertainment-weekly") :
								$post_source_channel= "Entertainment Weekly"; 									
							 endif;
							 if ($post_channel == "espn") :
								$post_source_channel= "ESPN"; 									
							 endif;
							 if ($post_channel == "financial-times") :
								$post_source_channel= "Financial Times"; 									
							 endif;								
							 if ($post_channel == "fox-sports") :
								$post_source_channel= "Fox Sports"; 									
							 endif;
							 if ($post_channel == "google-news") :
								$post_source_channel= "Google News"; 									
							 endif;
							 if ($post_channel == "mtv-news") :
								$post_source_channel= "MTV News"; 									
							 endif;
							 if ($post_channel == "national-geographic") :
								$post_source_channel= "National Geographic"; 									
							 endif;
							 if ($post_channel == "new-scientist") :
								$post_source_channel= "New Scientist"; 									
							 endif;
							 if ($post_channel == "new-york-magazine") :
								$post_source_channel= "New York Magazine"; 									
							 endif;
							 if ($post_channel == "nfl-news") :
								$post_source_channel= "NFL News"; 									
							 endif;
							 if ($post_channel == "reddit-r-all") :
								$post_source_channel= "Reddit /r/all"; 									
							 endif;
							 if ($post_channel == "reuters") :
								$post_source_channel= "Reuters"; 									
							 endif;
							 if ($post_channel == "the-economist") :
								$post_source_channel= "The Economist"; 									
							 endif;
							 if ($post_channel == "the-guardian-uk") :
								$post_source_channel= "The Guardian (UK)"; 									
							 endif;
							 if ($post_channel == "the-new-york-times") :
								$post_source_channel= "The New York Times"; 									
							 endif;
							 if ($post_channel == "the-wall-street-journal") :
								$post_source_channel= "The Wall Street Journal"; 									
							 endif;
							 if ($post_channel == "the-washington-post") :
								$post_source_channel= "The Washington Post"; 									
							 endif;
							 if ($post_channel == "time") :
								$post_source_channel= "Time"; 									
							 endif;
							 if ($post_channel == "usa-today") :
								$post_source_channel= "USA Today"; 									
							 endif;	
							 
							 $url_source_channel = $post_source_channel;
							 
							// If checkbox is selected, then the article link will open in a same tab
							if( !empty($_POST["check-blank"]) ) {
								$post_source = "<a href=' $url_channel '>$url_source_channel</a>";
							} else {
								$post_source = "<a href=' $url_channel ' target='_blank'>$url_source_channel</a>";
							}
							
							//Checks whether the link assignment checkbox is empty or not. If it is empty, 
							//it does the assignment, if it does not receive an empty value
							if( empty($_POST["check-atribution"]) ) {								
								$newsapi_url = "https://newsapi.org/";
								$newsapi = "<a href=' $newsapi_url ' target='_blank'>Powered by News API</a>";							
							} else {
								$newsapi = '';
							}
							
							
							/** 
							* Assigning the form id on page channels-options-page.php to $cat variable 
							* This refers to the category chosen by the user in the options page
							*/
							$cat = $_POST['cat'];
									
							// Category posts by title in the database table wp_posts
							// Assignment of result to $posts_count_title_channel variable
							$posts_count_title_channel = $wpdb->get_var($wpdb->prepare( 
								"
									SELECT count(post_title) 
									FROM $wpdb->posts 
									WHERE post_title = %s
									AND post_type = %s
									", $headline_channel, 'post'
									)
							);									
								
							/** 
							 * If the user enters any json result as a post, and it already exists in the database, 
							 * then the existing post will be updated
							 */
							if($posts_count_title_channel != 0 ){
								
								/**
								* Selects the main id of the post title that will serve as reference 
								* to insert the feature image and postmeta value
								*/
								$id_post_channel = $wpdb->get_var($wpdb->prepare( 
								"
									SELECT ID 
									FROM $wpdb->posts 
									WHERE post_title = %s
									AND post_type = %s
									", $headline_channel, 'post'
									)
								);

								// Update post 
								$update_post = array(
									'ID'           => $id_post_channel,
									'post_content' => "<p>" . $paragraph_channel ."</p>" . "<p>" . $post_source . "</p>" . "<p style='font-size:11px; text-align:right;'>" . $newsapi . "</p>",	
									'post_category' => $cat,
								);
								
								// stop revisions
								remove_action( 'post_updated', 'wp_save_post_revision' );

								// Update the post into the database
								wp_update_post( $update_post );
								
								//  enable revisions again  
								add_action( 'post_updated', 'wp_save_post_revision' );
								
								$value_update_boolean = true;								
								$value_update++;										
							}
							
							// If query $posts_count_title_channel returns 0 results, then the element 
							// contained in the looping will be inserted
							if($posts_count_title_channel == 0 ){

								$insert_post = array(
									'post_title' => $headline_channel,
									'post_content' => "<p>" . $paragraph_channel ."</p>" . "<p>" . $post_source . "</p>" . "<p style='font-size:11px; text-align:right;'>" . $newsapi . "</p>",	
									'post_category' => $cat,
									'tags_input' => $post_source_channel . ','. $headline_channel,
									'post_parent' => WANF_REF_VALUE_CHANNEL,
									'post_status' => 'publish',
									'post_type' => 'post',
								);	
								
								$post_id = wp_insert_post( $insert_post);
								
								// insert the json image into the wordpress media 
								if (!empty($multimedia_channel)) {
									
									$image_id = media_sideload_image( $multimedia_channel, $post_id );
									
									if (is_wp_error($image_id)){
										$extension_url_multimedia = $multimedia_channel . ".jpg";
										$image_id = media_sideload_image( $extension_url_multimedia, $post_id );
										
										if (is_wp_error($image_id)){
											$image_id = '';
										}
									}
									
									if(!is_wp_error($image_id)){																
									
										$thumbnail_id = $wpdb->get_var($wpdb->prepare( 
										"
											SELECT ID 
											FROM $wpdb->posts 
											WHERE post_parent = %d
											", $post_id 
											)
										);																			
										
										set_post_thumbnail( $post_id, $thumbnail_id );
										
									}				
								}								
								
								$value_insert_boolean = true;							
								$value_insert++;	
							}
						}
					} 
						
					/**
					 * Conditional statements to check the Boolean value of the $value_update_boolean 
					 * and $value_insert_boolean variables and decide which message to display
					 */
					if($value_insert_boolean == false && $value_update_boolean == false ) {
						?>
						<div id="message" class="error notice">
							<p><strong><?php _e(' There are no feeds with images to insert as posts. Only feeds with images will be inserted as posts.') ?></strong></p>
						</div> <?php
					}  
					if($value_insert_boolean == true && $value_update_boolean == false){
						?>
						<div id="message" class="updated notice">
							<p><strong><?php _e( $value_insert . ' Post(s) were inserted successfully!') ?></strong></p>
						</div> <?php
					}
					if($value_update_boolean == true && $value_insert_boolean == false){
						?>
						<div id="message" class="updated notice">
						<p><strong><?php _e( $value_update . ' Existing post(s) were successfully updated!') ?></strong></p>
						</div> <?php	
					}
					if ($value_insert_boolean == true && $value_update_boolean == true ){
						?>
						<div id="message" class="updated notice">
							<p><strong><?php _e( $value_insert . ' Post(s) were inserted successfully!') ?></strong></p>
						</div> <?php					
						?>
						<div id="message" class="updated notice">
						<p><strong><?php _e( $value_update . ' Existing post(s) were successfully updated!') ?></strong></p>
						</div> <?php
					}
				}		
			}
		}	
		
	   /** 
		* Read, retrieve, categories, or view existing entries
		* Get nf_api_channel__news value from option_name field in wp_options table
		*/	
		$wanf_options_channel = get_option('wa_nf__channel_options');
		// if exists a row in wp_options table, then retrieve values from option_value field table
		if ($wanf_options_channel !== ''){
			$wanf_channel = $wanf_options_channel['wa_nf__channel'];
			$wanf_channel_apikey = $wanf_options_channel['wa_nf__channel_apikey'];
			$wanf_results_channel = $wanf_options_channel['wa_nf__results_channel'];		
		} 

	   /**
		* Point to options-page-wrapper.php file to get the values passed and return 
		* the record values from table database (wp_options/option_name='wa_nf__channel_options', 
		* option_value='nf_channel, nf_apikey_channel, nf_api_results_channel')
		*/	
		require( WANFV12_PLUGIN_DIR . 'admin/channels-options-page.php' );
	}
}

//Create a function called "wanfv12_channel_url_json" if it doesn't already exist
if ( !function_exists( 'wanfv12_channel_url_json' ) ) {
	/**
	 * Function that makes the connection to the API source through a url and gets the result according API and keyword informed
	 * @param $wanf_channel which receives the search string keyword Informed on the page form options-page-wapper.php
	 * @param $wanf_channel_apikey which receives the API key Informed on the page form options-page-wapper.php
	 */
	function wanfv12_channel_url_json($wanf_channel, $wanf_channel_apikey){
		
		// Get the API url with the parameters passed by imput form
		$json_feed_url_channel = 'https://newsapi.org/v2/top-headlines?sources=' . $wanf_channel .'&apiKey=' . $wanf_channel_apikey;
		
		$json_feed_channel = wp_remote_get($json_feed_url_channel);
		$json_feed_body_channel = wp_remote_retrieve_body( $json_feed_channel );
		
		try {
			 
			// Note that we decode the body's response since it's the actual JSON feed
			$wanf_results_channel = json_decode( $json_feed_body_channel );
	 
		} catch ( Exception $ex ) {
			$wanf_results_channel = null;
		} // end try/catch	
			 
		return $wanf_results_channel;	
	}
}

//Create a function called "wanfv12_backend_styles" if it doesn't already exist
if ( !function_exists( 'wanfv12_backend_styles' ) ) {
	// Plugin backend styles
	function wanfv12_backend_styles(){
		
		// Backendend grid styles
		wp_enqueue_style('nf-backend-css', plugins_url('_inc/css/newsFeeder.css', __FILE__ ));
		// Enqueue jQuery
		wp_enqueue_script('jquery');
	}
}

//Create a function called "wanfv12_settings_page" if it doesn't already exist
if ( !function_exists( 'wanfv12_settings_page' ) ) {
	/**
	 * Function to clear user settings for the API query and clean the inserted posts through the plugin
	 * This option must be chosen manually by the user before desactivation or uninstalling the plugin
	 */
	function wanfv12_settings_page() {		
		
		// Verify if user is admin
		if (!current_user_can('manage_options')){
			wp_die('You do not have enough permission to view this page');
		}
		
		global $wpdb;	
		
		// This query checks if there is any post and store the result in the variable $count_post_search	
				$count_post_search = $wpdb->get_var($wpdb->prepare( 
				"
					SELECT count(post_parent) 
					FROM $wpdb->posts 
					WHERE post_parent = %d								
					", 9999999));
				
				// This query checks if there is any post and store the result in the variable $count_post_channel
				$count_post_channel = $wpdb->get_var($wpdb->prepare( 
				"
					SELECT count(post_parent) 
					FROM $wpdb->posts 
					WHERE post_parent = %d								
					", 9999998));	
		
		if( isset($_POST["nf-clear-submit"])) {
			/* 
			 * Here are conditions set to delete database options and posts for news by search
			 */
			if( !empty($_POST["clearOptionsSearch"])) {
				
				$get_option_search = get_option('wa_nf__search_options');
				
				/*Remove options from wp_options table*/	
				if ( !empty ($get_option_search)) {
					
					delete_option('wa_nf__search_options'); 
						
				 ?>
				<div id="message" class="updated notice">
					<p><strong><?php _e('Search options removed!') ?></strong></p>
				</div> <?php
				} else {
					?>
					<div id="message" class="error notice">
						<p><strong><?php _e('There are no search options to remove.') ?></strong></p>
					</div> <?php
				}
			}
			/* Remove posts from wp_posts table*/
			if( !empty($_POST["clearPostsSearch"])) {
					
				if ( !empty ($count_post_search)) {
				   /**
					* Selects the main id of the post that will serve as reference 
					* to insert the feature image and postmeta value
					*/
					$id_posts_search = $wpdb->get_results( 
						"
						SELECT *
						FROM $wpdb->posts
						WHERE post_parent = 9999999	
						"
					);						
					
					foreach ( $id_posts_search as $id_post_search ) 
					{
						// Removes the data from the postmeta table as a result of the query above
						$wpdb->query("DELETE FROM $wpdb->postmeta 
									  WHERE post_id = '$id_post_search->ID'
									  ");
									  
						$id_post_parent_search = "SELECT *
									FROM $wpdb->posts
									WHERE post_parent = '$id_post_search->ID'	
						 ";					 

						$results = $wpdb->get_results( $id_post_parent_search );
						
						foreach ( $results as $result ) {
							$wpdb->query("DELETE FROM $wpdb->postmeta 
									  WHERE post_id = '$result->ID'
									  ");
						}
						// Removes the posts and features contained in the wp_posts table
						$wpdb->query("DELETE FROM $wpdb->posts WHERE post_parent = '$id_post_search->ID'");					
						$wpdb->query("DELETE FROM $wpdb->posts WHERE ID = '$id_post_search->ID'");
					}
					
					 ?>
					<div id="message" class="updated notice">
						<p><strong><?php _e('Search posts removed!!') ?></strong></p>
					</div> <?php
				
				} else {
					?>
					<div id="message" class="error notice">
						<p><strong><?php _e('There are no search posts to remove.') ?></strong></p>
					</div> <?php
				}
			}
			
		   /* 
			* Here are conditions set to delete database options and posts for news by channels
			*/
			if( !empty($_POST["clearOptionschannel"])) {
				
				$get_option_channel = get_option('wa_nf__channel_options');

				/*Remove options from wp_options table*/	
				if ( !empty ($get_option_channel)) {	
				
					delete_option('wa_nf__channel_options');
					
				 ?>
				<div id="message" class="updated notice">
					<p><strong><?php _e('Channel options removed!') ?></strong></p>
				</div> <?php
				} else {
					?>
					<div id="message" class="error notice">
						<p><strong><?php _e('There are no channel options to remove.') ?></strong></p>
					</div> <?php
				}
			}
			/*Remove posts from wp_posts table*/
			if( !empty($_POST["clearPostsChannel"])) {
					
				if ( !empty ($count_post_channel)) {
				   /**
					* Selects the main id of the post that will serve as reference 
					* to insert the feature image and postmeta value
					*/
					$id_posts_channel = $wpdb->get_results( 
						"
						SELECT *
						FROM $wpdb->posts
						WHERE post_parent = 9999998	
						"
					);						
					
					foreach ( $id_posts_channel as $id_post_channel ) 
					{
						// Removes the data from the postmeta table as a result of the query above
						$wpdb->query("DELETE FROM $wpdb->postmeta 
									  WHERE post_id = '$id_post_channel->ID'
									  ");
									  
						$id_post_parent_channel = "SELECT *
									FROM $wpdb->posts
									WHERE post_parent = '$id_post_channel->ID'	
						 ";					 

						$results = $wpdb->get_results( $id_post_parent_channel );
						
						foreach ( $results as $result ) {
							$wpdb->query("DELETE FROM $wpdb->postmeta 
									  WHERE post_id = '$result->ID'
									  ");
						}
						// Removes the posts and features contained in the wp_posts table
						$wpdb->query("DELETE FROM $wpdb->posts WHERE post_parent = '$id_post_channel->ID'");					
						$wpdb->query("DELETE FROM $wpdb->posts WHERE ID = '$id_post_channel->ID'");
					}
					
					 ?>
					<div id="message" class="updated notice">
						<p><strong><?php _e('Channel posts removed!') ?></strong></p>
					</div> <?php
				
				} else {
					?>
					<div id="message" class="error notice">
						<p><strong><?php _e('There are no channel posts to remove.') ?></strong></p>
					</div> <?php
				}
			}
			
			if( !empty($_POST["clearOptionsSearch"]) && !empty($_POST["clearPostsSearch"]) && !empty($_POST["clearOptionschannel"]) && !empty($_POST["clearPostsChannel"])) {
				// If all options are marked on the settings page, then all options 
				// will be removed from the wp_options table in the database
				delete_option('wa_nf__channel_options');
				delete_option('wa_nf__search_options');
				delete_option('wa_nf__frontpage_options');
				delete_option('wa_nf__relatedpost_options');
				delete_option('widget_wa_nf__json_results');
				delete_option('widget_wa_nf__recent_posts');
				
			} elseif( empty($_POST["clearOptionsSearch"]) && empty($_POST["clearPostsSearch"]) && empty($_POST["clearOptionschannel"]) && empty($_POST["clearPostsChannel"])) {
				?>
				<div id="message" class="error notice">
					<p><strong><?php _e('There are no choose options to remove.') ?></strong></p>
				</div> <?php
			}
		}
		 
		require( WANFV12_PLUGIN_DIR . 'admin/settings-page.php' );
	}
}

//Create a function called "wanfv12_dropdown_cats_multiple" if it doesn't already exist
if ( !function_exists( 'wanfv12_dropdown_cats_multiple' ) ) {
	// Function that supports multiple selects when "wp_dropdown_categories()" is called
	// in "channels-options-page.php" and "search-options-page.php" files
	function wanfv12_dropdown_cats_multiple( $output, $r ) {

		if( isset( $r['multiple'] ) && $r['multiple'] ) {

			 $output = preg_replace( '/^<select/i', '<select multiple', $output );

			$output = str_replace( "name='{$r['name']}'", "name='{$r['name']}[]'", $output );

			foreach ( array_map( 'trim', explode( ",", $r['selected'] ) ) as $value )
				$output = str_replace( "value=\"{$value}\"", "value=\"{$value}\" selected", $output );

		}

		return $output;
	}
}

