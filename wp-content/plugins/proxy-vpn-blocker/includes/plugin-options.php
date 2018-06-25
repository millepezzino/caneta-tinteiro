<?php
if ( ! defined( 'ABSPATH' ) ) exit;
class proxy_vpn_blocker_Settings {
	/**
	 * The single instance of proxy_vpn_blocker_Settings.
	 * @var 	object
	 * @access  private
	 * @since 	1.0
	 */
	private static $_instance = null;
	/**
	 * The main plugin object.
	 * @var 	object
	 * @access  public
	 * @since 	1.0
	 */
	public $parent = null;
	/**
	 * Prefix for Proxy & VPN Blocker Settings.
	 * @var     string
	 * @access  public
	 * @since   1.0
	 */
	public $base = '';
	/**
	 * Available settings for plugin.
	 * @var     array
	 * @access  public
	 * @since   1.0
	 */
	public $settings = array();
	public function __construct ( $parent ) {
		$this->parent = $parent;
		$this->base = 'pvb_';
		// Initialise settings
		add_action( 'init', array( $this, 'init_settings' ), 11 );
		// Register Proxy & VPN Blocker Settings
		add_action( 'admin_init' , array( $this, 'register_settings' ) );
		// Add settings page to menu
		add_action( 'admin_menu' , array( $this, 'add_menu_item' ) );
		// Add settings link to plugins page
		add_filter( 'plugin_action_links_' . plugin_basename( $this->parent->file ) , array( $this, 'add_settings_link' ) );
	}
	
	/**
	 * Initialise settings
	 * @return void
	 */
	public function init_settings () {
		$this->settings = $this->settings_fields();
	}
	/**
	 * Add settings page to admin menu
	 * @return void
	 */
	public function add_menu_item () {
		add_menu_page('Proxy & VPN Blocker', 'PVB', 'manage_options', $this->parent->_token . '_settings' ,  array( $this, 'settings_page' ) , 'dashicons-shield-alt');
		add_submenu_page($this->parent->_token . '_settings' , 'Information', 'API Key Information', 'manage_options', $this->parent->_token . '_information' ,  array( $this, 'information_page' ));
		global $submenu;
		$submenu[ $this->parent->_token . '_settings' ][0][0] = "Proxy & VPN Blocker";
	}
	/**
	 * Add settings link to plugin list table
	 * @param  array $links Existing links
	 * @return array 		Modified links
	 */
	 
	public function add_settings_link( $links ) {
		$settings_link = '<a href="admin.php?page=proxy_vpn_blocker_settings">' . __( 'Settings', 'proxy-vpn-blocker' ) . '</a>';
  		array_push( $links, $settings_link );
  		return $links;
	}
	
	/**
	 * Build settings fields
	 * @return array Fields to be displayed on settings page
	 */

