<?php

/*
* Add your own functions here. You can also copy some of the theme functions into this file. 
* Wordpress will use those functions instead of the original functions then.
*/

add_filter('avf_default_icons','avia_replace_standard_icon', 10, 1);

function avia_replace_standard_icon($icons)
{
$icons['standard']	 = array( 'font' =>'entypo-fontello', 'icon' => 'ue83f');
return $icons;
}

add_filter( 'avf_google_heading_font', 'avia_add_heading_font');
function avia_add_heading_font($fonts)
{
$fonts['Oxygen'] = 'Oxygen';
$fonts['Oxygen-Light'] = 'Oxygen-Light';
return $fonts;
}

if(!function_exists('avia_logo'))
{
/**
* return the logo of the theme. if a logo was uploaded and set at the backend options panel display it
* otherwise display the logo file linked in the css file for the .bg-logo class
* @return string the logo + url
*/
function avia_logo($use_image = "", $sub = "", $headline_type = "h1", $dimension = "")
{
$use_image = apply_filters('avf_logo', $use_image);
$headline_type = apply_filters('avf_logo_headline', $headline_type);
$sub = apply_filters('avf_logo_subtext', $sub);
$alt = apply_filters('avf_logo_alt', get_bloginfo('name')); 
$link = apply_filters('avf_logo_link', home_url('/'));

if($sub) $sub = "<span class='subtext'>$sub</span>";
if($dimension === true) $dimension = "height='100' width='300'"; //basically just for better page speed ranking :P

if($logo = avia_get_option('logo'))
{
$logo = apply_filters('avf_logo', $logo);
if(is_numeric($logo)){ $logo = wp_get_attachment_image_src($logo, 'full'); $logo = $logo[0]; }
$logo = "<img {$dimension} src='{$logo}' alt='{$alt}' usemap='#awp'/>";
$logo = "<$headline_type class='logo' style='left: 40%; padding-top: 30px;'><a href='".$link."'>".$logo."$sub</a></$headline_type>";
}
else
{
$logo = get_bloginfo('name');
if($use_image) $logo = "<img {$dimension} src='{$use_image}' alt='{$alt}' title='{$logo}'/>";
$logo = "<$headline_type class='logo bg-logo'><a href='".$link."'>".$logo."$sub</a></$headline_type>";
}

//echo $use_image . '<br>'. $logo;
$logo = apply_filters('avf_logo_final_output', $logo, $use_image, $headline_type, $sub, $alt, $link);

return $logo;

}
}


function add_tippy_theme_scripts() {
  wp_enqueue_style( 'tippy_css', get_stylesheet_directory_uri() . '/tippy/tippy.css', array(), '1.1', '');
 
  wp_enqueue_script( 'tippy_script', get_stylesheet_directory_uri() . '/tippy/tippy.js', array ( 'jquery' ), 1.1, true);
  wp_enqueue_script( 'tippy_script_custom', get_stylesheet_directory_uri() . '/tippy/custom.js', array ( 'jquery' ), 1.1, true);
}
add_action( 'wp_enqueue_scripts', 'add_tippy_theme_scripts' );