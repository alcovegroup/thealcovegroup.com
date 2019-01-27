<?php
/*
Plugin Name: Alcove Group Instance Creator
Plugin URI: http://www.thealcovegroup.com
Description: Generates a new instance of a child site on the network.
Version: 1.0
Author: Edwin Orjales
*/
#################################
# Support requests to
# eorjales@gmail.com
#################################
require_once('classes/instance_class.php');
$haspost = $_GET['generate-instance'];
define('ic_PATH', plugin_dir_path(__FILE__));
define('ic_URL', WP_PLUGIN_URL . "/instance-controller/");

/*------------------------------------------------*/
/* Admin Pages                                    */
/*------------------------------------------------*/

function ic_authorize_admin()
{
    if (!defined('ic_URL')) {
        die('Restricted access');
    } elseif (!is_user_logged_in()) {
        wp_die('Restricted access');
    } else {
        $auth = false;
        $allowed_capabilities = ic_allowed_capabilities();

        foreach ($allowed_capabilities as $cap) {
            if (current_user_can($cap)) {
                $auth = true;
                break;
            }
        }
        return $auth;
    }
}

function ic_allowed_capabilities()
{
    $allowed_capabilities = array();
    $allowed_capabilities[] = 'manage_options';
    $allowed_capabilities[] = 'edit_plugins';
    $allowed_capabilities[] = 'publish_posts';
    $allowed_capabilities[] = 'edit_posts';
    return $allowed_capabilities;
}

function ic_admin_pages()
{
    $min_capability = ic_allowed_capabilities();
    $min_capability = end($min_capability);

    if (current_user_can($min_capability)) {
        add_menu_page("Instance Creator", "Instance Creator", $min_capability, 'instance-controller', 'ic_render_page', 'dashicons-admin-tools');
    }
}

add_action('admin_menu', 'ic_admin_pages');