	private function settings_fields() {
		$settings['standard'] = array(
			'title'					=> __( 'Proxy & VPN Blocker Settings', 'proxy-vpn-blocker' ),
			'description'			=> __( 'Please Configure your settings and remember to Enable Querying', 'proxy-vpn-blocker' ),
			'fields'				=> array(
				array(
					'id' 			=> 'proxycheckio_master_activation',
					'label'			=> __( 'Enable Querying?', 'proxy-vpn-blocker' ),
					'description'	=> __( 'Set this to \'on\'  to enable site protections. If set to \'off\' proxycheck.io will not be protecting this site.', 'proxy-vpn-blocker' ),
					'type'			=> 'checkbox',
					'default'		=> 'on'
				),
				array(
					'id' 			=> 'proxycheckio_API_Key_field',
					'label'			=> __( 'API Key' , 'proxy-vpn-blocker' ),
					'description'	=> __( 'Your proxycheck.io API Key.', 'proxy-vpn-blocker' ),
					'type'			=> 'apikey',
					'default'		=> '',
					'placeholder'	=> __( 'Get your API key at proxycheck.io', 'proxy-vpn-blocker' )
				),
				array(
					'id' 			=> 'proxycheckio_CLOUDFLARE_select_box',
					'label'			=> __( 'Cloudflare?', 'proxy-vpn-blocker' ),
					'description'	=> __( 'It\'s important to set this to \'on\' if you are using Cloudflare.', 'proxy-vpn-blocker' ),
					'type'			=> 'checkbox',
					'default'		=> ''
				),
				array(
					'id' 			=> 'proxycheckio_Days_Selector',
					'label'			=> __( 'Day Restrictor' , 'proxy-vpn-blocker' ),
					'description'	=> __( 'By default an IP is checked for Proxies/VPN\'s within the last 7 days, you can set this from 1 to 60 days depending on how strict you want the protection to be.', 'proxy-vpn-blocker' ),
					'type'			=> 'textslider',
					'default'		=> '7',
					'placeholder'	=> __( '7', 'proxy-vpn-blocker' )
				),
				array(
					'id' 			=> 'proxycheckio_VPN_select_box',
					'label'			=> __( 'Detect VPNs?', 'proxy-vpn-blocker' ),
					'description'	=> __( 'Set this to \'on\' to detect VPNs in addition to proxies.', 'proxy-vpn-blocker' ),
					'type'			=> 'checkbox',
					'default'		=> ''
				),
				array(
					'id' 			=> 'proxycheckio_TLS_select_box',
					'label'			=> __( 'Use TLS?', 'proxy-vpn-blocker' ),
					'description'	=> __( 'Set this to \'on\' to use transport security - this may slow down API response.', 'proxy-vpn-blocker' ),
					'type'			=> 'checkbox',
					'default'		=> ''
				),
				array(
					'id' 			=> 'proxycheckio_TAG_select_box',
					'label'			=> __( 'Custom Tag Queries?', 'proxy-vpn-blocker' ),
					'description'	=> __( 'Set this to \'on\' to allow custom tagging your queries.', 'proxy-vpn-blocker' ),
					'type'			=> 'checkbox',
					'default'		=> ''
				),
                array(
					'id' 			=> 'proxycheckio_blocked_countries_field',
					'label'			=> __( 'Blocked Countries' , 'proxy-vpn-blocker' ),
					'description'	=> __( 'You can block specific countries by adding them in this list.' ),
					'type'			=> 'select_country_multi',
                    'options'		=> array( 'Afghanistan' => 'Afghanistan', 'Albania' => 'Albania', 'Algeria' => 'Algeria', 'American Samoa' => 'American Samoa', 'Andorra' => 'Andorra', 'Angola' => 'Angola', 'Anguilla' => 'Anguilla', 'Antarctica' => 'Antarctica', 'Antigua and Barbuda' => 'Antigua and Barbuda', 'Argentina' => 'Argentina', 'Armenia' => 'Armenia', 'Aruba' => 'Aruba', 'Australia' => 'Australia', 'Austria' => 'Austria', 'Azerbaijan' => 'Azerbaijan', 'Bahamas' => 'Bahamas', 'Bahrain' => 'Bahrain', 'Bangladesh' => 'Bangladesh', 'Barbados' => 'Barbados', 'Belarus' => 'Belarus', 'Belgium' => 'Belgium', 'Belize' => 'Belize', 'Benin' => 'Benin', 'Bermuda' => 'Bermuda', 'Bhutan' => 'Bhutan', 'Bolivia' => 'Bolivia', 'Bonaire' => 'Bonaire', 'Bosnia and Herzegovina' => 'Bosnia and Herzegovina', 'Botswana' => 'Botswana', 'Bouvet Island' => 'Bouvet Island', 'Brazil' => 'Brazil', 'British Indian Ocean Territory' => 'British Indian Ocean Territory', 'British Virgin Islands' => 'British Virgin Islands', 'Brunei' => 'Brunei', 'Bulgaria' => 'Bulgaria', 'Burkina Faso' => 'Burkina Faso', 'Burundi' => 'Burundi', 'Cabo Verde' => 'Cabo Verde', 'Cambodia' => 'Cambodia', 'Cameroon' => 'Cameroon', 'Canada' => 'Canada', 'Cayman Islands' => 'Cayman Islands', 'Central African Republic' => 'Central African Republic', 'Chad' => 'Chad', 'Chile' => 'Chile', 'China' => 'China', 'Christmas Island' => 'Christmas Island', 'Cocos [Keeling] Islands' => 'Cocos [Keeling] Islands', 'Colombia' => 'Colombia', 'Comoros' => 'Comoros', 'Congo' => 'Congo', 'Cook Islands' => 'Cook Islands', 'Costa Rica' => 'Costa Rica', 'Croatia' => 'Croatia', 'Cuba' => 'Cuba', 'Curaçao' => 'Curaçao', 'Cyprus' => 'Cyprus', 'Czechia' => 'Czechia', 'Democratic Republic of Timor-Leste' => 'Democratic Republic of Timor-Leste', 'Denmark' => 'Denmark', 'Djibouti' => 'Djibouti', 'Dominica' => 'Dominica', 'Dominican Republic' => 'Dominican Republic', 'Ecuador' => 'Ecuador', 'Egypt' => 'Egypt', 'El Salvador' => 'El Salvador', 'Equatorial Guinea' => 'Equatorial Guinea', 'Eritrea' => 'Eritrea', 'Estonia' => 'Estonia', 'Ethiopia' => 'Ethiopia', 'Falkland Islands' => 'Falkland Islands', 'Faroe Islands' => 'Faroe Islands', 'Federated States of Micronesia' => 'Federated States of Micronesia', 'Fiji' => 'Fiji', 'Finland' => 'Finland', 'France' => 'France', 'French Guiana' => 'French Guiana', 'French Polynesia' => 'French Polynesia', 'French Southern Territories' => 'French Southern Territories', 'Gabon' => 'Gabon', 'Gambia' => 'Gambia', 'Georgia' => 'Georgia', 'Germany' => 'Germany', 'Ghana' => 'Ghana', 'Gibraltar' => 'Gibraltar', 'Greece' => 'Greece', 'Greenland' => 'Greenland', 'Grenada' => 'Grenada', 'Guadeloupe' => 'Guadeloupe', 'Guam' => 'Guam', 'Guatemala' => 'Guatemala', 'Guernsey' => 'Guernsey', 'Guinea' => 'Guinea', 'Guinea-Bissau' => 'Guinea-Bissau', 'Guyana' => 'Guyana', 'Haiti' => 'Haiti', 'Hashemite Kingdom of Jordan' => 'Hashemite Kingdom of Jordan', 'Heard Island and McDonald Islands' => 'Heard Island and McDonald Islands', 'Honduras' => 'Honduras', 'Hong Kong' => 'Hong Kong', 'Hungary' => 'Hungary', 'Iceland' => 'Iceland', 'India' => 'India', 'Indonesia' => 'Indonesia', 'Iran' => 'Iran', 'Iraq' => 'Iraq', 'Ireland' => 'Ireland', 'Isle of Man' => 'Isle of Man', 'Israel' => 'Israel', 'Italy' => 'Italy', 'Ivory Coast' => 'Ivory Coast', 'Jamaica' => 'Jamaica', 'Japan' => 'Japan', 'Jersey' => 'Jersey', 'Kazakhstan' => 'Kazakhstan', 'Kenya' => 'Kenya', 'Kiribati' => 'Kiribati', 'Kosovo' => 'Kosovo', 'Kuwait' => 'Kuwait', 'Kyrgyzstan' => 'Kyrgyzstan', 'Laos' => 'Laos', 'Latvia' => 'Latvia', 'Lebanon' => 'Lebanon', 'Lesotho' => 'Lesotho', 'Liberia' => 'Liberia', 'Libya' => 'Libya', 'Liechtenstein' => 'Liechtenstein', 'Luxembourg' => 'Luxembourg', 'Macao' => 'Macao', 'Macedonia' => 'Macedonia', 'Madagascar' => 'Madagascar', 'Malawi' => 'Malawi', 'Malaysia' => 'Malaysia', 'Maldives' => 'Maldives', 'Mali' => 'Mali', 'Malta' => 'Malta', 'Marshall Islands' => 'Marshall Islands', 'Martinique' => 'Martinique', 'Mauritania' => 'Mauritania', 'Mauritius' => 'Mauritius', 'Mayotte' => 'Mayotte', 'Mexico' => 'Mexico', 'Monaco' => 'Monaco', 'Mongolia' => 'Mongolia', 'Montenegro' => 'Montenegro', 'Montserrat' => 'Montserrat', 'Morocco' => 'Morocco', 'Mozambique' => 'Mozambique', 'Myanmar [Burma]' => 'Myanmar [Burma]', 'Namibia' => 'Namibia', 'Nauru' => 'Nauru', 'Nepal' => 'Nepal', 'Netherlands' => 'Netherlands', 'New Caledonia' => 'New Caledonia', 'New Zealand' => 'New Zealand', 'Nicaragua' => 'Nicaragua', 'Niger' => 'Niger', 'Nigeria' => 'Nigeria', 'Niue' => 'Niue', 'Norfolk Island' => 'Norfolk Island', 'North Korea' => 'North Korea', 'Northern Mariana Islands' => 'Northern Mariana Islands', 'Norway' => 'Norway', 'Oman' => 'Oman', 'Pakistan' => 'Pakistan', 'Palau' => 'Palau', 'Palestine' => 'Palestine', 'Panama' => 'Panama', 'Papua New Guinea' => 'Papua New Guinea', 'Paraguay' => 'Paraguay', 'Peru' => 'Peru', 'Philippines' => 'Philippines', 'Pitcairn Islands' => 'Pitcairn Islands', 'Poland' => 'Poland', 'Portugal' => 'Portugal', 'Puerto Rico' => 'Puerto Rico', 'Qatar' => 'Qatar', 'Republic of Korea' => 'Republic of Korea', 'Republic of Lithuania' => 'Republic of Lithuania', 'Republic of Moldova' => 'Republic of Moldova', 'Republic of the Congo' => 'Republic of the Congo', 'Romania' => 'Romania', 'Russia' => 'Russia', 'Rwanda' => 'Rwanda', 'Réunion' => 'Réunion', 'Saint Helena' => 'Saint Helena', 'Saint Lucia' => 'Saint Lucia', 'Saint Martin' => 'Saint Martin', 'Saint Pierre and Miquelon' => 'Saint Pierre and Miquelon', 'Saint Vincent and the Grenadines' => 'Saint Vincent and the Grenadines', 'Saint-Barthélemy' => 'Saint-Barthélemy', 'Samoa' => 'Samoa', 'San Marino' => 'San Marino', 'Saudi Arabia' => 'Saudi Arabia', 'Senegal' => 'Senegal', 'Serbia' => 'Serbia', 'Seychelles' => 'Seychelles', 'Sierra Leone' => 'Sierra Leone', 'Singapore' => 'Singapore', 'Sint Maarten' => 'Sint Maarten', 'Slovakia' => 'Slovakia', 'Slovenia' => 'Slovenia', 'Solomon Islands' => 'Solomon Islands', 'Somalia' => 'Somalia', 'South Africa' => 'South Africa', 'South Georgia and the South Sandwich Islands' => 'South Georgia and the South Sandwich Islands', 'South Sudan' => 'South Sudan', 'Spain' => 'Spain', 'Sri Lanka' => 'Sri Lanka', 'St Kitts and Nevis' => 'St Kitts and Nevis', 'Sudan' => 'Sudan', 'Suriname' => 'Suriname', 'Svalbard and Jan Mayen' => 'Svalbard and Jan Mayen', 'Swaziland' => 'Swaziland', 'Sweden' => 'Sweden', 'Switzerland' => 'Switzerland', 'Syria' => 'Syria', 'São Tomé and Príncipe' => 'São Tomé and Príncipe', 'Taiwan' => 'Taiwan', 'Tajikistan' => 'Tajikistan', 'Tanzania' => 'Tanzania', 'Thailand' => 'Thailand', 'Togo' => 'Togo', 'Tokelau' => 'Tokelau', 'Tonga' => 'Tonga', 'Trinidad and Tobago' => 'Trinidad and Tobago', 'Tunisia' => 'Tunisia', 'Turkey' => 'Turkey', 'Turkmenistan' => 'Turkmenistan', 'Turks and Caicos Islands' => 'Turks and Caicos Islands', 'Tuvalu' => 'Tuvalu', 'U.S. Minor Outlying Islands' => 'U.S. Minor Outlying Islands', 'U.S. Virgin Islands' => 'U.S. Virgin Islands', 'Uganda' => 'Uganda', 'Ukraine' => 'Ukraine', 'United Arab Emirates' => 'United Arab Emirates', 'United Kingdom' => 'United Kingdom', 'United States' => 'United States', 'Uruguay' => 'Uruguay', 'Uzbekistan' => 'Uzbekistan', 'Vanuatu' => 'Vanuatu', 'Vatican City' => 'Vatican City', 'Venezuela' => 'Venezuela', 'Vietnam' => 'Vietnam', 'Wallis and Futuna' => 'Wallis and Futuna', 'Western Sahara' => 'Western Sahara', 'Yemen' => 'Yemen', 'Zambia' => 'Zambia', 'Zimbabwe' => 'Zimbabwe', 'Åland' => 'Åland' ),
					'placeholder'	=> __( 'Select a country or search...', 'proxy-vpn-blocker' )
				),
				array(
					'id' 			=> 'proxycheckio_Custom_TAG_field',
					'label'			=> __( 'Custom Tag' , 'proxy-vpn-blocker' ),
					'description'	=> __( 'By default the tag used is your domain and the webpage being accessed, however you can supply your own descriptive tag or disable custom tagging above.', 'proxy-vpn-blocker' ),
					'type'			=> 'text',
					'default'		=> '',
					'placeholder'	=> __( 'Custom Tag', 'proxy-vpn-blocker' )
				),
				array(
					'id' 			=> 'proxycheckio_denied_access_field',
					'label'			=> __( 'Access Denied Message' , 'proxy-vpn-blocker' ),
					'description'	=> __( 'You can enter a custom Access Denied message here' ),
					'type'			=> 'text',
					'default'		=> 'Proxy or VPN detected - Please disable to access this website!',
					'placeholder'	=> __( 'Custom Access Denied Message', 'proxy-vpn-blocker' )
				),
                array(
					'id' 			=> 'proxycheckio_all_pages_activation',
					'label'			=> __( 'Block on all pages?', 'proxy-vpn-blocker' ),
					'description'	=> __( 'Set this to \'on\' to block Proxies/VPN\'s on every page. This is at the expense of higher query usage and is NOT generally recommended.' . '<p><strong>' . 'Warning: This will not work if you are using a caching plugin. Please see FAQ.' . '<strong></p>', 'proxy-vpn-blocker' ),
					'type'			=> 'checkbox',
					'default'		=> ''
				),
			)
		);
		$settings = apply_filters( 'plugin_settings_fields', $settings );
		return $settings;
	}
	/**
	 * Register Proxy & VPN Blocker Settings
	 * @return void
	 */
	public function register_settings () {
		if ( is_array( $this->settings ) ) {
			// Check posted/selected tab
			$current_section = '';
			if ( isset( $_POST['tab'] ) && $_POST['tab'] ) {
				$current_section = $_POST['tab'];
			} else {
				if ( isset( $_GET['tab'] ) && $_GET['tab'] ) {
					$current_section = $_GET['tab'];
				}
			}
			foreach ( $this->settings as $section => $data ) {
				if ( $current_section && $current_section != $section ) continue;
				// Add section to page
				add_settings_section( $section, $data['title'], array( $this, 'settings_section' ), $this->parent->_token . '_settings' );
				foreach ( $data['fields'] as $field ) {
					// Validation callback for field
					$validation = '';
					if ( isset( $field['callback'] ) ) {
						$validation = $field['callback'];
					}
					// Register field
					$option_name = $this->base . $field['id'];
					register_setting( $this->parent->_token . '_settings', $option_name, $validation );
					// Add field to page
					add_settings_field( $field['id'], $field['label'], array( $this->parent->admin, 'display_field' ), $this->parent->_token . '_settings', $section, array( 'field' => $field, 'prefix' => $this->base ) );
				}
				if ( ! $current_section ) break;
			}
		}
	}
	public function settings_section ( $section ) {
		$html = '<p> ' . $this->settings[ $section['id'] ]['description'] . '</p>' . "\n";
		echo $html;
	}

