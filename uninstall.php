<?php

if(!defined('WP_UNINSTALL_PLUGIN')){
    header("Location : /Custom_plugin");
    die();
}


 global $wpdb, $table_prefix;

 $Custom_emp = $table_prefix.'emp';

 $q = "DROP TABLE `$Custom_emp`";

 $wpdb->query($q);




?>