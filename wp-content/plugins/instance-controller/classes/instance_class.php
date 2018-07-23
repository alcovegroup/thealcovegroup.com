<?php
global $wpdb;

class ic_crawler {
    public $new_site_params = array(
        'multisite_type' => '',
        'origin_site_id' => '',
        'search_homes_template' => '',
        'home_value_template' => '',
        'new_site_domain' => '',
        'new_site_path' => '',
        'new_site_title' => '',
        'new_site_admin' => '',
        'new_site_theme' => '',
        'new_site_search_city' => '',
        'new_site_search_state' => '',
        'new_site_search_zip' => '',
        );
    public $new_site_id = '';
    public $haspost;
    public $user_list;
    public $last_id = '';
    public $POST_err = array();
    public $run_err = array();

    function __construct($command='') {
        $this->user_list = $this->list_users();
        if($command == 'execute') {
            $this->execute();
        }
    }

    function execute() {
        $this->haspost = $_GET['generate-instance'];
        $filter_pattern = '~([^a-zA-Z0-9\/_-])~';
        #################################################
        # POST CHECK
        #################################################
        $this->new_site_params['multisite_type'] = $_POST['multisite_type'];
        //$this->new_site_params['origin_site_id'] = $_POST['origin_site_id'];
        $this->new_site_params['origin_site_id'] = 'BASE';
        $this->new_site_params['search_homes_template'] = $_POST['search_homes_template'];
        $this->new_site_params['home_value_template'] = $_POST['home_value_template'];
        $this->new_site_params['new_site_domain'] = $_POST['new_site_domain'];
        $this->new_site_params['new_site_path'] = $_POST['new_site_path'];
        $this->new_site_params['new_site_title'] = $_POST['new_site_title'];
        $this->new_site_params['new_site_admin'] = $_POST['new_site_admin'];
        $this->new_site_params['new_site_theme'] = $_POST['new_site_theme'];
        $this->new_site_params['new_site_search_city'] = $_POST['new_site_search_city'];
        $this->new_site_params['new_site_search_state'] = $_POST['new_site_search_state'];
        $this->new_site_params['new_site_search_zip'] = $_POST['new_site_search_zip'];
        $updated_path = str_replace('/', '', $_POST['new_site_path']);
        $updated_path = str_replace(' ', '-', $updated_path);
        $updated_path = preg_replace($filter_pattern, '', $updated_path);
        $updated_path = strtolower($updated_path);
        $updated_path = '/'.$updated_path.'/';
        $this->new_site_params['new_site_path'] = $updated_path;
        #################################
        # ERROR HANDLING
        #################################
        if(preg_match($filter_pattern, $updated_path)) {
            $this->POST_err[] = 'Critical error: New site path contains invalid characters.';
        }
        foreach($this->new_site_params as $param => $value) {
            if(empty($value) && !preg_match('~new_site_search~', $param)) {
                $this->POST_err[] = 'The following parameter is missing: ' . $param;
            }
        }
        $has_errors = $this->has_errors();
        if(!$has_errors) {
        echo '...:::INITIATED:::...<hr />';
        $this->site_generator($this->new_site_params);
        echo 'Site framework generated. Site ID: ' . $this->new_site_id;
        //echo '<hr />';
        $this->get_acf_posts();
        $this->get_cpt_posts();
        $this->get_active_plugins();
        $this->get_mls_creds();
        $this->get_global_fields();
        $this->get_search_homes_page();
        $this->get_menu_items();
        $this->get_terms_table();
        $this->get_term_tax_table();
        $this->get_menu_options();
        $this->get_home_value_page();
        $this->get_theme_settings();
        $this->shortcode_params();
        $newblogurl = get_blog_details($this->new_site_id);
        //echo '<hr />';
        echo '<h1>ALL ITEMS COMPLETED SUCCESSFULLY</h1>';
        echo '<h1><a href="'. $newblogurl->siteurl .'">CLICK HERE TO GO TO SITE</a></h1>';
        }
    }

