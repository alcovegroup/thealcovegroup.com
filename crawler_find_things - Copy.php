<?php
global $wpdb;
$pattern_to_match = '~(field|type)="(.*?)"~';
$replacement_text = '$1=\'$2\'';
?>

<?php
class admin_crawler {

    function __construct() {
        echo '...:::INITIATED:::...<hr />';
        $this->get_blogs();
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


    function get_blogs() {
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT blog_id, domain FROM wp_blogs WHERE site_id = '1'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = "<hr /><b>Error on GET_BLOGS</b>.\n<br />Query: <span class='error'>" . $sqlQuery . '</span>';
        if (!$results) {
            echo $error;
        } else {
            $this->do_action($results);
            mysqli_free_result($results);
        }
    }

    function do_action($site_list) {
        //$list_results = mysqli_fetch_all($site_list, MYSQLI_ASSOC);
        //$list_results = $site_list->fetch_assoc();
        $list_results = array();
        $list_results[] = $site_list->fetch_array(MYSQLI_ASSOC);
        var_dump($list_results); echo '<hr />';
        foreach ($list_results as $row) {
            //if($row['blog_id'] == '81') {

                echo 'ID: [ <span class="highlight">' . $row['blog_id'] . '</span> ] ::::: SITE: [ <span class="highlight">' . $row['domain'] . '</span> ]';
                $this->find_shortcode($row['blog_id'], $row['domain']);

                echo '<hr />';
            //}
        }
    }

    function find_shortcode($blog_id, $domain) {
        $table = ($blog_id == '1') ? 'wp_posts' : 'wp_'.$blog_id.'_posts';
        $localConnection = $this->DBConnect();
        $sqlQuery = "SELECT ID, post_content FROM {$table} WHERE (post_type = 'press-releases')";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error ='';
        if (!$results) {
            $error .= '<br />FAIL ON: <span class="highlight2">'.$sqlQuery.'</span>';
        } else{
            //$list_results = mysqli_fetch_all($results, MYSQLI_ASSOC);
            $list_results = $site_list->fetch_assoc();
            if(!empty($list_results)) {
                echo ' ::::: Has Press releases?: [ <span class="highlight2"> YES </span> ] ::::: LINKS TO POSTS: [ ';
                $i = 0;
                foreach($list_results as $post_item) {
                    if($i >= 1) {
                        echo ' -- ';
                    }
                    echo '<a href="http://'.$domain.'/wp-admin/post.php?post='.$post_item['ID'].'&action=edit" class="highlight">'.$post_item['ID'].'</a>';
                    $new_content = preg_replace('~(.*)(Contacts<\/strong>)(.*)(Tom Dodd)(.*)(Corporate VP - Clinical Services)(.*)(https://yfcs.alertline.com)(.*)~s' , "$1$2$3Scott Schwieger$5Chief Compliance Officer$7https://acadia.alertline.com/gcs/welcome$9", $post_item['post_content']);
                    $i++;
                }
                echo ' ]';
                //$this->injection($blog_id, $post_item['ID'], $new_content);
            } else {
                echo ' ::::: Has Press releases?: [ <span class="error"> NO </span> ]';
            }
        }
        echo $error;
        mysqli_free_result($results);
    }

    function injection($blog_id, $post_id, $content) {
        $table = ($blog_id == '1') ? 'wp_posts' : 'wp_'.$blog_id.'_posts';
        $localConnection = $this->DBConnect();
        $content = mysqli_real_escape_string($localConnection, $content);
        $sqlQuery = "UPDATE {$table} SET post_content='{$content}' WHERE ID='{$post_id}'";
        $results = mysqli_query($localConnection, $sqlQuery);
        $error = '';
        if (!$results)
        {$error .= '<br />FAIL ON: <span class="highlight2">'.$sqlQuery.'</span>';
        } else {
            echo '<br /> <span class="highlight2"> UPDATE SUCCESSFUL</span>';
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
    <title>Find Tom Dodd</title>
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