<?php
/**
 * @package Fontdeck
 */
/*
Plugin Name: Fontdeck
Plugin URI: http://fontdeck.com/support/wordpress
Description: Use custom web fonts from Fontdeck on your WordPress website.
Version: 1.0.3
Author: Fontdeck
Author URI: http://fontdeck.com
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

// Add the <link> and <style> blocks to the head:
add_action('wp_head', 'fontdeck_links');

function fontdeck_links() {
    $css_base = get_option('fontdeck_css_base');
    $project_id = get_option('fontdeck_project_id');
    $css_code = get_option('fontdeck_css_code');
    if ($css_base && $project_id) {
        echo '<link href="'.$css_base.'/'.$_SERVER['SERVER_NAME'].'/'.$project_id.'.css" rel="stylesheet"/>'."\n"; 
    } else if (get_option('fontdeck_link_code')) {
        echo get_option('fontdeck_link_code')."\n"; 
    }
    if ($css_code) {
        echo "<style>\n".$css_code."\n</style>\n";
    }
}

// Add the class 'fontdeck' to the body:
add_filter('body_class', 'fontdeck_body_class');

function fontdeck_body_class($classes) {
    array_push($classes, 'fontdeck');
    return $classes;
}

// Add the fontdeck settings page to the admin menu:
add_action('admin_menu', 'fontdeck_menu_item');

function fontdeck_menu_item() {
    $plugin_page = add_options_page('Fontdeck Settings', 'Fontdeck', 'manage_options', 'fontdeck', 'fontdeck_settings_page');
    add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), fontdeck_plugin_actions, 10, 2 );
    add_action('admin_head-' . $plugin_page, 'fontdeck_settings_head');
	add_action('admin_init', 'fontdeck_register_settings');
}

// Register the fontdeck settings:
function fontdeck_register_settings() {
	register_setting('fontdeck_settings', 'fontdeck_project_id');
	register_setting('fontdeck_settings', 'fontdeck_selectors');
	register_setting('fontdeck_settings', 'fontdeck_custom_selectors');
	register_setting('fontdeck_settings', 'fontdeck_css_base');
	register_setting('fontdeck_settings', 'fontdeck_css_code');
}

register_deactivation_hook( __FILE__, 'fontdeck_deactivate' );
// Unregsiter the fontdeck settings:
function fontdeck_deactivate() {
	unregister_setting('fontdeck_settings', 'fontdeck_project_id');
	unregister_setting('fontdeck_settings', 'fontdeck_selectors');
	unregister_setting('fontdeck_settings', 'fontdeck_custom_selectors');
	unregister_setting('fontdeck_settings', 'fontdeck_css_base');
	unregister_setting('fontdeck_settings', 'fontdeck_css_code');
}

// Link to the fontdeck settings page from the plugin page:
function fontdeck_plugin_actions($links, $file) {
    $settings_link = '<a href="' . get_bloginfo('wpurl') . '/wp-admin/options-general.php?page=fontdeck">' . __('Settings') . '</a>';
   array_unshift( $links, $settings_link );
   return $links;
}

// CSS for the fontdeck settings page:
function fontdeck_settings_head() { ?>
<style>
#icon-fontdeck { background: transparent url(<?php echo plugins_url('/fontdeck32.png', __FILE__ );?>) no-repeat 2px 2px; }
#project_id { font-size: 20px; width: 10em; margin: -5px 1em -5px 0; vertical-align: bottom; }
.fontdeck-divider { border-top: 1px solid #DFDFDF; margin-top: 2em; padding-top: 1em }
.fontdeck-fonts { border-collapse: collapse; }
.fontdeck-fonts th { text-align: centre; width: 5em; padding: 5px 10px; border-left: 1px solid #DFDFDF; }
.fontdeck-fonts td { text-align: center; padding: 10px; border-top: 1px solid #DFDFDF; border-left: 1px solid #DFDFDF; }
.fontdeck-fonts th.font { text-align: left; width: auto; border-top: 1px solid #DFDFDF; border-left: none; }
.fontdeck-fonts thead th.font { border-top: none; }
.fontdeck-fonts tr :nth-child(even)  { background: #F9F9F9 }
</style>
<?php }

// Get project info for a given project id and domain:
function fontdeck_project_info($project, $domain) {
    $url = "http://f.fontdeck.com/s/css/json/$domain/$project.json";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = utf8_encode(curl_exec($curl));
    $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    if($http_code == 404) {
        return (object) array(error => '<p>Project not found. Have you added the domain <strong>'.$domain.'</strong> for <a href="http://fontdeck.com/project/'.$project.'">this website</a>?</p>');
    } else {
        $json = json_decode($response);
        if (!$json) {
            $json = preg_replace('/^.+?(\{.+\}).+$/s','$1', $response);
        }
        return $json;
    }
}

// Update the fontdeck <link> and <style> blocks:
function fontdeck_update_css($project_info, $fontdeck_selectors, $fontdeck_custom_selectors) {
    update_option('fontdeck_css_base', $project_info->cssbase);
    if ($fontdeck_selectors || $fontdeck_custom_selectors) {
        $selectors = array(
            'body'   => 'body, p, th, td, div',
            'links'  => 'a:link, a:visited, a:active, a:hover, a:focus',
            'italic' => 'em, i',
            'bold'   => 'strong, b',
            'h1'     => 'h1, h1 a:link, h1 a:visited, h1 a:active, h1 a:hover, h1 a:focus',
            'h2'     => 'h2, h2 a:link, h2 a:visited, h2 a:active, h2 a:hover, h2 a:focus',
            'h3'     => 'h3, h3 a:link, h3 a:visited, h3 a:active, h3 a:hover, h3 a:focus'
        );
        $css_code = '';
        foreach ($project_info->fonts as $font) {
            $font_selectors = array();
            if ($fontdeck_custom_selectors) {
                array_push($font_selectors, $fontdeck_custom_selectors[$font->id]);
            } else {
                foreach ($selectors as $type => $value) {
                    if ($font->id == $fontdeck_selectors[$type]) {
                        array_push($font_selectors, $value);
                    }
                }
            }
            if (count($font_selectors) > 0) {
                $css_code .= join(",\n", $font_selectors)." {\n";
                $css_code .= "    font-family: $font->font_family !important;\n";
                $css_code .= "    font-style: $font->style !important;\n";
                $css_code .= "    font-weight: $font->weight !important;\n";
                $css_code .= "}\n";
            }
        }
        update_option('fontdeck_css_code', $css_code);
    }
}

// Sort fonts in alphabetical order
function fontdeck_sort_fonts($a, $b) {
    if ($a->name == $b->name) {
        return 0;
    }
    return ($a->name < $b->name) ? -1 : 1;
}

// The fontdeck settings page:
function fontdeck_settings_page() {
    $project_id = get_option('fontdeck_project_id');
    $fontdeck_selectors = get_option('fontdeck_selectors');
    $fontdeck_custom_selectors = get_option('fontdeck_custom_selectors');
    if ($project_id) {
        $project_info = fontdeck_project_info($project_id, $_SERVER['SERVER_NAME']);
        if (isset($project_info) && !isset($project_info->error)) {
            fontdeck_update_css($project_info, $fontdeck_selectors, $fontdeck_custom_selectors);
            if (count($project_info->fonts) == 0) {
                $project_info->error = '<p><strong>No fonts were found for this project.</strong></p><p>Changes made on Fontdeck can take up to 6 minutes to take effect.</p>';
            }
        }
    }
?>
<div class="wrap">
<?php screen_icon('fontdeck'); ?>
<h2>Fontdeck</h2>
<?php if ($project_info->error) { ?>
<div class="error"> 
    <?php echo $project_info->error; ?>
</div>
<?php } ?>
<form method="post" action="options.php">
    <?php settings_fields('fontdeck_settings'); ?>
    <?php if ($project_id) { ?>
    <p>View <a href="http://fontdeck.com/project/<?php echo $project_id; ?>">this project</a> on Fontdeck to add additional fonts, domains and make other changes. You can update your project number below.</p>
    <?php } else { ?>
    <p>Enter your project number below. Your project number can be found on your <a href="https://fontdeck.com/account">Fontdeck account</a> by visiting your website&rsquo;s settings page.</p>
    <?php } ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><label for="project_id">Project Number</label></th>
        <td><input type="text" name="fontdeck_project_id" id="project_id" class="regular-text" value='<?php echo $project_id; ?>' /> <input type="submit" class="button-primary" value="<?php _e('Update') ?>" /></td>
        </tr>
    </table>
</form>
<?php
if (isset($project_info) && !$project_info->error) {
    $selectors = array('body', 'links', 'italic', 'bold', 'h1', 'h2', 'h3');
?>
<form class="fontdeck-divider" method="post" action="options.php" id="fontdeck-default-settings"<?php if ($fontdeck_custom_selectors) { echo ' style="display:none"'; } ?>>
    <?php settings_fields('fontdeck_settings'); ?>
    <input type="hidden" name="fontdeck_project_id" value='<?php echo $project_id; ?>' />
    <?php if (count($project_info->fonts) != 0) { ?>
    <h3>Your Fonts</h3>
    <p>Select the types of text you would like to use your font<?php if (count($project_info->fonts) > 1) echo 's'; ?>.</p>
    <table class="fontdeck-fonts">
    <thead>
    <tr>
    <th class="font">Font</th><th>Body Text</th><th>Links</th><th>Italic</th><th>Bold</th><th>H1</th><th>H2</th><th>H3</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <th class="font">Remain Unchanged</th><?php foreach ($selectors as $selector) { ?><td><input type="radio" name="fontdeck_selectors[<?php echo $selector; ?>]" value="-1"<?php if (!isset($fontdeck_selectors[$selector]) || $fontdeck_selectors[$selector] == -1) { echo ' checked'; } ?> /></td><?php } ?>
    </tr>
    <?php
    usort($project_info->fonts, 'fontdeck_sort_fonts');
    foreach ($project_info->fonts as $font) {
    ?>
    <tr>
    <th class="font"><?php echo $font->name; ?></th><?php foreach ($selectors as $selector) { ?><td><input type="radio" name="fontdeck_selectors[<?php echo $selector; ?>]" value="<?php echo $font->id; ?>"<?php if ($fontdeck_selectors[$selector] == $font->id) { echo ' checked'; } ?> /></td><?php } ?>
    </tr>
    <?php } ?>
    </tbody>
    </table>
    <p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:{document.getElementById('fontdeck-advanced-settings').style.display = 'block';document.getElementById('fontdeck-default-settings').style.display = 'none'}">Change to Advanced mode</a></p>
    <?php } ?>
</form>
<form class="fontdeck-divider" method="post" action="options.php" id="fontdeck-advanced-settings"<?php if (!$fontdeck_custom_selectors) { echo ' style="display:none"'; } ?>>
    <?php settings_fields('fontdeck_settings'); ?>
    <input type="hidden" name="fontdeck_project_id" value='<?php echo $project_id; ?>' />
    <h3>Your Fonts &ndash; Advanced Mode</h3>
    <p>Choose the selectors to target for each font. Alternatively, leave these fields blank to use your own CSS stylesheet.</p>
    <table class="fontdeck-fonts">
    <thead>
    <tr>
    <th class="font">Font</th><th>Selectors</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($project_info->fonts as $font) { ?>
    <tr>
    <th class="font"><label for="custom_selectors_<?php echo $font->id; ?>"><?php echo $font->name; ?></label></th><td><input type="text" id="custom_selectors_<?php echo $font->id; ?>" name="fontdeck_custom_selectors[<?php echo $font->id; ?>]" placeholder="eg. h1, p, .classname" value="<?php echo $fontdeck_custom_selectors[$font->id]; ?>" class="regular-text" /></td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
    <p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>"  />&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:{document.getElementById('fontdeck-default-settings').style.display = 'block';document.getElementById('fontdeck-advanced-settings').style.display = 'none'}">Change to Standard mode</a></p>
</form>
<?php } ?>
</div>
<?php } ?>