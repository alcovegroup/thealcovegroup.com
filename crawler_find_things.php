<?php
$thetitle = 'AC Instantiatior';
require_once('wp-load.php');
global $wpdb;
$pattern_to_match = '~(field|type)="(.*?)"~';
$replacement_text = '$1=\'$2\'';
?>

<?php
class admin_crawler {
    public $new_site_params = array(
        'multisite_type' => 'subdomain',
        'origin_site_id' => '1',
        'search_homes_template' => 'template-search-by-city.php',
        'new_site_domain' => 'mlsdev.liquinas.com',
        'new_site_path' => '/newmlssite/',
        'new_site_title' => 'New MLS Site',
        'new_site_admin' => '1',
        'new_site_theme' => 'thealcovegroup-microsite',
        'new_site_search_city' => 'Phoenix',
        'new_site_search_state' => 'AZ',
        'new_site_search_zip' => '',
        );
    public $new_site_id = '5';

    function __construct() {
        echo '...:::INITIATED:::...<hr />';
        $this->site_generator($this->new_site_params);
        echo 'Job Complete. Site ID: ' . $this->new_site_id;
        echo '<hr />';
        $this->get_acf_posts();
        $this->get_cpt_posts();
        $this->get_active_plugins();
        $this->get_mls_creds();
        $this->get_global_fields();
        $this->get_search_homes_page();
        $this->get_theme_settings();
    }

