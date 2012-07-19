<?php

/* A plugin to use WP-reCAPTCHA in Contact Form 7.
 * This class needs WP-reCAPTCHA and Contact Form 7 plugin installed and activated.
 * http://wordpress.org/extend/plugins/wp-recaptcha/
 * http://wordpress.org/extend/plugins/contact-form-7/
 */


require_once('WPASDPlugin.class.php');

if (!class_exists('CF7reCAPTCHA')) {

    class CF7reCAPTCHA extends WPASDPlugin {
        
        const RECAPTCHATOOL_BWP_RECAPTCHA = "bwp-recaptcha";
        const RECAPTCHATOOL_WP_RECAPTCHA = "wp-recaptcha";
        
        private $recaptcha_options_name = array(
            CF7reCAPTCHA::RECAPTCHATOOL_BWP_RECAPTCHA => "bwp_capt_theme",
            CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA => "recaptcha_options"
        );
        
        private $theme_option_name = array(
            CF7reCAPTCHA::RECAPTCHATOOL_BWP_RECAPTCHA => 'select_theme',
            CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA => 'theme_selection'
        );
        
        private $language_option_name = array(
            CF7reCAPTCHA::RECAPTCHATOOL_BWP_RECAPTCHA => 'select_lang',
            CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA => 'language_selection'
        );
        
        private $recaptcha_tools = array(
            CF7reCAPTCHA::RECAPTCHATOOL_BWP_RECAPTCHA => "Better WordPress reCAPTCHA",
            CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA => "WP-reCAPTCHA"
        );
	
    
	// member variables
	private $is_useable;
	
        private $recaptcha_tool = '';
	
	// php4 Constructor
	function CF7reCAPTCHA($options_name, $textdomain_name) {
	    
	    $args = func_get_args();
	    call_user_func_array(array(&$this, "__construct"), $args);
	}
	
	
	// php5 Constructor
	function __construct($options_name, $textdomain_name) {
	    parent::__construct($options_name, $textdomain_name);
	    
	}
	
	function getClassFile() {
	    return __FILE__;
	}
	
	
	function pre_init() {
	    
	    // require the libraries
	    $this->require_library();
	    
	}
	
	
	function post_init() {
	
	    // register CF7 hooks
	    $this->register_cf7();
	    
	}
	
	// set the default options
	function register_default_options() {
	    if (is_array($this->options) && isset($this->options['reset_on_activate']) && $this->options['reset_on_activate'] !== 'on')
		return;	
		
	    $default_options = $this->get_default_options();
	    
	    
	    // add the options based on the environment
	    WPASDPlugin::update_options($this->options_name, $default_options);
	}
        
        function get_default_options() {
            $default_options = array();
	    
	    // reset on aktivate
	    $default_options['reset_on_activate'] = 'on';
	    
            // for wp-recaptcha one of {'comments_theme', 'registration_theme', 'cf7recapext_theme'}
	    $default_options['theme_selection'] = 'comments_theme';
            
	    // for bwp-recaptcha one of {'select_theme', 'cf7recapext_theme'}
	    $default_options['select_theme'] = 'select_theme';
	    
	    // one of {'red', 'white', 'blackglass', 'clean'}
	    $default_options['cf7recapext_theme'] = 'red';
            
            // for wp-recaptcha one of {'language_selection', 'cf7recapext'}
	    $default_options['language_selection'] = 'language_selection';
	    
	    // for bwp-recaptcha one of {'select_lang', 'cf7recapext'}
	    $default_options['select_lang'] = 'select_lang';
	    
	    // one of {'en', 'nl', 'fr', 'de', 'pt', 'ru', 'es', 'tr' }
	    $default_options['cf7recapext_language'] = 'en';
            
            return $default_options;
        }
	
	
	function add_settings() {
	    
	    // Theme Options Section
	    add_settings_section(
                    'cf7recapext_theme_section', 
                    __('Theme Options', $this->textdomain_name), 
                    array(&$this, 'echo_theme_section_info'), 
                    $this->options_name . '_page');
    	    
            add_settings_field(
                    'cf7recapext_theme_preselection', 
                    __('Theme Preselection', $this->textdomain_name), 
                    array(&$this, 'echo_theme_selection_radio'), 
                    $this->options_name . '_page', 
                    'cf7recapext_theme_section');
    	    
            add_settings_field(
                    'cf7recapext_own_theme', 
                    __('Own Theme (<i>if selected</i>)', $this->textdomain_name), 
                    array(&$this, 'echo_theme_dropdown'), 
                    $this->options_name . '_page', 
                    'cf7recapext_theme_section');
    	    
    	    
    	    // General Options Section
    	    add_settings_section(
                    'cf7recapext_general_section', 
                    __('General Options', $this->textdomain_name), 
                    array(&$this, 'echo_general_section_info'), 
                    $this->options_name . '_page');
    	    
            add_settings_field(
                    'cf7recapext_language_preselection', 
                    __('Language Preselection', $this->textdomain_name), 
                    array(&$this, 'echo_language_selection_radio'), 
                    $this->options_name . '_page', 
                    'cf7recapext_general_section');
    	    
            add_settings_field(
                    'cf7recapext_own_language', 
                    __('Own Language (<i>if selected</i>)', $this->textdomain_name), 
                    array(&$this, 'echo_language_dropdown'), 
                    $this->options_name . '_page', 
                    'cf7recapext_general_section');
    	    
	    // Debug Settings Section
	    add_settings_section(
                    'cf7recapext_debug_section', 
                    __('DEBUG Options', $this->textdomain_name), 
                    array(&$this, 'echo_debug_section_info'), 
                    $this->options_name . '_page');
	    
            add_settings_field(
                    'cf7recapext_reset_on_activate', 
                    __('Reset on Activate', $this->textdomain_name), 
                    array(&$this, 'echo_reset_on_activate_option'), 
                    $this->options_name . '_page', 
                    'cf7recapext_debug_section');
	}
	
	function echo_theme_section_info() {
	    echo '<p>';
            printf(
                    __('Here you can set which options to use for the themes option of the %s forms in the Contact Form 7 forms.', $this->textdomain_name), 
                    $this->recaptcha_tools[$this->recaptcha_tool] );
            echo "</p>\n";
	}
	
	function echo_general_section_info() {
	    echo '<p>';
            printf(
                    __('Here you can do the same with some of the general options of %s.', $this->textdomain_name),
                    $this->recaptcha_tools[$this->recaptcha_tool]);
            echo "</p>\n";
	}
	
	function echo_debug_section_info() {
	    echo '<p>' . 
                    __('Some debug options.', $this->textdomain_name) . 
                    "</p>\n";
	}
	
	function echo_reset_on_activate_option() {
	    $checked = ($this->options['reset_on_activate'] === 'on') ? ' checked="checked" ' : '';
	    
	    echo '<input type="checkbox" id="' . 
                    $this->options_name. 
                    '[reset_on_activate]" name="' . 
                    $this->options_name. 
                    '[reset_on_activate]" value="on"' . 
                    $checked . 
                    '/>'; 
	}
	
	function validate_options($input) {
            
            $validated = array();
	
            if ($this->recaptcha_tool === CF7reCAPTCHA::RECAPTCHATOOL_BWP_RECAPTCHA) {
            
                $theme_selections = 
                    array(
                        'select_theme', 	// if the theme for the comments should be used
                        'cf7recapext_theme');	// if an own theme should be used

                $validated['select_theme'] = 
                    $this->validate_dropdown(
                        $theme_selections, 
                        'select_theme', 
                        $input['select_theme']);
                
                $validated['theme_selection'] = $this->options['theme_selection'];

                $language_selections = 
                    array (
                        'select_lang',
                        'cf7recapext'
                        );

                $validated['select_lang'] = 
                    $this->validate_dropdown(
                        $language_selections,
                        'select_lang',
                        $input['select_lang']);
                
                $validated['language_selection'] = $this->options['language_selection'];

                
                
            } elseif ($this->recaptcha_tool === CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA) {
                
                $theme_selections = 
                    array(
                        'comments_theme', 		// if the theme for the comments should be used
                        'registration_theme', 	// if the theme for the registrations should be used
                        'cf7recapext_theme');	// if an own theme should be used

                $validated['theme_selection'] = 
                    $this->validate_dropdown(
                        $theme_selections, 
                        'theme_selection', 
                        $input['theme_selection']);
                
                $validated['select_theme'] = $this->options['select_theme'];
                
                $language_selections = 
                    array (
                        'language_selection',
                        'cf7recapext'
                        );

                $validated['language_selection'] = 
                    $this->validate_dropdown(
                        $language_selections,
                        'language_selection',
                        $input['language_selection']);

                $validated['select_lang'] = $this->options['select_lang'];
                
            } 
            
            if (
                    ($this->recaptcha_tool == CF7reCAPTCHA::RECAPTCHATOOL_BWP_RECAPTCHA 
                            && $validated['select_theme'] === 'cf7recapext_theme')
                    || 
                    ($this->recaptcha_tool == CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA 
                            && $validated['theme_selection'] === 'cf7recapext_theme')) {

                    $themes = 
                        array(
                            'red',
                            'white',
                            'blackglass',
                            'clean');

                    $validated['cf7recapext_theme'] = 
                        $this->validate_dropdown(
                            $themes,
                            'cf7recapext_theme',
                            $input['cf7recapext_theme']);
            } else {
                $validated['cf7recapext_theme'] = $this->options['cf7recapext_theme'];
            } 
            
            if (
                    ($this->recaptcha_tool == CF7reCAPTCHA::RECAPTCHATOOL_BWP_RECAPTCHA 
                            && $validated['select_lang'] === 'cf7recapext')
                    || 
                    ($this->recaptcha_tool == CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA 
                            && $validated['language_selection'] === 'cf7recapext')) {

                    $recaptcha_languages = 
                        array(
                            'en', 
                            'nl',
                            'fr', 
                            'de',
                            'pt',
                            'ru',
                            'es',
                            'tr');

                    $validated['cf7recapext_language'] =
                        $this->validate_dropdown(
                            $recaptcha_languages,
                            'cf7recapext_language',
                            $input['cf7recapext_language']); 
                } else {
                    $validated['cf7recapext_language'] = $this->options['cf7recapext_language'];
                }
            
            $validated['reset_on_activate'] = ($input['reset_on_activate'] === 'on') ? 'on' : 'off';
            
            return $validated;
               
	}
	
	function require_library() {
	    
	}
	
	
	function register_scripts() {
            
	}
	
	function register_actions() {
	    global $wp_version;
	
	
	    add_action( 'admin_notices', array(&$this, 'admin_notice') );
	    
	    
	    if ($this->useable()) {
	
		add_action( 'admin_init', array(&$this, 'tag_generator_recaptcha'), 46 );
		//add_action( 'admin_footer', array(&$this, 'add_script2admin_footer') );
		
		//add_action( 'edit_post', array(&$this, 'check_double_captcha') );
	    
	    }
	
	}
	
	function register_filters() {
	
	
	    if ( $this->useable() ) {
	    
		add_filter( 'wpcf7_validate_recaptcha', array(&$this, 'recaptcha_validation_filter'), 10, 2 );
		
		add_filter( 'wpcf7_ajax_json_echo', array(&$this, 'ajax_json_echo_filter') );
		
	    }

		
	}
	
	function register_cf7() {
	
	    // CF7 Shortcode Handler
	    if (function_exists('wpcf7_add_shortcode') && $this->useable() ) {
	    
		wpcf7_add_shortcode( 'recaptcha', array(&$this, 'shortcode_handler'), true );	
		
	    }
	    
		
	}
	
	
	function useable() {
	    if (!isset($this->is_useable)) {
		$this->is_useable = $this->is_recaptcha_active() && $this->is_cf7_active();
	    }
		
	    return $this->is_useable;
	}
    
	function is_recaptcha_active() {
            
            $bwp_check = in_array(
                    CF7reCAPTCHA::RECAPTCHATOOL_BWP_RECAPTCHA
                    . '/'
                    . CF7reCAPTCHA::RECAPTCHATOOL_BWP_RECAPTCHA
                    .'.php', 
                    apply_filters( 
                            'active_plugins', 
                            get_option( 
                                    'active_plugins' )));
            
            $wp_check = in_array( 
                    CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA
                    . '/'
                    . CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA
                    .'.php', 
                    apply_filters( 
                            'active_plugins', 
                            get_option( 
                                    'active_plugins' )));
            
            if ($wp_check) {
                $this->recaptcha_tool = CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA;
                return true;
            } elseif ($bwp_check) {
                $this->recaptcha_tool = CF7reCAPTCHA::RECAPTCHATOOL_BWP_RECAPTCHA;
                return true;
            } else {
                return false;
            }
	
	}
	
	function is_cf7_active() {
	    return in_array( 
		'contact-form-7/wp-contact-form-7.php', 
		apply_filters( 
		    'active_plugins', 
		    get_option( 
			'active_plugins' ) ) );
	}
	
	function register_settings_page() {
	
	    $this->add_options_page(__('Contact Form 7 reCAPTCHA Extension Options', $this->textdomain_name), __('CF7-reCAP Extension', $this->textdomain_name));
	}
	
	function show_settings_page() {
	    include('settings.php');
	}
	
	function echo_theme_selection_radio() {
	
	    $recaptcha_options = WPASDPlugin::retrieve_options($this->recaptcha_options_name[$this->recaptcha_tool]);
	    
	    $themes =
		array (
		    'red'        => __('Red',         $this->textdomain_name),
		    'white'      => __('White',       $this->textdomain_name),
		    'blackglass' => __('Black Glass', $this->textdomain_name),
		    'clean'      => __('Clean',       $this->textdomain_name));
	    
            
            $theme_options = array();
            
            $default_options = $this->get_default_options();
            
            if ($this->recaptcha_tool === CF7reCAPTCHA::RECAPTCHATOOL_BWP_RECAPTCHA) {
                
                $theme_option = (is_array($recaptcha_options) && isset($recaptcha_options['select_theme']) ) ? ' (' . __('currently', $this->textdomain_name) . ': <i>' . $themes[$recaptcha_options['select_theme']] . '</i>)' : '';
            
                $theme_options[__('Better WordPress reCAPTCHA Theme',     $this->textdomain_name) . $theme_option] = 'select_theme';
                
            } elseif ($this->recaptcha_tool === CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA) {
                
                $comments_theme = (is_array($recaptcha_options) && isset($recaptcha_options['comments_theme']) ) ? ' (' . __('currently', $this->textdomain_name) . ': <i>' . $themes[$recaptcha_options['comments_theme']] . '</i>)' : '';
                $registration_theme = (is_array($recaptcha_options) && isset($recaptcha_options['registration_theme']) ) ? ' (' . __('currently', $this->textdomain_name) . ': <i>' . $themes[$recaptcha_options['registration_theme']] . '</i>)' : '';
	
                $theme_options[__('WP-reCAPTCHA Comments Theme',     $this->textdomain_name) . $comments_theme] = 'comments_theme';
                $theme_options[__('WP-reCAPTCHA Registration Theme', $this->textdomain_name) . $registration_theme] = 'registration_theme';
                
            }
                       
	    
            $theme_options[__('Own Theme' , $this->textdomain_name) . ' (<i>' . __('select below', $this->textdomain_name) . '</i>)'] = 'cf7recapext_theme';
	
	    $this->echo_radios(
                    $this->options_name . '[' . $this->theme_option_name[$this->recaptcha_tool] . ']', 
                    $theme_options, 
                    $this->options[$this->theme_option_name[$this->recaptcha_tool]],
                    $default_options[$this->theme_option_name[$this->recaptcha_tool]]);
	}
	
	function echo_theme_dropdown() {
	    $themes =
		array (
		    __('Red',         $this->textdomain_name) => 'red',
		    __('White',       $this->textdomain_name) => 'white',
		    __('Black Glass', $this->textdomain_name) => 'blackglass',
		    __('Clean',       $this->textdomain_name) => 'clean');
		
	    echo '<label for="' . $this->options_name . '[cf7recapext_theme]">' . __('Theme', $this->textdomain_name) . ":</label>\n";     
	    $this->echo_dropdown($this->options_name . '[cf7recapext_theme]', $themes, $this->options['cf7recapext_theme']);
	}
	
	function echo_language_selection_radio() {
	
	    $recaptcha_options = WPASDPlugin::retrieve_options($this->recaptcha_options_name[$this->recaptcha_tool]);
	    
	    $languages =
		array (
		    'en' => __('English',    $this->textdomain_name),
		    'nl' => __('Dutch',      $this->textdomain_name),
		    'fr' => __('French',     $this->textdomain_name),
		    'de' => __('German',     $this->textdomain_name),
		    'pt' => __('Portuguese', $this->textdomain_name),
		    'ru' => __('Russian',    $this->textdomain_name),
		    'es' => __('Spanish',    $this->textdomain_name),
		    'tr' => __('Turkish',    $this->textdomain_name));
            
            
            $language_options = array();
            $default_options = $this->get_default_options();
            
            if ($this->recaptcha_tool === CF7reCAPTCHA::RECAPTCHATOOL_BWP_RECAPTCHA) {
	    
                $recaptcha_language = (is_array($recaptcha_options) && isset($recaptcha_options['select_lang']) ) ? ' (' . __('currently', $this->textdomain_name) . ': <i>' . $languages[$recaptcha_options['select_lang']] . '</i>)' : '';

                $language_options[__('Better WordPress reCAPTCHA Language', $this->textdomain_name) . $recaptcha_language] = 'select_lang';
                
            } elseif ($this->recaptcha_tool === CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA) {
                
                $recaptcha_language = (is_array($recaptcha_options) && isset($recaptcha_options['recaptcha_language']) ) ? ' (' . __('currently', $this->textdomain_name) . ': <i>' . $languages[$recaptcha_options['recaptcha_language']] . '</i>)' : '';
		    
                $language_options[__('WP-reCAPTCHA Language', $this->textdomain_name) . $recaptcha_language] = 'language_selection';
                
            }
            
            $language_options[__('Own Language', $this->textdomain_name) . ' (<i>' . __('select below', $this->textdomain_name) . '</i>)'] = 'cf7recapext';
	
	    $this->echo_radios(
                    $this->options_name . '[' . $this->language_option_name[$this->recaptcha_tool] . ']' , 
                    $language_options, 
                    $this->options[$this->language_option_name[$this->recaptcha_tool]],
                    $default_options[$this->language_option_name[$this->recaptcha_tool]]);
	}
	
	function echo_language_dropdown() {
	    $languages = 
		array(
		    __('English',    $this->textdomain_name) => 'en',
		    __('Dutch',      $this->textdomain_name) => 'nl',
		    __('French',     $this->textdomain_name) => 'fr',
		    __('German',     $this->textdomain_name) => 'de',
		    __('Portuguese', $this->textdomain_name) => 'pt',
		    __('Russian',    $this->textdomain_name) => 'ru',
		    __('Spanish',    $this->textdomain_name) => 'es',
		    __('Turkish',    $this->textdomain_name) => 'tr'
		    );
	    
	    echo '<label for="' . $this->options_name . '[cf7recapext_language]">' . __('Language', 'cf7recaptcha') . ":</label>\n";
	    $this->echo_dropdown($this->options_name . '[cf7recapext_language]', $languages, $this->options['cf7recapext_language']);
	}
	
	function ajax_json_echo_filter( $items ) {
	    if ( ! is_array( $items['onSubmit'] ) )
		$items['onSubmit'] = array();

	    $items['onSubmit'][] = 'if (typeof Recaptcha != "undefined") { Recaptcha.reload(); }';

	    return $items;
	}


	function recaptcha_validation_filter( $result, $tag ) {
	    global $bwp_capt, $recaptcha;
	    
	    $name = $tag['name'];
            
            $errors = new WP_Error();
            
            if ($this->recaptcha_tool === CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA 
                    && $this->is_multi_blog()) {

                $recaptcha->validate_recaptcha_response_wpmu($result);

            } else {
            
                if ($this->recaptcha_tool === CF7reCAPTCHA::RECAPTCHATOOL_BWP_RECAPTCHA) {

                    $errors = $bwp_capt->check_reg_recaptcha($errors);

                } elseif ($this->recaptcha_tool === CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA) {

                    $recaptcha->validate_recaptcha_response($errors);

                }

                $error_list = $errors->get_error_messages(null);
                
                if (!empty($error_list)) {

                    $result['valid'] = false;

                    $error_out = "";

                    foreach ($error_list as $value) {

                        $error_out .= $value;	

                    }

                    $result['reason'][$name] = $error_out;
                }
            }
	

	    return $result;
	}
	
	
	function tag_generator_recaptcha() {
	
	    if (function_exists('wpcf7_add_tag_generator') && $this->useable()) {
		wpcf7_add_tag_generator(
		    'recaptcha',
		    'reCAPTCHA',
		    'cf7recaptcha-tg-pane',
		    array(&$this, 'tag_pane'));
	    }
	    
	}
        
        function wp_recaptcha_user_can_bypass() {
            
            $recaptcha_options = WPASDPlugin::retrieve_options($this->recaptcha_options_name[CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA]);
            
            // set the minimum capability needed to skip the captcha if there is one
            if (isset($recaptcha_options['bypass_for_registered_users']) && $recaptcha_options['bypass_for_registered_users'] && $recaptcha_options['minimum_bypass_level'])
                $needed_capability = $recaptcha_options['minimum_bypass_level'];

            // skip the reCAPTCHA display if the minimum capability is met
            if (isset($needed_capability) && $needed_capability && current_user_can($needed_capability))
                return true;
            
            return false;
        }

	
	function shortcode_handler( $tag ) {
	    global $wpcf7_contact_form, $bwp_capt, $recaptcha;
            
            if( ($this->recaptcha_tool === CF7reCAPTCHA::RECAPTCHATOOL_BWP_RECAPTCHA
                    && $bwp_capt->user_can_bypass() )
                    || 
                    ($this->recaptcha_tool === CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA
                    && $this->wp_recaptcha_user_can_bypass() )) {
                
                return '';
                
            } 
            
                

	    $name = $tag['name'];
	    
	    $recaptcha_options = WPASDPlugin::retrieve_options($this->recaptcha_options_name[$this->recaptcha_tool]);
	    
	    
	    $used_theme = '';
            $used_language = '';
            
            if ($this->options[$this->theme_option_name[$this->recaptcha_tool]] === 'cf7recapext_theme' 
                    && isset($this->options['cf7recapext_theme'])) {

                $used_theme = $this->options['cf7recapext_theme'];
                
            } elseif (isset($recaptcha_options[$this->options[$this->theme_option_name[$this->recaptcha_tool]]])) {

                $used_theme = $recaptcha_options[$this->options[$this->theme_option_name[$this->recaptcha_tool]]];
                
            } else {
                $used_theme = 'red';
                
            }
            
            
            if ($this->options[$this->language_option_name[$this->recaptcha_tool]] === 'cf7recapext' 
                    && isset($this->options['cf7recapext_language'])) {

                $used_language = $this->options['cf7recapext_language'];
                
            } elseif (isset($recaptcha_options[$this->options[$this->language_option_name[$this->recaptcha_tool]]])) {

                $used_language = $recaptcha_options[$this->options[$this->language_option_name[$this->recaptcha_tool]]];
                
            } else {
                $used_language = 'en';
            }
            
             
	    
	    $js_options = <<<JSOPTS
	    <script type='text/javascript'>
		var RecaptchaOptions = { theme : '{$used_theme}', lang : '{$used_language}'};
	    </script>
JSOPTS;
                
	    $html = $js_options;
	    
            if ($this->recaptcha_tool === CF7reCAPTCHA::RECAPTCHATOOL_WP_RECAPTCHA) {
                
                $use_ssl = isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == 'on';

                $html .= $recaptcha->get_recaptcha_html( null, $use_ssl );
                
            } elseif ($this->recaptcha_tool === CF7reCAPTCHA::RECAPTCHATOOL_BWP_RECAPTCHA) {
        	
		require_once( dirname(__FILE__) . '/../../bwp-recaptcha/includes/recaptcha/recaptchalib.php');
                
                if ( function_exists( 'recaptcha_get_html' ) && !defined( 'BWP_CAPT_ADDED' ) ) {

                    // make sure we add only one recaptcha instance
                    define( 'BWP_CAPT_ADDED', true );

                    $captcha_error = '';

                    if ( !empty( $_GET[ 'cerror' ] ) 
                            && 'incorrect-captcha-sol' == $_GET[ 'cerror' ] )

                        $captcha_error = $_GET[ 'cerror' ];

                    if ( !empty( $_SESSION[ 'bwp_capt_akismet_needed' ]) 
                            && 'yes' == $_SESSION[ 'bwp_capt_akismet_needed' ] ) {

                        $html .= '<p class="bwp-capt-spam-identified">' . 
                                _e( 'Your comment was identified as spam, please complete the CAPTCHA below:', $this->textdomain_name ) . 
                                '</p>';
                    }

                    do_action( 'bwp_capt_before_add_captcha' );

                    if ( 'redirect' == $bwp_capt->options[ 'select_response' ]  && ! is_admin() ) {
                            $html .= '<input type="hidden" name="error_redirect_to" value="' . esc_attr_e( $bwp_capt->get_current_comment_page_link() ) . '" />';
                    }

                    $use_ssl = ( isset( $_SERVER[ 'HTTPS' ]) && 'on' == $_SERVER[ 'HTTPS' ] ) ? true : false;

                    if ( !empty( $bwp_capt->options[ 'input_pubkey' ] ) ) {

                        $html .= recaptcha_get_html( $bwp_capt->options[ 'input_pubkey' ], $captcha_error, $use_ssl );

                    } else
                        if ( current_user_can( 'manage_options' ) ) {

                            $html .= _e( "To use reCAPTCHA you must get an API key from <a href='https://www.google.com/recaptcha/admin/create'>https://www.google.com/recaptcha/admin/create</a>", $this->textdomain_name );
                        }
                }
            }

	    $validation_error = '';
	    if ( is_a( $wpcf7_contact_form, 'WPCF7_ContactForm' ) )
		$validation_error = $wpcf7_contact_form->validation_error( $name );
	
	    $html .= '<span class="wpcf7-form-control-wrap ' . $name . '">' . $validation_error . '</span>';

	    return $html;
	}


	function tag_pane( &$contact_form ) {
?>
<div id="cf7recaptcha-tg-pane" class="hidden">
<form action="">
<table>

<?php if ( ! $this->useable() ) : ?>
<tr><td colspan="2"><strong style="color: #e6255b">you need reCAPTCHA</strong><br /></td></tr>
<?php endif; ?>

<tr><td><?php _e( 'Name', $this->textdomain_name ); ?><br /><input type="text" name="name" class="tg-name oneline" /></td><td></td></tr>
</table>

<div class="tg-tag"><?php _e( "Copy this code and paste it into the form left.", $this->textdomain_name ); ?>
<br />
<input type="text" name="recaptcha" class="tag" readonly="readonly" onfocus="this.select()" />
</div>
</form>
</div>
<?php
	}	
	
	
	function admin_notice() {
	    global $plugin_page;

	    if ( ! $this->is_cf7_active() ) :

?>
<div id="message" class="updated fade"><p>
<?php _e( "You are using <b>Contact Form 7 reCAPTCHA Extension</b>." , $this->textdomain_name); ?> 
<?php _e( "This works with the Contact Form 7 plugin but the Contact Form 7 plugin is not activated.", $this->textdomain_name ); ?>
 &mdash; Contact Form 7 <a href="http://wordpress.org/extend/plugins/contact-form-7/">http://wordpress.org/extend/plugins/contact-form-7/</a><p>
</div>
<?php
	    endif;


	    if ( ! $this->is_recaptcha_active() ) :

?>
<div id="message" class="updated fade"><p>
<?php _e( "You are using <b>Contact Form 7 reCAPTCHA Extension</b>." , $this->textdomain_name); ?> 
<?php _e( "This needs a reCAPTCHA plugin to work properly but neither of the recommended reCAPTCHA plugins is installed and activated. Please install and activate one of the following plugins: ", $this->textdomain_name ); ?><br/>
&mdash; WP-reCAPTCHA <a href="http://wordpress.org/extend/plugins/wp-recaptcha/">http://wordpress.org/extend/plugins/wp-recaptcha/</a><br/>
&mdash; Better WordPress reCAPTCHA <a href="http://wordpress.org/extend/plugins/bwp-recaptcha/">http://wordpress.org/extend/plugins/bwp-recaptcha/</a><p>
</div>
<?php
	    endif;


	    
	    
	}
    
    } // end of class declaration

} // end of class exists clause

?>