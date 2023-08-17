<?php
/*

 * Plugin Name: My Plugin
 * Description: This is a test Plugin.
 * version: 1.0
 * Author: Vishal Patidar

*/

if(!defined('ABSPATH')){
    header("Location : /Custom_plugin");
die('');

}


// This function for activate the plugin and perform the task
function my_plugin_activation(){

    global $wpdb , $table_prefix;
    $Custom_emp = $table_prefix.'emp';

    $q = "CREATE TABLE IF NOT EXISTS `$Custom_emp` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `email` VARCHAR(50) NOT NULL , `status` BOOLEAN NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB";
   $wpdb->query($q);
   
//    $q =" INSERT INTO `$Custom_emp` (`name`, `email`, `status`) VALUES ('Vishal ', 'vijaypate@gmail.com', 1)";
//    $wpdb->query($q);


     $data = array(
        'name' => 'Akshay',
        'email' => 'akshay@gmail.com',
        'status' => 1
     );

    $wpdb->insert($Custom_emp, $data);


      
}

register_activation_hook(__FILE__ , 'my_plugin_activation');



// This function for deactivate the plugin and perform the task
function my_plugin_deactivation(){
   
    global $wpdb, $table_prefix;
    $Custom_emp = $table_prefix.'emp';

    // $q = "DROP TABLE `$Custom_emp`";
    // $wpdb->query($q);

    $q = "TRUNCATE `$Custom_emp` ";
    $wpdb->query($q);

        
 }
register_deactivation_hook(__FILE__, 'my_plugin_deactivation');


// This function for short code
function my_sc_fun($atts){

$atts = array_change_key_case($atts, CASE_LOWER);

$atts = shortcode_atts(array(
      'msg' => 'i am Good'
      
), $atts);

        include 'img_gallery.php';


    // return 'Result :'.$atts['msg'];
}

add_shortcode('my-sc', 'my_sc_fun');




// This fucntion add the js file in the bottom

function my_custom_scripts(){

    
$path = plugins_url('js/main.js', __FILE__);
$dep = array('jquery');
$ver = filemtime(plugin_dir_path(__FILE__).'js/main.js');
wp_enqueue_script('my-custom-js', $path, $dep , $ver, true);


// this tag for  add the script inline tag in program
$is_login = is_user_logged_in() ? 1 : 0;
wp_add_inline_script('my-custom-js', 'var is_login = '.$is_login.';', 'before');


// this tag for add the style link in Top
$path_style = plugins_url('css/style.css', __FILE__);
$ver_style = filemtime(plugin_dir_path(__FILE__).'css/style.css');
wp_enqueue_style('my-custom-style', $path_style, '' , $ver_style);

}

add_action('wp_enqueue_scripts', 'my_custom_scripts');