    function DBConnect() {
        #############################################
        $DB_HOST = 'localhost';
        $DB_USERNAME = "liquinas_liq";
        $DB_PASSWORD = "Pachunga99!";
        $DB_DATABASE = "liquinas_mlsdev";
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

    function get_current_site_id() {
        $current_site_id = get_current_blog_id();
        if(empty($current_site_id)) {
            echo 'Critical error. $WPDB not loaded.';
            exit;
        }
        return $current_site_id;
    }

    function get_acf_posts() {
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_posts' : 'wp_'.$site_id.'_posts';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_posts';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT * FROM {$table} WHERE post_type LIKE '%acf%'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = "<hr /><b>Error on GET_ACF_POSTS</b>.\n<br />Query: <span class='error'>" . $sqlQuery . '</span>';
        if (!$results) {
            echo $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            echo 'ACF Posts completed. Counted ' . $thecount . ' records.';
            #################################
            # INJECTION PROCESSING
            #################################
            foreach($results_array as $row) {
                unset($row['ID']);
                $column_names = implode(", ",array_keys($row));
                $prepared_values = array();
                foreach($row as $name => $value) {
                    $value = mysqli_real_escape_string($localConnection, $value);
                    $prepared_values[] = '\''.$value.'\'';
                }
                $column_values  = implode(", ", $prepared_values);
                $this->injection($dest_table, $column_names, $column_values);
            }
            echo '<hr />';
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
        $error = "<hr /><b>Error on GET_CPT_POSTS</b>.\n<br />Query: <span class='error'>" . $sqlQuery . '</span>';
        if (!$results) {
            echo $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            echo 'CPT Posts completed. Counted ' . $thecount . ' records.';
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
            echo '<hr />';
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
        $error = "<hr /><b>Error on GET_MLS_CREDS</b>.\n<br />Query: <span class='error'>" . $sqlQuery . '</span>';
        if (!$results) {
            echo $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            echo 'MLS Creds completed. Counted ' . $thecount . ' records.';
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
            echo '<hr />';
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
        $error = "<hr /><b>Error on GET_GLOBAL_FIELDS</b>.\n<br />Query: <span class='error'>" . $sqlQuery . '</span>';
        if (!$results) {
            echo $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            echo 'Global Fields completed. Counted ' . $thecount . ' records.';
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
            echo '<hr />';
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
        $error = "<hr /><b>Error on GET_ACTIVE_PLUGINS</b>.\n<br />Query: <span class='error'>" . $sqlQuery . '</span>';
        if (!$results) {
            echo $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            echo 'Active Plugins completed. Counted ' . $thecount . ' records.';
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
            echo '<hr />';
        }
    }


    function get_search_homes_page() {
        $search_page = $this->find_search_homes_template();
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_posts' : 'wp_'.$site_id.'_posts';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_posts';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT * FROM {$table} WHERE ID ='{$search_page}'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = "<hr /><b>Error on GET_SEARCH_HOMES_PAGE</b>.\n<br />Query: <span class='error'>" . $sqlQuery . '</span>';
        if (!$results) {
            echo $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            echo 'Search Homes page found. Post ID: ' . $search_page . '.';
            #################################
            # INJECTION PROCESSING
            #################################
            foreach($results_array as $row) {
                unset($row['ID']);
                $column_names = implode(", ",array_keys($row));
                $prepared_values = array();
                foreach($row as $name => $value) {
                    $value = mysqli_real_escape_string($localConnection, $value);
                    $prepared_values[] = '\''.$value.'\'';
                }
                $column_values  = implode(", ", $prepared_values);
                $last_id = $this->injection($dest_table, $column_names, $column_values, 'last_id');
                $dest_table = 'wp_'.$dest_id.'_postmeta';
                $this->update_search_template($dest_table, $last_id);
            }
            echo '<hr />';
        }
    }

    function find_search_homes_template() {
        $site_id = $this->new_site_params['origin_site_id'];
        $table = ($site_id == '1') ? 'wp_postmeta' : 'wp_'.$site_id.'_postmeta';
        $dest_id = $this->new_site_id;
        $dest_table = 'wp_'.$dest_id.'_postmeta';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT post_id FROM {$table} WHERE (meta_key ='_wp_page_template' AND meta_value = 'template-search-homes.php')";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = "<hr /><b>Error on FIND_SEARCH_HOMES_TEMPLATE</b>.\n<br />Query: <span class='error'>" . $sqlQuery . '</span>';
        if (!$results) {
            echo $error;
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
        var_dump($sqlQuery);
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = "<hr /><b>Error on GET_THEME_SETTINGS</b>.\n<br />Query: <span class='error'>" . $sqlQuery . '</span>';
        if (!$results) {
            echo $error;
        } else {
            $results_array = $this->process_results($results);
            mysqli_free_result($results);
            $thecount = count($results_array);
            echo 'Theme Settings completed. Counted ' . $thecount . ' records.';
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
            echo '<hr />';
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
        $blog_id = wpmu_create_blog( $params['new_site_domain'], $params['new_site_path'], $params['new_site_title'], $params['new_site_admin'] , array( 'public' => 1 ));
        $this->new_site_id = $blog_id;
    }

    function injection($table, $column_names, $column_values, $last_id = '') {
        $localConnection = $this->DBConnect();
        $sqlQuery = "INSERT INTO {$table} ($column_names) VALUES ($column_values)";
        $results = mysqli_query($localConnection, $sqlQuery);
        $search_homes_id = mysqli_insert_id($localConnection);
        $error = '';
        if (!$results)
        {$error .= '<br />FAIL ON: <span class="highlight2">'.$sqlQuery.'</span>';
        } else {
            echo '<br /> <span class="highlight2"> INSERT SUCCESSFUL</span>';
            if($last_id == 'last_id') {
                return $search_homes_id;
            }
        }
        echo $error;
    }

    function update_plugins($table, $value) {
        $localConnection = $this->DBConnect();
        $sqlQuery = "UPDATE {$table} SET option_value = {$value} WHERE option_name = 'active_plugins'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = '';
        if (!$results)
        {$error .= '<br />FAIL ON: <span class="highlight2">'.$sqlQuery.'</span>';
        } else {
            echo '<br /> <span class="highlight2"> ACTIVE PLUGINS UPDATE SUCCESSFUL</span>';
        }
        echo $error;
    }

    function update_theme($table, $value, $part) {
        $localConnection = $this->DBConnect();
        $sqlQuery = "UPDATE {$table} SET option_value = {$value} WHERE option_name = '{$part}'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = '';
        if (!$results)
        {$error .= '<br />FAIL ON: <span class="highlight2">'.$sqlQuery.'</span>';
        } else {
            echo '<br /> <span class="highlight2"> THEME UPDATE ('.$part.') SUCCESSFUL</span>';
        }
        echo $error;
    }

    function update_search_template($table, $value) {
        $localConnection = $this->DBConnect();
        $search_homes_template = $this->new_site_params['search_homes_template'];
        $sqlQuery = "INSERT INTO {$table} (post_id, meta_key, meta_value) VALUES('{$value}', '_wp_page_template', '{$search_homes_template}')";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = '';
        if (!$results)
        {$error .= '<br />FAIL ON: <span class="highlight2">'.$sqlQuery.'</span>';
        } else {
            echo '<br /> <span class="highlight2"> INSERT SEARCH TEMPLATE SUCCESSFUL</span>';
        }
        echo $error;
    }
}
?>
<html>
<head>
    <style>
        .highlight {
            color: #ff00ff;
            font-style: italic;
        }
        .highlight2 {
            color: cyan;
            font-style: italic;
        }
        .highlight3 {
            color: yellow;
            font-style: italic;
        }
        .error {
            color: #ff0000;
            font-weight: bold;
        }
        body {
            margin: 0;
            padding: 0;
            background-color: #000;
        }
    </style>
    <title><?=$thetitle;?></title>
</head>
<body>
<h1>Version: <?=phpversion();?></h1>
<div id="devconsole" style="background-color:#000; color:#0F0; font-family:Arial, Helvetica, sans-serif; padding:10px; font-size:12px;">
    <strong>Find Tom Dodd</strong>
    <hr />
    <?php
    $execute = new admin_crawler();
    ?>
</div>
</body>
</html>