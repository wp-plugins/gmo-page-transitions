<?php
/*
Plugin Name: GMO Page Transitions
Plugin URI: http://wpshop.com
Description: GMO Page Transitions adds Page Transitions actions to your site. 
Click on the link, and page will slide over to left or right. This effect will not apply when "target=_brank" is used.

Version: 1.1
Author: WP Shop byGMO
Author URI: http://wpshop.com
*/

function ido_scripts() {
	
	$idoval = get_option('ido_val');
	
	wp_enqueue_script('jquery');
	
	if($idoval == 1){
		wp_enqueue_script( 'ido_script_left', plugin_dir_url( __FILE__ ) .'script_left.js' );
	}
	if($idoval == 2){
		wp_enqueue_script( 'ido_script_right', plugin_dir_url( __FILE__ ) .'script_right.js' );
	}


}
add_action( 'wp_enqueue_scripts', 'ido_scripts' );
add_action( 'wp_enqueue_style', 'ido_scripts' );

add_action('admin_menu','ido_change');

function ido_change(){
	add_options_page(
		'GMO Page Transitions',
		'GMO Page Transitions',
		'administrator',
		'ido_change',
		'ido_set'
	);
}

function ido_set(){
	
	if(isset($_POST['houkou'])){
		update_option('ido_val',$_POST['houkou']);	
	} else {
		$hval = get_option('ido_val');
		if(!isset($hval)){
			update_option('ido_val','1');
		}
	}

	$idoval = get_option('ido_val');
	if($idoval == 1){
		$val1flag = ' selected';
	}
	if($idoval == 2){
		$val2flag = ' selected';
	}
	
    wp_enqueue_style('gmo-page-transitions-style',plugins_url('css/gmo-page-transitions.min.css', __FILE__));
	$plugin_file_url = plugins_url() . '/';
	$image_url1 = $plugin_file_url.'gmo-page-transitions/images/'.'wpshop_logo.png';
	$image_url2 = $plugin_file_url.'gmo-page-transitions/images/'.'wpshop_bnr_themes.png';
	$image_url3 = $plugin_file_url.'gmo-page-transitions/images/'.'wpshop_bnr_plugins.png';
	

	echo <<<EOD
	
	<div id="gmotransitions" class="wrap">
	<h2>GMO Page Trasitions</h2>
	<div id="gmoplugLeft">
	
	<h3>slide settings</h3>
	<form action="" method="post">
		<p>
			<select name="houkou">
EOD;
			echo '<option value="1"'.$val1flag.'>Slide to left</option>';
			echo '<option value="2"'.$val2flag.'>Slide to right</option>';
echo <<<EOD
			</select>
		</p>
		<p><input type="submit" value="Save Changes" class="button button-primary"></p>
	</form>
</div>
<!-- #gmoplugLeft -->
<div id="gmoplugRight">
<h3>WordPress Themes</h3>
<ul>
<li><a href="https://wordpress.org/themes/kotenhanagara" target="_blank">Kotehanagara</a></li>
<li><a href="https://wordpress.org/themes/madeini" target="_blank">Madeini</a></li>
<li><a href="https://wordpress.org/themes/azabu-juban" target="_blank">Azabu Juban</a></li>
<li><a href="http://wordpress.org/themes/de-naani" target="_blank">de naani</a></li>
</ul>
<a href="http://wpshop.com/themes?=vn_wps_pagetrasitions" target="_blank"><img src="{$image_url2}" alt="WPShop by GMO WordPress Themes for Everyone!"></a>
<ul><li class="bnrlink"><a href="http://wpshop.com/themes?=wps_pagetrasitions" target="_blank">Visit WP Shop Themes</a></li></ul>
<h3>WordPress Plugins</h3>
<ul>
<li><a href="http://wordpress.org/plugins/gmo-showtime/" target="_blank">GMO Showtime</a></li>
<li><a href="http://wordpress.org/plugins/gmo-font-agent/" target="_blank">GMO Font Agent</a></li>
<li><a href="http://wordpress.org/plugins/gmo-share-connection/" target="_blank">GMO Share Connection</a></li>
<li><a href="http://wordpress.org/plugins/gmo-ads-master/" target="_blank">GMO Ads Master</a></li>
<li><a href="http://wordpress.org/plugins/gmo-page-transitions/" target="_blank">GMO Page Trasitions</a></li>
<li><a href="http://wordpress.org/plugins/gmo-go-to-top/" target="_blank">GMO Go to Top</a></li>
</ul>
<a href="http://wpshop.com/plugins?=vn_wps_pagetrasitions" target="_blank"><img src="{$image_url3}" alt="WPShop by GMO WordPress Plugins for Everyone!"></a>
<ul><li class="bnrlink"><a href="http://wpshop.com/plugins?=wps_pagetrasitions" target="_blank">Visit WP Shop Plugins</a></li></ul>
<h3>Contact Us</h3>
<a href="http://support.wpshop.com/?page_id=15" target="_blank"><img src="{$image_url1}" alt="WPShop by GMO"></a>
</div><!-- #gmoplugRight -->
</div>
<!-- #gmotransitions -->
EOD;
}