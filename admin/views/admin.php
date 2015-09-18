<?php
/**
 * @package   BP_Profile_Tabs
 * @author    Jacob Schweitzer <allambition@gmail.com>
 * @license   GPL-2.0+
 * @link      http://ijas.me
 * @copyright 2014 Jacob Schweitzer
 */
?>



<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	
		
			<?php
			$prefix = 'bpt_';
			$option_fields = array(
				'id' => 'bp_profile_tabs_option',
				'show_on' => array( 'key' => 'options-page', 'value' => array( 'bp-profile-tabs' ), ),
				'show_names' => true,
				'fields' => array(
					array(
					    'name'    => __( 'jQuery UI Theme', $this->plugin_slug ),
					    'desc'    => __( 'Select a JQuery UI Theme to fit in with your WordPress theme', $this->plugin_slug ),
					    'id'      => $prefix . 'theme',
					    'type'    => 'select',
					    'options' => array(
							'black-tie' => __( 'Black Tie', $this->plugin_slug ),
							'blitzer' => __( 'Blitzer', $this->plugin_slug ),
							'cupertino' => __( 'Cupertino', $this->plugin_slug ),
							'dark-hive' => __( 'Dark Hive', $this->plugin_slug ),
							'dot-luv' => __( 'Dot Luv', $this->plugin_slug ),
							'eggplant' => __( 'Eggplant', $this->plugin_slug ),
							'excite-bike' => __( 'Excite Bike', $this->plugin_slug ),
							'flick' => __( 'Flick', $this->plugin_slug ),
							'hot-sneaks' => __( 'Hot Sneaks', $this->plugin_slug ),
							'humanity' => __( 'Humanity', $this->plugin_slug ),
							'le-frog' => __( 'Le Frog', $this->plugin_slug ),
							'mint-choc' => __( 'Mint Choc', $this->plugin_slug ),
							'overcast' => __( 'Overcast', $this->plugin_slug ),
							'pepper-grinder' => __( 'Pepper Grinder', $this->plugin_slug ),
							'redmond' => __( 'Redmond', $this->plugin_slug ),
							'smoothness' => __( 'Smoothness', $this->plugin_slug ),
							'south-street' => __( 'South Street', $this->plugin_slug ),
							'start' => __( 'Start', $this->plugin_slug ),
							'sunny' => __( 'Sunny', $this->plugin_slug ),
							'swanky-purse' => __( 'Swanky Purse', $this->plugin_slug ),
							'trontastic' => __( 'Trontastic', $this->plugin_slug ),
							'ui-darkness' => __( 'Ui Darkness', $this->plugin_slug ),
							'ui-lightness' => __( 'Ui lightness', $this->plugin_slug ),
							'vader' => __( 'Vader', $this->plugin_slug ),
					    ),
					    'default' => 'cupertino',
					),
					array(
					    'name'    => __( 'CDN', $this->plugin_slug ),
					    'desc'    => __( 'Select an Content Delivery Network to serve the jQuery UI theme from', $this->plugin_slug ),
					    'id'      => $prefix . 'cdn',
					    'type'    => 'select',
					    'options' => array(
					        'google' => __( 'Google', $this->plugin_slug ),
					        'microsoft'   => __( 'Microsoft', $this->plugin_slug ),
					        'jquery'   => __( 'jQuery (MaxCDN)', $this->plugin_slug ),
					    ),
					    'default' => 'google',
					),
					array(
					    'name'    => __( 'Custom jQuery UI Theme', $this->plugin_slug ),
					    'desc'    => __( 'Enter a URL to a custom jQuery UI theme to replace the defaults above.', $this->plugin_slug ),
					    'id'      => $prefix . 'custom',
					    'type'    => 'text',
					    'default' => '',
					),
				),
			);
			
			$member_types = bp_get_member_types( array(), 'objects' );
			if ( !empty( $member_types ) ) {
				//$option_fields['fields']['member_types'] = array();
				global $wpdb;
				$profile_field_groups_query = 'SELECT id, name FROM `'.$wpdb->prefix.'bp_xprofile_groups` order by group_order';
				$this->groups_list = $wpdb->get_results($profile_field_groups_query);
				$tab_options = array( );
				$default_options = array( );
				foreach ( $this->groups_list as $group ) {
					//echo '<li><a href="#tabs-'.$group->id.'">';
					//echo $group->name;
					//echo '</a></li>';
					$tab_options[$group->id] = $group->name;
					$default_options[] = $group->id;
				}
				foreach ( $member_types as $member_type ) {
					$option_fields['fields']['member_types_' . $member_type->name] = array(
						'name'    => __( 'Tabs to show for ' . $member_type->name . ' member type', $this->plugin_slug ),
					    'desc'    => __( 'Select the tabs '.$member_type->name.' can see', $this->plugin_slug ),
					    'id'      => $prefix . 'member_types_' . $member_type->name,
					    'type'    => 'multicheck',
					    'options' => $tab_options,
					    'default' => $default_options,
					);
				}
			}
			cmb_metabox_form( $option_fields, 'bp_profile_tabs_option' );

	?>
		
	<br/><br/>
	
	<h2><?php _e( 'Example Tabs', $this->plugin_slug ) ?></h2>

	<div id="tabs">
		<ul>
			<li>
				<a href="#tabs-1"><?php _e( 'Tab 1', $this->plugin_slug ) ?></a>
			</li>
			<li>
				<a href="#tabs-2"><?php _e( 'Tab 2', $this->plugin_slug ) ?></a>
			</li>
		</ul>

		<div id="tabs-1" >
			<div class="bp-widget base">
				<h3><?php _e( 'Tab 1', $this->plugin_slug ) ?></h3>
				<?php _e( 'Example data...', $this->plugin_slug ) ?>
			</div>
		</div>
		<div id="tabs-2" >
			<div class="bp-widget base">
				<h4><?php _e( 'Tab 2', $this->plugin_slug ) ?></h4>
				<?php _e( 'More example data...', $this->plugin_slug ) ?>
			</div>
		</div>
	</div>	
		
		
		<br/><br/>
		<div class="postbox">
			<h3><span><?php _e( 'Export Settings', $this->plugin_slug ); ?></span></h3>
			<div class="inside">
				<p><?php _e( 'Export the plugin settings for this site as a .json file. This allows you to easily import the configuration into another site.', $this->plugin_slug ); ?></p>
				<form method="post">
					<p><input type="hidden" name="pn_action" value="export_settings" /></p>
					<p>
						<?php wp_nonce_field( 'pn_export_nonce', 'pn_export_nonce' ); ?>
						<?php submit_button( __( 'Export' ), 'secondary', 'submit', false ); ?>
					</p>
				</form>
			</div>
		

		
			<h3><span><?php _e( 'Import Settings', $this->plugin_slug ); ?></span></h3>
			<div class="inside">
				<p><?php _e( 'Import the plugin settings from a .json file. This file can be obtained by exporting the settings on another site using the form above.', $this->plugin_slug ); ?></p>
				<form method="post" enctype="multipart/form-data">
					<p>
						<input type="file" name="import_file"/>
					</p>
					<p>
						<input type="hidden" name="pn_action" value="import_settings" />
						<?php wp_nonce_field( 'pn_import_nonce', 'pn_import_nonce' ); ?>
						<?php submit_button( __( 'Import' ), 'secondary', 'submit', false ); ?>
					</p>
				</form>
		
			</div>
		</div>
</div>