function ic_render_page()
{
    global $haspost;
    global $result;
    global $error_count;
    echo '<div id="ic-button-holder">';
    $blog_list = get_blog_list( 0, 'all' );
    $blogusers = get_users();
    $themes_list = wp_get_themes(array('allowed' => 'network'));
    $current_site_url = $_SERVER['REQUEST_URI'];
    $current_site_url = preg_replace('~^(.*)(\.php)(.*)$~', '$1$2', $current_site_url);
    $ic_crawler = new ic_crawler();
    $install_type = (SUBDOMAIN_INSTALL == TRUE) ? 'subdomain' : 'subdirectory';
    if ($haspost != 'go') {
        ?>
        <form action="<?=$current_site_url;?>?page=instance-controller&generate-instance=go" method="post">
            <h1>Instance Generator</h1>
            <p>
                This tool will generate a new site using an existing site in the network as a base. Please review these parameters carefully before executing.
            </p>

            <?php if($install_type == 'subdirectory') {
                ?>
            <p>
            <label for="new_site_path">New Site Subdirectory Path</label>
            Path for the new site. Follows the domain. Lower case.<br />Example: http://thealcovegroup.com/<strong style="color:blue;">newsite</strong>
            <br />
                <input type="text" name="new_site_path" value="newsite" />
            </p>
            <?php
            }
            ?>

            <p>
            <label for="new_site_title">New Site Title</label>
            Global Name/Title for the new site.
            <br />
                <input type="text" name="new_site_title" value="Auto-Generated Instance" />
            </p>

            <p>
            <label for="new_site_search_city">New Site City</label>
            City limiter for search page on new site.
            <br />
                <input type="text" name="new_site_search_city" value="City" />
            </p>

            <?php
            ######################################
            ######################################
            ######################################
            ?>
            <br />
            <h1 class="ic_ao_toggle">Advanced Options</h1>
            <p>
                <a class="ic_ao_toggle">Click to view/hide advanced settings.</a> Default settings should be fine for most cases.
            </p>

            <div id="ic_advanced_options" style="display:none;">

            	<?php
            /*
          
            <p>
            <label for="origin_site_id">Site To Copy From</label>
            Settings for the new site will be copied over from the selected site. These settings include active plugins, MLS credentials, template and style settings, etc.
            <br />
                <select name="origin_site_id">
                <?php
                foreach ($blog_list AS $blog) {
                    $recommended = ($blog['blog_id'] == '1') ? ' --NOT RECOMMENDED--' : '';
                    echo '<option value="'.$blog['blog_id'].'">'.$blog['domain'].$blog['path'].$recommended.'</option>';
                }
                ?>
                </select>
            </p>

            <p>
            <label for="search_homes_template">Search Homes Template File</label>
            Name of the template file that will process the search page.
            <br />
                <input type="text" name="search_homes_template" value="template-search-by-city.php" />
            </p>

            <p>
            <label for="home_value_template">Home Value Template File</label>
            Name of the template file that will process the home value page.
            <br />
                <input type="text" name="home_value_template" value="home-value.php" />
            </p>

            <p>
            <label for="new_site_domain">New Site Domain</label>
            Base domain for the new site. Current domain selected by default.
            <br />
                <input type="text" name="new_site_domain" value="<?=$_SERVER['SERVER_NAME'];?>" />
            </p>

            <p>
            <label for="new_site_theme">New Site Theme</label>
            Theme to be applied to the new site.
            <br />
                <select name="new_site_theme">
                <?php
                foreach($themes_list as $theme => $data) {
                    $current_theme_selected = ($theme == 'thealcovegroup-microsite') ? ' selected' : '';
                    echo '<option value="'.$theme.'"'.$current_theme_selected.'>'.esc_html($data).'</option>';
                }
                ?>
                </select>
            </p>
            */
            ?>

            <input type="hidden" name="search_homes_template" value="template-search-by-city.php" />
            <input type="hidden" name="home_value_template" value="home-value.php" />
            <input type="hidden" name="new_site_domain" value="<?=$_SERVER['SERVER_NAME'];?>" />
            <input type="hidden" name="new_site_theme" value="thealcovegroup-microsite" />
            <?php
             echo '<input type="hidden" name="multisite_type" value="' . $install_type . '" />';
            ?>

            <p>
            <label for="new_site_admin">New Site Admin User</label>
            The user who will be assigned as admin for the new site. Current user is selected by default.
            <br />
                <select name="new_site_admin">
                <?php
                $current_user_id = get_current_user_id();
                $list_users = $ic_crawler->user_list;
                foreach ( $list_users as $user ) {
                    $current_user_selected = ($current_user_id == $user['ID']) ? ' selected' : '';
                    echo '<option value="'.$user['ID'].'"'.$current_user_selected.'>'.esc_html( $user['display_name'] ).'</option>';
                }
                ?>
                </select>
            </p>

            <p>
            <label for="new_site_search_state">New Site State</label>
            State limiter for search page on new site.
            <br />
                <select name="new_site_search_state">
                    <option disabled value="AL" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'AL') {echo ' selected';} ?>>Alabama</option>
                    <option disabled value="AK" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'AK') {echo ' selected';} ?>>Alaska</option>
                    <option selected value="AZ" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'AZ') {echo ' selected';} ?>>Arizona</option>
                    <option disabled value="AR" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'AR') {echo ' selected';} ?>>Arkansas</option>
                    <option disabled value="CA" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'CA') {echo ' selected';} ?>>California</option>
                    <option disabled value="CO" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'CO') {echo ' selected';} ?>>Colorado</option>
                    <option disabled value="CT" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'CT') {echo ' selected';} ?>>Connecticut</option>
                    <option disabled value="DE" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'DE') {echo ' selected';} ?>>Delaware</option>
                    <option disabled value="DC" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'DC') {echo ' selected';} ?>>District Of Columbia</option>
                    <option disabled value="FL" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'FL') {echo ' selected';} ?>>Florida</option>
                    <option disabled value="GA" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'GA') {echo ' selected';} ?>>Georgia</option>
                    <option disabled value="HI" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'HI') {echo ' selected';} ?>>Hawaii</option>
                    <option disabled value="ID" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'ID') {echo ' selected';} ?>>Idaho</option>
                    <option disabled value="IL" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'IL') {echo ' selected';} ?>>Illinois</option>
                    <option disabled value="IN" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'IN') {echo ' selected';} ?>>Indiana</option>
                    <option disabled value="IA" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'IA') {echo ' selected';} ?>>Iowa</option>
                    <option disabled value="KS" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'KS') {echo ' selected';} ?>>Kansas</option>
                    <option disabled value="KY" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'KY') {echo ' selected';} ?>>Kentucky</option>
                    <option disabled value="LA" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'LA') {echo ' selected';} ?>>Louisiana</option>
                    <option disabled value="ME" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'ME') {echo ' selected';} ?>>Maine</option>
                    <option disabled value="MD" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'MD') {echo ' selected';} ?>>Maryland</option>
                    <option disabled value="MA" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'MA') {echo ' selected';} ?>>Massachusetts</option>
                    <option disabled value="MI" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'MI') {echo ' selected';} ?>>Michigan</option>
                    <option disabled value="MN" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'MN') {echo ' selected';} ?>>Minnesota</option>
                    <option disabled value="MS" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'MS') {echo ' selected';} ?>>Mississippi</option>
                    <option disabled value="MO" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'MO') {echo ' selected';} ?>>Missouri</option>
                    <option disabled value="MT" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'MT') {echo ' selected';} ?>>Montana</option>
                    <option disabled value="NE" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'NE') {echo ' selected';} ?>>Nebraska</option>
                    <option disabled value="NV" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'NV') {echo ' selected';} ?>>Nevada</option>
                    <option disabled value="NH" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'NH') {echo ' selected';} ?>>New Hampshire</option>
                    <option disabled value="NJ" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'NJ') {echo ' selected';} ?>>New Jersey</option>
                    <option disabled value="NM" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'NM') {echo ' selected';} ?>>New Mexico</option>
                    <option disabled value="NY" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'NY') {echo ' selected';} ?>>New York</option>
                    <option disabled value="NC" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'NC') {echo ' selected';} ?>>North Carolina</option>
                    <option disabled value="ND" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'ND') {echo ' selected';} ?>>North Dakota</option>
                    <option disabled value="OH" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'OH') {echo ' selected';} ?>>Ohio</option>
                    <option disabled value="OK" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'OK') {echo ' selected';} ?>>Oklahoma</option>
                    <option disabled value="OR" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'OR') {echo ' selected';} ?>>Oregon</option>
                    <option disabled value="PA" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'PA') {echo ' selected';} ?>>Pennsylvania</option>
                    <option disabled value="RI" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'RI') {echo ' selected';} ?>>Rhode Island</option>
                    <option disabled value="SC" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'SC') {echo ' selected';} ?>>South Carolina</option>
                    <option disabled value="SD" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'SD') {echo ' selected';} ?>>South Dakota</option>
                    <option disabled value="TN" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'TN') {echo ' selected';} ?>>Tennessee</option>
                    <option disabled value="TX" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'TX') {echo ' selected';} ?>>Texas</option>
                    <option disabled value="UT" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'UT') {echo ' selected';} ?>>Utah</option>
                    <option disabled value="VT" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'VT') {echo ' selected';} ?>>Vermont</option>
                    <option disabled value="VA" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'VA') {echo ' selected';} ?>>Virginia</option>
                    <option disabled value="WA" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'WA') {echo ' selected';} ?>>Washington</option>
                    <option disabled value="WV" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'WV') {echo ' selected';} ?>>West Virginia</option>
                    <option disabled value="WI" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'WI') {echo ' selected';} ?>>Wisconsin</option>
                    <option disabled value="WY" <?php if(!empty($shortcode_buildout['state']) && $shortcode_buildout['state'] == 'WY') {echo ' selected';} ?>>Wyoming</option>
                </select>
            </p>

            <p>
            <label for="new_site_search_zip">New Site Zip</label>
            Zipcode limiter for search page on new site.
            <br />
                <input type="text" name="new_site_search_zip" value="" />
            </p>

            <p><a class="ic_ao_toggle">Click to view/hide advanced settings.</a></p>
            </div><!--ic_advanced_options-->



            <br />
            <hr />
            <p>
            <input type="submit" value="GENERATE SITE" class="ic-generate-button" />
            </p>
        </form>
        <?php
    } else {
        $ic_crawler = new ic_crawler('execute');
    }
    echo '</div>';
}

/*------------------------------------------------*/
/* Register Extras                                */
/*------------------------------------------------*/
function ic_register_admin_stylesheets()
{
    wp_enqueue_style('ic-admin-style', ic_URL . 'admin/css/ic.css');
}

add_action('admin_init', 'ic_register_admin_stylesheets');

function register_ic_js($hook) {
    if ($_GET['page'] != 'instance-controller') {
        return;
    }
    wp_enqueue_script('jquery');
    wp_enqueue_script('my_custom_script', plugin_dir_url(__FILE__) . '/admin/js/instance_controller_admin.js');
}

add_action('admin_enqueue_scripts', 'register_ic_js');

/*-------------------------------------------------------------*/
?>