    function DBConnect() {
        #############################################
        $DB_HOST = 'localhost';
        $DB_USERNAME = DB_USER;
        $DB_PASSWORD = DB_PASSWORD;
        $DB_DATABASE = DB_NAME;
        #############################################
        $db_connection = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD);
        mysqli_select_db($db_connection, $DB_DATABASE);
        if (mysqli_connect_errno()) {
            printf("DB Connect Fail: %s\n", mysqli_connect_error());
        } else {
            return $db_connection;
        }
        mysqli_close($db_connection);
    }

    function has_errors() {
        if(count($this->POST_err) > 0 && $this->haspost == 'go') {
            echo '<h1 class="ic-error">Could not initialize. The following errors occurred:</h1>';
            echo '<ul style="list-style:disc; list-style-position:inside;">';
            foreach($this->POST_err as $error) {
                echo '<li class="ic-error">'.$error.'</li>';
            }
            echo '</ul>';
            return true;
        } else {
            return false;
        }
    }

    function get_current_site_id() {
        $current_site_id = get_current_blog_id();
        if(empty($current_site_id)) {
            echo 'Critical error. $WPDB not loaded.';
            exit;
        }
        return $current_site_id;
    }

    function shortcode_params() {
        $localConnection = $this->DBConnect();
        $shortcode_params = array(
            'global_mlsshortcode_city' => $this->new_site_params['new_site_search_city'],
            'global_mlsshortcode_state' => $this->new_site_params['new_site_search_state'],
            'global_mlsshortcode_zip' => $this->new_site_params['new_site_search_zip']
            );
        $site_id = $this->new_site_id;
        $table = ($site_id == '1') ? 'wp_options' : 'wp_'.$site_id.'_options';
        foreach($shortcode_params as $field => $value) {
            if(!empty($value)) {
                $sqlQuery = "UPDATE {$table} SET option_value = '{$value}' WHERE option_name = '{$field}'";
                $results = mysqli_query($localConnection, $sqlQuery);
                $error = 'SHORTCODE_PARAMS FUNCTION';
                if (!$results){
                    echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
                    $this->run_err[] = $error;
                } else {
                    //echo '<br /> <span class="highlight2"> INSERT SEARCH TEMPLATE SUCCESSFUL</span>';
                }
            }
        }
    }

    function get_acf_posts() {
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_posts' : 'wp_'.$site_id.'_posts';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_posts';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT * FROM {$table} WHERE post_type LIKE '%acf%'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'GET_ACF_POSTS FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            //echo 'ACF Posts completed. Counted ' . $thecount . ' records.';
            #################################
            # INJECTION PROCESSING
            #################################
            foreach($results_array as $row) {
                //unset($row['ID']);
                $column_names = implode(", ",array_keys($row));
                $prepared_values = array();
                foreach($row as $name => $value) {
                    $value = mysqli_real_escape_string($localConnection, $value);
                    $prepared_values[] = '\''.$value.'\'';
                }
                $column_values  = implode(", ", $prepared_values);
                $this->injection($dest_table, $column_names, $column_values);
            }
            //echo '<hr />';
        }
    }

    function get_cpt_posts() {
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_options' : 'wp_'.$site_id.'_options';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_options';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT * FROM {$table} WHERE option_name LIKE '%cpt%'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'GET_CPT_POSTS FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            //echo 'CPT Posts completed. Counted ' . $thecount . ' records.';
            #################################
            # INJECTION PROCESSING
            #################################
            foreach($results_array as $row) {
                unset($row['option_id']);
                $column_names = implode(", ",array_keys($row));
                $prepared_values = array();
                foreach($row as $name => $value) {
                    $value = mysqli_real_escape_string($localConnection, $value);
                    $prepared_values[] = '\''.$value.'\'';
                }
                $column_values  = implode(", ", $prepared_values);
                $this->injection($dest_table, $column_names, $column_values);
            }
            //echo '<hr />';
        }
    }

    function get_menu_items() {
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_posts' : 'wp_'.$site_id.'_posts';
        $localConnection = $this->DBConnect();
            #################################
            # Define Menu
            #################################
            $menu_array = array(
                array(
                    'post_author' => $this->new_site_params['new_site_admin'],
                    'post_date' => '2017-07-13 05:54:35',
                    'post_date_gmt' => '2017-07-13 05:54:35',
                    'post_content' => '',
                    'post_title' => $this->new_site_params['new_site_title'] . ' Home',
                    'post_excerpt' => '',
                    'post_status' => 'publish',
                    'comment_status' => 'closed',
                    'ping_status' => 'closed',
                    'post_password' => '',
                    'post_name' => 'menu_home',
                    'to_ping' => '',
                    'pinged' => '',
                    'post_modified' => '2017-07-13 05:54:35',
                    'post_modified_gmt' => '2017-07-13 05:54:35',
                    'post_content_filtered' => '',
                    'post_parent' => '0',
                    'guid' => '',
                    'menu_order' => '4',
                    'post_type' => 'nav_menu_item',
                    'post_mime_type' => '',
                    'comment_count' => '0'
                    ),
                array(
                    'post_author' => $this->new_site_params['new_site_admin'],
                    'post_date' => '2017-07-13 05:54:35',
                    'post_date_gmt' => '2017-07-13 05:54:35',
                    'post_content' => '',
                    'post_title' => $this->new_site_params['new_site_title'] . ' Home',
                    'post_excerpt' => '',
                    'post_status' => 'publish',
                    'comment_status' => 'closed',
                    'ping_status' => 'closed',
                    'post_password' => '',
                    'post_name' => 'menu_home2',
                    'to_ping' => '',
                    'pinged' => '',
                    'post_modified' => '2017-07-13 05:54:35',
                    'post_modified_gmt' => '2017-07-13 05:54:35',
                    'post_content_filtered' => '',
                    'post_parent' => '0',
                    'guid' => '',
                    'menu_order' => '4',
                    'post_type' => 'nav_menu_item',
                    'post_mime_type' => '',
                    'comment_count' => '0'
                    ),
                array(
                    'post_author' => $this->new_site_params['new_site_admin'],
                    'post_date' => '2017-07-13 05:54:35',
                    'post_date_gmt' => '2017-07-13 05:54:35',
                    'post_content' => '',
                    'post_title' => 'Find Your ' . $this->new_site_params['new_site_search_city'] . ' Home Value',
                    'post_excerpt' => '',
                    'post_status' => 'publish',
                    'comment_status' => 'closed',
                    'ping_status' => 'closed',
                    'post_password' => '',
                    'post_name' => 'menu_home_value',
                    'to_ping' => '',
                    'pinged' => '',
                    'post_modified' => '2017-07-13 05:54:35',
                    'post_modified_gmt' => '2017-07-13 05:54:35',
                    'post_content_filtered' => '',
                    'post_parent' => '0',
                    'guid' => '',
                    'menu_order' => '3',
                    'post_type' => 'nav_menu_item',
                    'post_mime_type' => '',
                    'comment_count' => '0'
                    ),
                array(
                    'post_author' => $this->new_site_params['new_site_admin'],
                    'post_date' => '2017-07-13 05:54:35',
                    'post_date_gmt' => '2017-07-13 05:54:35',
                    'post_content' => '',
                    'post_title' => 'Find Your ' . $this->new_site_params['new_site_search_city'] . ' Home Value',
                    'post_excerpt' => '',
                    'post_status' => 'publish',
                    'comment_status' => 'closed',
                    'ping_status' => 'closed',
                    'post_password' => '',
                    'post_name' => 'menu_home_value2',
                    'to_ping' => '',
                    'pinged' => '',
                    'post_modified' => '2017-07-13 05:54:35',
                    'post_modified_gmt' => '2017-07-13 05:54:35',
                    'post_content_filtered' => '',
                    'post_parent' => '0',
                    'guid' => '',
                    'menu_order' => '3',
                    'post_type' => 'nav_menu_item',
                    'post_mime_type' => '',
                    'comment_count' => '0'
                    ),
                array(
                    'post_author' => $this->new_site_params['new_site_admin'],
                    'post_date' => '2017-07-13 05:54:35',
                    'post_date_gmt' => '2017-07-13 05:54:35',
                    'post_content' => '',
                    'post_title' => 'Search ' . $this->new_site_params['new_site_search_city'] . ' Homes',
                    'post_excerpt' => '',
                    'post_status' => 'publish',
                    'comment_status' => 'closed',
                    'ping_status' => 'closed',
                    'post_password' => '',
                    'post_name' => 'menu_search',
                    'to_ping' => '',
                    'pinged' => '',
                    'post_modified' => '2017-07-13 05:54:35',
                    'post_modified_gmt' => '2017-07-13 05:54:35',
                    'post_content_filtered' => '',
                    'post_parent' => '0',
                    'guid' => '',
                    'menu_order' => '2',
                    'post_type' => 'nav_menu_item',
                    'post_mime_type' => '',
                    'comment_count' => '0'
                    ),
                array(
                    'post_author' => $this->new_site_params['new_site_admin'],
                    'post_date' => '2017-07-13 05:54:35',
                    'post_date_gmt' => '2017-07-13 05:54:35',
                    'post_content' => '',
                    'post_title' => 'Search ' . $this->new_site_params['new_site_search_city'] . ' Homes',
                    'post_excerpt' => '',
                    'post_status' => 'publish',
                    'comment_status' => 'closed',
                    'ping_status' => 'closed',
                    'post_password' => '',
                    'post_name' => 'menu_search2',
                    'to_ping' => '',
                    'pinged' => '',
                    'post_modified' => '2017-07-13 05:54:35',
                    'post_modified_gmt' => '2017-07-13 05:54:35',
                    'post_content_filtered' => '',
                    'post_parent' => '0',
                    'guid' => '',
                    'menu_order' => '2',
                    'post_type' => 'nav_menu_item',
                    'post_mime_type' => '',
                    'comment_count' => '0'
                    ),
                array(
                    'post_author' => $this->new_site_params['new_site_admin'],
                    'post_date' => '2017-07-13 05:54:35',
                    'post_date_gmt' => '2017-07-13 05:54:35',
                    'post_content' => '',
                    'post_title' => $this->new_site_params['new_site_search_city'] . ' Featured Homes',
                    'post_excerpt' => '',
                    'post_status' => 'publish',
                    'comment_status' => 'closed',
                    'ping_status' => 'closed',
                    'post_password' => '',
                    'post_name' => 'menu_featured_homes',
                    'to_ping' => '',
                    'pinged' => '',
                    'post_modified' => '2017-07-13 05:54:35',
                    'post_modified_gmt' => '2017-07-13 05:54:35',
                    'post_content_filtered' => '',
                    'post_parent' => '0',
                    'guid' => '',
                    'menu_order' => '1',
                    'post_type' => 'nav_menu_item',
                    'post_mime_type' => '',
                    'comment_count' => '0'
                    ),
                array(
                    'post_author' => $this->new_site_params['new_site_admin'],
                    'post_date' => '2017-07-13 05:54:35',
                    'post_date_gmt' => '2017-07-13 05:54:35',
                    'post_content' => '',
                    'post_title' => $this->new_site_params['new_site_search_city'] . ' Featured Homes',
                    'post_excerpt' => '',
                    'post_status' => 'publish',
                    'comment_status' => 'closed',
                    'ping_status' => 'closed',
                    'post_password' => '',
                    'post_name' => 'menu_featured_homes2',
                    'to_ping' => '',
                    'pinged' => '',
                    'post_modified' => '2017-07-13 05:54:35',
                    'post_modified_gmt' => '2017-07-13 05:54:35',
                    'post_content_filtered' => '',
                    'post_parent' => '0',
                    'guid' => '',
                    'menu_order' => '1',
                    'post_type' => 'nav_menu_item',
                    'post_mime_type' => '',
                    'comment_count' => '0'
                    ),
                );
                #################################
                # INJECTION PROCESSING
                #################################
                $menu_custom_links = array(
                    $this->new_site_params['new_site_path'],
                    $this->new_site_params['new_site_path'],
                    $this->new_site_params['new_site_path'].'find-your-homes-value/',
                    $this->new_site_params['new_site_path'].'find-your-homes-value/',
                    $this->new_site_params['new_site_path'].'search-homes/',
                    $this->new_site_params['new_site_path'].'search-homes/',
                    $this->new_site_params['new_site_path'].'#featured-home-0',
                    $this->new_site_params['new_site_path'].'#featured-home-0'
                    );
                $menu_custom_tax = array(
                    '2',
                    '3',
                    '2',
                    '3',
                    '2',
                    '3',
                    '2',
                    '3'
                    );
                $menu_custom_count = 0;
                $menu_custom_tax_count = 0;
                foreach($menu_array as $row) {
                    $dest_id = $this->new_site_id;
                    $dest_table = 'wp_'.$dest_id.'_posts';
                    $column_names = implode(", ",array_keys($row));
                    $prepared_values = array();
                    foreach($row as $name => $value) {
                        $dest_city = $this->new_site_params['new_site_search_city'];
                        $value = mysqli_real_escape_string($localConnection, $value);
                        $prepared_values[] = '\''.$value.'\'';
                    }
                $column_values  = implode(", ", $prepared_values);
                $this->injection($dest_table, $column_names, $column_values);
                $last_id = $this->last_id;
                $this->get_term_relationships($last_id, $menu_custom_tax[$menu_custom_tax_count]);
                $menu_custom_tax_count++;
                //echo '<br />';
                //echo 'COMPLETE MENU RECORD LAST ID ' . $last_id;
                #################################
                # INJECT META
                #################################
                $metadata_array = array(
                    array(
                        'post_id' => $last_id,
                        'meta_key' => 'sr_filters',
                        'meta_value' => ''
                        ),
                    array(
                        'post_id' => $last_id,
                        'meta_key' => 'sr_page_template',
                        'meta_value' => ''
                        ),
                    array(
                        'post_id' => $last_id,
                        'meta_key' => '_menu_item_type',
                        'meta_value' => ''
                        ),
                    array(
                        'post_id' => $last_id,
                        'meta_key' => '_menu_item_menu_item_parent',
                        'meta_value' => ''
                        ),
                    array(
                        'post_id' => $last_id,
                        'meta_key' => '_menu_item_object_id',
                        'meta_value' => $last_id
                        ),
                    array(
                        'post_id' => $last_id,
                        'meta_key' => '_menu_item_object',
                        'meta_value' => 'custom'
                        ),
                    array(
                        'post_id' => $last_id,
                        'meta_key' => '_menu_item_target',
                        'meta_value' => ''
                        ),
                    array(
                        'post_id' => $last_id,
                        'meta_key' => '_menu_item_classes',
                        'meta_value' => 'a:1:{i:0;s:0:"";}'
                        ),
                    array(
                        'post_id' => $last_id,
                        'meta_key' => '_menu_item_xfn',
                        'meta_value' => ''
                        ),
                    array(
                        'post_id' => $last_id,
                        'meta_key' => '_menu_item_url',
                        'meta_value' => $menu_custom_links[$menu_custom_count]
                        ),
                    );
                foreach($metadata_array as $record) {
                    $column_names = implode(", ",array_keys($record));
                    $prepared_values = array();
                    foreach($record as $name => $value) {
                        $value = mysqli_real_escape_string($localConnection, $value);
                        $prepared_values[] = '\''.$value.'\'';
                    }
                    $column_values  = implode(", ", $prepared_values);
                    $dest_id = $this->new_site_id;
                    $dest_table = 'wp_'.$dest_id.'_postmeta';
                    $this->injection($dest_table, $column_names, $column_values);
                    if($record['meta_key'] == '_menu_item_url') {
                        $menu_custom_count++;
                    }
                }
                //echo '<hr />';
                #################################
                # INJECTI TERM DATA
                #################################
                //$this->get_term_relationships($stored_post_id, $last_id);
            }
            //echo '<hr />';
    }

    function get_terms_table() {
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_terms' : 'wp_'.$site_id.'_terms';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_terms';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT * FROM {$table} WHERE name != 'Uncategorized'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'GET TERMS TABLE FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            //echo 'Terms Table completed. Counted ' . $thecount . ' records.';
            #################################
            # INJECTION PROCESSING
            #################################
            foreach($results_array as $row) {
                unset($row['option_id']);
                $column_names = implode(", ",array_keys($row));
                $prepared_values = array();
                foreach($row as $name => $value) {
                    $value = mysqli_real_escape_string($localConnection, $value);
                    $prepared_values[] = '\''.$value.'\'';
                }
                $column_values  = implode(", ", $prepared_values);
                $this->injection($dest_table, $column_names, $column_values);
            }
            //echo '<hr />';
        }
    }

    function get_term_tax_table() {
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_term_taxonomy' : 'wp_'.$site_id.'_term_taxonomy';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_term_taxonomy';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT * FROM {$table} WHERE taxonomy != 'category'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'GET TERM TAX TABLE FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            //echo 'Terms tax table completed. Counted ' . $thecount . ' records.';
            #################################
            # INJECTION PROCESSING
            #################################
            foreach($results_array as $row) {
                unset($row['option_id']);
                $column_names = implode(", ",array_keys($row));
                $prepared_values = array();
                foreach($row as $name => $value) {
                    $value = mysqli_real_escape_string($localConnection, $value);
                    $prepared_values[] = '\''.$value.'\'';
                }
                $column_values  = implode(", ", $prepared_values);
                $this->injection($dest_table, $column_names, $column_values);
            }
            //echo '<hr />';
        }
    }

    function get_menu_options() {
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_options' : 'wp_'.$site_id.'_options';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_options';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT * FROM {$table} WHERE option_name LIKE '%theme_mods%'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'GET MENU OPTIONS FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            //echo 'Menu options completed. Counted ' . $thecount . ' records.';
            #################################
            # INJECTION PROCESSING
            #################################
            foreach($results_array as $row) {
                unset($row['option_id']);
                $column_names = implode(", ",array_keys($row));
                $prepared_values = array();
                foreach($row as $name => $value) {
                    $value = mysqli_real_escape_string($localConnection, $value);
                    $prepared_values[] = '\''.$value.'\'';
                }
                $column_values  = implode(", ", $prepared_values);
                $this->injection($dest_table, $column_names, $column_values);
            }
            //echo '<hr />';
        }
    }

    function get_term_relationships($post_id, $tax_id) {
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_term_relationships';
        $localConnection = $this->DBConnect();
        $injection_array = array(
            'object_id' => $post_id,
            'term_taxonomy_id' => $tax_id,
            'term_order' => '0'
            );
            $column_names = implode(", ",array_keys($injection_array));
            $prepared_values = array();
            foreach($injection_array as $name => $value) {
                $value = mysqli_real_escape_string($localConnection, $value);
                $prepared_values[] = '\''.$value.'\'';
            }
            $column_values  = implode(", ", $prepared_values);
            $this->injection($dest_table, $column_names, $column_values);
        //echo '<br />Term _term_relationships complete.';
        //echo '<hr />';
    }

    function check_existing_site_path($path) {
        $table = 'wp_blogs';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT blog_id, path FROM {$table} WHERE path = '{$path}'";
        $sqlRun = mysqli_query($localConnection, $sqlQuery);
        $error = 'CHECK EXISTING SITE PATH FUNCTION';
        if (!$sqlRun) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            $results_array = $this->process_results($sqlRun);
            mysqli_free_result($sqlRun);
            $count = count($results_array);
            if($count > 0) {
                return false;
            } else {
                return true;
            }
        }
    }

    function get_mls_creds() {
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_options' : 'wp_'.$site_id.'_options';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_options';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT * FROM {$table} WHERE option_name LIKE '%sr_%'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'GET MLS CREDS FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            //echo 'MLS Creds completed. Counted ' . $thecount . ' records.';
            #################################
            # INJECTION PROCESSING
            #################################
            foreach($results_array as $row) {
                unset($row['option_id']);
                $column_names = implode(", ",array_keys($row));
                $prepared_values = array();
                foreach($row as $name => $value) {
                    $value = mysqli_real_escape_string($localConnection, $value);
                    $prepared_values[] = '\''.$value.'\'';
                }
                $column_values  = implode(", ", $prepared_values);
                $this->injection($dest_table, $column_names, $column_values);
            }
            //echo '<hr />';
        }
    }

    function get_global_fields() {
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_options' : 'wp_'.$site_id.'_options';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_options';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT * FROM {$table} WHERE option_name LIKE '%global_%'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'GET GLOBAL FIELDS FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            //echo 'Global Fields completed. Counted ' . $thecount . ' records.';
            #################################
            # INJECTION PROCESSING
            #################################
            foreach($results_array as $row) {
                unset($row['option_id']);
                $column_names = implode(", ",array_keys($row));
                $prepared_values = array();
                foreach($row as $name => $value) {
                    $value = mysqli_real_escape_string($localConnection, $value);
                    $prepared_values[] = '\''.$value.'\'';
                }
                $column_values  = implode(", ", $prepared_values);
                $this->injection($dest_table, $column_names, $column_values);
            }
            //echo '<hr />';
        }
    }

    function get_active_plugins() {
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_options' : 'wp_'.$site_id.'_options';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_options';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT * FROM {$table} WHERE option_name ='active_plugins'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'GET ACTIVE PLUGINS FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            //echo 'Active Plugins completed. Counted ' . $thecount . ' records.';
            #################################
            # INJECTION PROCESSING
            #################################
            foreach($results_array as $row) {
                unset($row['option_id']);
                $column_names = implode(", ",array_keys($row));
                $prepared_values = array();
                foreach($row as $name => $value) {
                    if($name == 'option_value') {
                        $value = mysqli_real_escape_string($localConnection, $value);
                        $prepared_values[] = '\''.$value.'\'';
                    }
                }
                $column_values = $prepared_values[0];
                $this->update_plugins($dest_table, $column_values);
            }
            //echo '<hr />';
        }
    }


    function get_search_homes_page() {
        $search_page = $this->find_search_homes_template();
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_posts' : 'wp_'.$site_id.'_posts';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_posts';
        $dest_city = $this->new_site_params['new_site_search_city'];
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT * FROM {$table} WHERE ID ='{$search_page}'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'GET SEARCH HOMES PAGE FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            //echo 'Search Homes page found. Post ID: ' . $search_page . '.';
            #################################
            # INJECTION PROCESSING
            #################################
            foreach($results_array as $row) {
                unset($row['ID']);
                $column_names = implode(", ",array_keys($row));
                $prepared_values = array();
                foreach($row as $name => $value) {
                    if($name == 'post_title') {
                    $value = 'Search ' . $dest_city . ' Homes';
                }
                    $value = mysqli_real_escape_string($localConnection, $value);
                    $prepared_values[] = '\''.$value.'\'';
                }
                $column_values  = implode(", ", $prepared_values);
                $last_id = $this->injection($dest_table, $column_names, $column_values, 'last_id');
                $dest_table = 'wp_'.$dest_id.'_postmeta';
                $this->update_search_template($dest_table, $last_id);
            }
            //echo '<hr />';
        }
    }

    function find_search_homes_template() {
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_postmeta' : 'wp_'.$site_id.'_postmeta';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_postmeta';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT post_id FROM {$table} WHERE (meta_key ='_wp_page_template' AND meta_value LIKE '%template-search-%')";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'FIND SEARCH HOMES TEMPLATE FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            return $results_array[0]['post_id'];
        }
    }

    function get_home_value_page() {
        $search_page = $this->find_home_value_template();
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_posts' : 'wp_'.$site_id.'_posts';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_posts';
        $dest_city = $this->new_site_params['new_site_search_city'];
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT * FROM {$table} WHERE ID ='{$search_page}'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'GET HOME VALUE PAGE FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            //echo 'Home Value page found. Post ID: ' . $search_page . '.';
            #################################
            # INJECTION PROCESSING
            #################################
            foreach($results_array as $row) {
                unset($row['ID']);
                $column_names = implode(", ",array_keys($row));
                $prepared_values = array();
                foreach($row as $name => $value) {
                    $value = preg_replace('~^(Find your)(.*)(Home.*)$~i', '$1 '.$dest_city.' $3', $value);
                    $value = mysqli_real_escape_string($localConnection, $value);
                    $prepared_values[] = '\''.$value.'\'';
                }
                $column_values  = implode(", ", $prepared_values);
                $last_id = $this->injection($dest_table, $column_names, $column_values, 'last_id');
                $dest_table = 'wp_'.$dest_id.'_postmeta';
                $this->update_home_value_template($dest_table, $last_id);
            }
            //echo '<hr />';
        }
    }

    function find_home_value_template() {
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_postmeta' : 'wp_'.$site_id.'_postmeta';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_postmeta';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT post_id FROM {$table} WHERE (meta_key ='_wp_page_template' AND meta_value LIKE '%home-value%')";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'FIND HOME VALUES TEMPLATE FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            return $results_array[0]['post_id'];
        }
    }

    function get_theme_settings() {
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_options' : 'wp_'.$site_id.'_options';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_options';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT * FROM {$table} WHERE (option_name ='template' OR option_name = 'stylesheet')";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'GET THEME SETTINGS FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            //echo 'Theme Settings completed. Counted ' . $thecount . ' records.';
            #################################
            # INJECTION PROCESSING
            #################################
            foreach($results_array as $row) {
                unset($row['option_id']);
                $column_names = implode(", ",array_keys($row));
                $prepared_values = array();
                foreach($row as $name => $value) {
                    if($name == 'option_value') {
                        $value = mysqli_real_escape_string($localConnection, $value);
                        $prepared_values[] = '\''.$value.'\'';
                    }
                }
                $column_values = $prepared_values[0];
                $this->update_theme($dest_table, $column_values, $row['option_name']);
            }
            //echo '<hr />';
        }
    }

    function process_results($thing) {
        $results_array = array();
        while ($row = $thing->fetch_array(MYSQLI_ASSOC)) {
            $results_array[] = $row;
        }
        return $results_array;
    }

    function site_generator($params) {
        $path_validation = $this->check_existing_site_path($params['new_site_path']);
        if(!$path_validation) {
            $this->POST_err[] = 'A site with that path already exists.';
        }
        if($this->has_errors()) {
            exit;
        } else {
            $blog_id = wpmu_create_blog( $params['new_site_domain'], $params['new_site_path'], $params['new_site_title'], $params['new_site_admin'] , array( 'public' => 1 ));
            $this->new_site_id = $blog_id;
        }
    }

    function injection($table, $column_names, $column_values, $last_id = '') {
        $localConnection = $this->DBConnect();
        $sqlQuery = "INSERT INTO {$table} ($column_names) VALUES ($column_values)";
        $results = mysqli_query($localConnection, $sqlQuery);
        $search_homes_id = mysqli_insert_id($localConnection);
        $this->last_id = $search_homes_id;
        $error = 'INJECTION FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            //echo '<br /> <span class="highlight2"> INSERT SUCCESSFUL</span>';
            if($last_id == 'last_id') {
                return $search_homes_id;
            }
        }
    }

    function update_plugins($table, $value) {
        $localConnection = $this->DBConnect();
        $sqlQuery = "UPDATE {$table} SET option_value = {$value} WHERE option_name = 'active_plugins'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'UPDATE PLUGINS FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            //echo '<br /> <span class="highlight2"> ACTIVE PLUGINS UPDATE SUCCESSFUL</span>';
        }
    }

    function update_theme($table, $value, $part) {
        $localConnection = $this->DBConnect();
        $sqlQuery = "UPDATE {$table} SET option_value = {$value} WHERE option_name = '{$part}'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'UPDATE THEME FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
           //echo '<br /> <span class="highlight2"> THEME UPDATE ('.$part.') SUCCESSFUL</span>';
        }
    }

    function update_search_template($table, $value) {
        $localConnection = $this->DBConnect();
        $search_homes_template = $this->new_site_params['search_homes_template'];
        $sqlQuery = "INSERT INTO {$table} (post_id, meta_key, meta_value) VALUES('{$value}', '_wp_page_template', '{$search_homes_template}')";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'UPDATE SEARCH TEMPLATE FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            //echo '<br /> <span class="highlight2"> INSERT SEARCH TEMPLATE SUCCESSFUL</span>';
        }
    }

    function update_home_value_template($table, $value) {
        $localConnection = $this->DBConnect();
        $home_value_template = $this->new_site_params['home_value_template'];
        $sqlQuery = "INSERT INTO {$table} (post_id, meta_key, meta_value) VALUES('{$value}', '_wp_page_template', '{$home_value_template}')";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'UPDATE HOME VALUE TEMPLATE FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            //echo '<br /> <span class="highlight2"> INSERT HOME VALUE TEMPLATE SUCCESSFUL</span>';
        }
    }

    function list_users() {
        $table = 'wp_users';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT ID, display_name FROM {$table}";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = 'LIST USERS FUNCTION';
        if (!$results) {
            echo '<br />FAIL ON: '.$error.'<span class="highlight2">'.$sqlQuery.'</span>';
            $this->run_err[] = $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            return $results_array;
        }
    }
}
?>