	/**
	 * Validate individual settings field
	 * @param  string $data Inputted value
	 * @return string       Validated value
	 */
	public function validate_field( $data ) {
		if( $data && strlen( $data ) > 0 && $data != '' ) {
			$data = urlencode( strtolower( str_replace( ' ' , '-' , $data ) ) );
		}
		return $data;
	}
	/**
	 * Load settings page content
	 * @return void
	 */
	public function settings_page () {
		// Build page HTML
		$html = '<div class="wrap" id="' . $this->parent->_token . '_settings">' . "\n";
        $html .= '<h1>' . __('Proxy &amp; VPN Blocker', 'proxy-vpn-blocker') . '</h1>' . "\n";
                if(!isset($_COOKIE['pvb-hide-donation-div'])) {
                    $html .= '<div class="pvbdonationsoffer" id="pvbdonationhide">
                    <h3>Donation Offer:</h3>
						<p>In agreement with <a href="https://proxycheck.io" target="_blank">proxycheck.io</a> this plugin is able to offer you a discount on <u>one year</u> of the 10,000 daily queries package if you donate $15 to this plugin (usual price $19.10). Please provide the email address you signed up to proxycheck.io with in the "Add a note" section when you donate so we can process adding this to your account with proxycheck.io within one day! If you provide no email addess it will be considered a regular donation.</p><p> Thank you for your support!</p>
						<div class="pvbdonationslinks">
                            <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=me%40ricksterm%2enet&lc=GB&item_name=WordPress%20Proxy%20%26%20VPN%20Blocker%20Plugin%20Donations&currency_code=USD&bn=PP%2dDonationsBF%3appbutton%2epng%3aNonHosted" target="_blank"><button class="pvbdefault">Donate</button></a>|<button class="pvbdismiss" id="pvbdonationclosebutton">Close This</button>
                        </div>
                    </div>' . "\n";
                }
        $html .= '<div class="pvbinfowrap">' . "\n";
            $html .= '<div class="pvbinfowrapleft"><div class="pvbinfowraplogoinside"></div></div>' . "\n";
            $html .= '<div class="pvbinfowraptext">' . "\n";
                $html .= '<h2>' . __('Proxy &amp; VPN Blocker Details', 'proxy-vpn-blocker') . '</h2>' . "\n";
		      $html .= '<p>' . __('Using the <a href="https://proxycheck.io">proxycheck.io</a> API this plugin will prevent Proxies and optionally VPN\'s or even specific Countries accessing your WordPress site\'s Login & Registration pages and also prevent them from making comments on your pages and posts.', 'proxy-vpn-blocker') . '</p>' . "\n";
		      $html .= '<h4>' . __('Please see below how the API plans work. Visit <a href="https://proxycheck.io">proxycheck.io</a> for your free API key.', 'proxy-vpn-blocker') . '</h4>' . "\n";
                $html .= '<ul class="pvblists">' . "\n";
                $html .= '<li>' . __('Free Users without an API Key = 100 Daily Queries ', 'proxy-vpn-blocker') . '</li>' . "\n";
                $html .= '<li>' . __('Free Users with an API Key = 1000 Daily Queries', 'proxy-vpn-blocker') . '</li>' . "\n";
                $html .= '<li>' . __('Paid Users with an API Key = 10,000 to 10.24 Million+ Daily Queries', 'proxy-vpn-blocker') . '</li>' . "\n";
                $html .= '</li>' . "\n";
			$html .= '</div>' . "\n";
        $html .= '</div>' . "\n";
        $html .= '<div class="pvboptionswrap">' . "\n";
            $html .= '<form method="post" action="options.php" enctype="multipart/form-data">' . '</p>' . "\n";
				// Get settings fields
				ob_start();
				settings_fields( $this->parent->_token . '_settings' );
				do_settings_sections( $this->parent->_token . '_settings' );
				$html .= ob_get_clean();
				$html .= '<p class="submit">' . "\n";
					$html .= '<input type="hidden" name="tab" value="" />' . "\n";
					$html .= '<input name="Submit" type="submit" class="pvbdefault" value="' . esc_attr( __( 'Save Settings' , 'proxy-vpn-blocker' ) ) . '" />' . "\n";
				$html .= '</p>' . "\n";
			$html .= '</form>' . "\n";
		  $html .= '</div>' . "\n";
        $html .= '</div>' . "\n";
		echo $html;
	}
	/**
	 * Load Information and Statistics page content
	 * @return void
	 */
	public function information_page () {
        $getapikey=get_option('pvb_proxycheckio_API_Key_field');
		if ( !empty ( $getapikey ) ) {
			// Build page HTML
			echo "<div class=\"wrap\" id=" . $this->parent->_token . '_information' . ">" . "\n";
            echo "<h1>" . __( 'Your proxycheck.io API Key Information' , 'proxy-vpn-blocker' ) . "</h1>" . "\n";
            echo "<div class='pvboptionswrap'>" . "\n";
			$requestargs = array(
				'timeout' => '5',
				'blocking' => true,
				'httpversion' => '1.1',
			);
            $RequestUsage = wp_remote_get('https://proxycheck.io/dashboard/export/usage/?key=' . get_option('pvb_proxycheckio_API_Key_field'), $requestargs);
			$API_Key_Usage = json_decode(wp_remote_retrieve_body($RequestUsage), true);
            /** Format and Display usage stats **/
            $Queries_Today = $API_Key_Usage['Queries Today'];
            $Daily_Limit = $API_Key_Usage['Daily Limit'];
            $Queries_Total = $API_Key_Usage['Queries Total'];
            $Plan_Tier = $API_Key_Usage['Plan Tier'];
            echo "<div class='pvbapidaily'>";
                 echo "<div class='pvbapikey'>" . __( 'API Key: ' , 'proxy-vpn-blocker' ) . get_option('pvb_proxycheckio_API_Key_field') . "</div>" . "\n";
                echo "<div class='pvbapitier'>" . __( 'Plan: ' , 'proxy-vpn-blocker' ) . $Plan_Tier . "</div>" . "\n";
            echo "</div>";
            echo "<div class='pvbapiusageday'>";
                $usagepercent = ($Queries_Today * 100) / $Daily_Limit;
                echo ' API Key Usage Today: ' .  number_format ($Queries_Today) . '/' .  number_format ($Daily_Limit) . ' Queries - ' .  round($usagepercent, 2) . '% of Total.';
                echo "<div class='pvbpercentbar' style='width:100%'>";
                echo "<div style='width: $usagepercent%'>";
                echo "</div> </div>";
            echo "</div>";
            
            echo "<h3>" . __( 'API Key Queries: Past Month' , 'proxy-vpn-blocker' ) . "</h3>" . "\n";
			/** Get API Key statistics and display them on the page **/	
			$request1 = wp_remote_get('https://proxycheck.io/dashboard/export/queries/?json=1&key=' . get_option('pvb_proxycheckio_API_Key_field'), $requestargs);
			$API_Key_Stats = json_decode(wp_remote_retrieve_body($request1));
			/** Format and Display month stats **/
			$Proxy_Total = null;
			$VPN_Total = null;
			$Undetected_Total = null;
			$Refused_Total = null;
			$Query_Total = null;
			foreach ($API_Key_Stats as $Day) {
				$Proxy_Total = $Day->proxies + $Proxy_Total;
				$VPN_Total = $Day->vpns + $VPN_Total;
				$Undetected_Total = $Day->undetected + $Undetected_Total;
				$Refused_Total = $Day->{'refused queries'} + $Refused_Total;
				$Query_Total = $Proxy_Total + $VPN_Total + $Undetected_Total + $Refused_Total;
			}
            
            $responseAPIMonth = array();
            $countday = 0;
            foreach ($API_Key_Stats as $key=>$value) {  
                try {
                    $data = array();
                    $data["days"] = $countday++;
                    $data["proxies"] = $value->proxies;
                    $data["vpns"] = $value->vpns;
                    $data["undetected"] = $value->undetected;
                    $data["refused queries"] = $value->{'refused queries'};
                    array_push($responseAPIMonth, $data);
                } catch (ErrorException $e) {
                    echo "We couldn't fetch these statistics right now, please try again!";
                }
            }
            $reverseorder = array_reverse($responseAPIMonth);
            $result = json_encode($reverseorder); 
            
            
            // month stats graph
            echo '<script type="text/javascript">
                    var chart = AmCharts.makeChart("amchartAPImonth", {
                        "type": "serial",
                        "theme": "light",
                        "legend": {
                            "align": "center",
                            "equalWidths": false,
                            "periodValueText": "[[value.sum]]",
                            "valueAlign": "left",
                            "valueText": "[[value]]",
                            "valueWidth": 100
                        },
                        "dataProvider": ' . $result . ',
                        "plotAreaBorderAlpha": 0,
                        "marginLeft": 0,
                        "marginBottom": 0,
                        "chartCursor": {
                            "cursorAlpha": 0
                        },
                        "valueAxes": [{
                            "stackType": "regular",
                            "gridAlpha": 0.07,
                            "position": "left",
                            "title": "Day Total"
                        }],
                        "graphs": [{
                            "balloonText": "<span style=\'font-size:14px; color:#000000;\'><b>Undetected: [[value]]</b></span>",
                            "fillAlphas": 0.6,
                            "type": "smoothedLine",
                            "title": "Undetected",
                            "valueField": "undetected",
                            "stackable": false
                        }, {
                            "balloonText": "<span style=\'font-size:14px; color:#000000;\'><b>Proxies: [[value]]</b></span>",
                            "fillAlphas": 0.6,
                            "type": "smoothedLine",
                            "title": "Proxies",
                            "valueField": "proxies",
                            "stackable": false
                        }, {
                            "balloonText": "<span style=\'font-size:14px; color:#000000;\'><b>VPN\'s: [[value]]</b></span>",
                            "fillAlphas": 0.6,
                            "type": "smoothedLine",
                            "title": "VPN\'s",
                            "valueField": "vpns",
                            "stackable": false
                        }, {
                            "balloonText": "<span style=\'font-size:14px; color:#000000;\'><b>Refused Queries: [[value]]</b></span>",
                            "fillAlphas": 0.6,
                            "type": "smoothedLine",
                            "title": "Refused Queries",
                            "valueField": "refused queries",
                            "stackable": false
                        }],
                        "plotAreaBorderAlpha": 0,
                        "marginTop": 10,
                        "marginLeft": 0,
                        "marginBottom": 0,
                        "categoryField": "days",
                        "categoryAxis": {
                            "startOnAxis": true,
                            "axisColor": "#DADADA",
                            "gridAlpha": 0.07,
                            "title": "Days"
                        },
                         "guides": [{
                            category: "0",
                            lineColor: "#CC0000",
                            lineAlpha: 0,
                            dashLength: 2,
                            inside: true,
                            labelRotation: 90,
                            label: "Today",
                            position: "bottom"
                            }, {
                            category: "1",
                            lineAlpha: 0,
                            lineColor: "#CC0000",
                            dashLength: 2,
                            inside: true,
                            labelRotation: 90,
                            label: "Yesterday",
                            position: "bottom"
                            }, {
                            category: "28",
                            lineColor: "#CC0000",
                            lineAlpha: 0,
                            dashLength: 2,
                            inside: true,
                            labelRotation: 90,
                            label: "A Month Ago",
                            position: "bottom",
                            expand: "true"
                            }]
                        });
                </script>
            ';
            echo '<div id="amchartAPImonth" style="width: 100%; height: 400px;"></div>';
            echo '<p>' . __( '*Statistics delayed by several minutes.' , 'proxy-vpn-blocker' ) . '</p>' . "\n";
            echo '</div>';
			/** Get recent detection stats **/
            echo "<div class='pvboptionswrap'>" . "\n";
			echo '<h3>' . __( 'API Key Recent Positive Detections for this site or tag' , 'proxy-vpn-blocker' ) . '</h3>' . "\n";
			$request2 = wp_remote_get('https://proxycheck.io/dashboard/export/detections/?json=1&key=' . get_option('pvb_proxycheckio_API_Key_field') . '&limit=100', $requestargs);
			$API_Recent_Detections = json_decode(wp_remote_retrieve_body($request2));
			echo '<table class="statsfancy">
				<thead>
					<tr>
						<th>#</th>
						<th>Date / Time</th>
						<th>IP Address</th> 
						<th>Country</th> 
						<th>Type</th> 
						<th>Node</th>
						<th>Tag</th>
					</tr>
				</thead>';
				echo '<tbody>';
			$counter = 1;
			foreach ($API_Recent_Detections as $Entry) {
				if( stripos($Entry->tag, get_option('pvb_proxycheckio_Custom_TAG_field')) !== false or stripos($Entry->tag, $_SERVER['HTTP_HOST']) !== false) {
                    try {
                        echo "<tr>";
                        echo "<td>" . $counter++ . "</td>";
                        echo "<td>" . date('D M jS Y - g:i a',$Entry->{'time raw'}) . "</td>";
                        echo "<td>" . $Entry->address . "</td>";
                        echo "<td>" . $Entry->{'country'} . "</td>";
                        echo "<td>" . $Entry->{'detection type'} . "</td>";
                        echo "<td>" . $Entry->{'answering node'} . "</td>";
                        echo "<td>" . $Entry->tag . "</td>";
                        echo "</tr>";
                    } catch(ErrorException $e) {
                        echo "We couldn't fetch these statistics right now, please try again!";
                    }
			     }
            }
			echo '</tbody>';
			echo '</table>';
			echo '<p>' . __( '*This Log will only show entries from this WordPress site or your set tag, if there are no recent detections in the last 100 entries for the API Key, the table will be empty! You can view all entries on your proxycheck.io dashboard' , 'proxy-vpn-blocker' ) . '</p>' . "\n";
            echo '</div>';
            
		} else {
			echo "<div class=\"wrap\" id=" . $this->parent->_token . '_information' . ">" . "\n";
				echo "<div class=\"pvberror\">" . "\n";
					echo "<div class=\"pvberrortitle\">" . __( 'Oops!' , 'proxy-vpn-blocker' ) . "</div>" . "\n";
					echo "<div class=\"pvberrorinside\">" . "\n";
						echo "<h2>" . __( 'Please set a <a href="https://proxycheck.io" target="_blank">proxycheck.io</a> API Key to see this page!', 'proxy-vpn-blocker') . "</h2>" . "\n";
						echo "<h3>" . __( 'This page will display stats about your API Key queries and recent detections.' , 'proxy-vpn-blocker' ) . "</h3>" . "\n";
						echo "<h3>" . __( 'If you need an API Key they are free for up to 1000 daily queries, paid plans are available with more.' , 'proxy-vpn-blocker' ) . "</h3>" . "\n";
					echo"</div>" . "\n";
				echo"</div>" . "\n";
			echo"</div>";
		}
		
	}
	/**
	 * Main proxy_vpn_blocker_Settings Instance
	 *
	 * Ensures only one instance of proxy_vpn_blocker_Settings is loaded or can be loaded.
	 *
	 * @since 1.0
	 * @static
	 * @see proxy_vpn_blocker()
	 * @return Main proxy_vpn_blocker_Settings instance
	 */
	public static function instance ( $parent ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $parent );
		}
		return self::$_instance;
	} // End instance()
	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0
	 */
	public function __clone () {
		_doing_it_wrong( __FUNCTION__, __( 'Cloning is forbidden.' ), $this->parent->_version );
	} // End __clone()
	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0
	 */
	public function __wakeup () {
		_doing_it_wrong( __FUNCTION__, __( 'Unserializing instances of this class is forbidden.' ), $this->parent->_version );
	} // End __wakeup()
}
?>