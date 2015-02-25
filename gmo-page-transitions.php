<?php
/*
Plugin Name: GMO Page Transitions
Plugin URI: https://www.wpcloud.jp/en/themes
Description: GMO Page Transitions adds Page Transitions actions to your site. 
Click on the link, and page will slide over to left or right. This effect will not apply when "target=_brank" is used.

Version: 1.2
Author: GMO WP Cloud
Author URI: https://wpcloud.jp/en/
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
	$image_url1 = $plugin_file_url.'gmo-page-transitions/images/'.'wpcloud_bnr_themes.png';
	$image_url2 = $plugin_file_url.'gmo-page-transitions/images/'.'wpcloud_bnr_plugins.png';
	$image_url3 = $plugin_file_url.'gmo-page-transitions/images/'.'wpcloud_logo.png';
	

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
<p class="title">Recommended</p>
<div>
<h3>WordPress Themes</h3>
<a href="https://www.wpcloud.jp/en/themes/?banner_id=plugins" target="_blank"><img src="{$image_url1}" alt="WordPress Themes for Everyone"></a>
<p>Browse our recommended theme collection on GMO WP Cloud website.</p>
<h3>WordPress Plugins</h3>
<a href="https://www.wpcloud.jp/en/themes/?banner_id=plugins#plugins" target="_blank"><img src="{$image_url2}" alt="WordPress Plugins for Everyone"></a>
<p>Browse our recommended plugin collection on GMO WP Cloud website.</p>
<h3>Who We Are</h3>
<a href="https://www.wpcloud.jp/en/?banner_id=plugins" target="_blank" class="logo"><img src="{$image_url3}" alt="WPCloud by GMO"></a>
</div>
</div><!-- #gmoplugRight -->
</div>
<!-- #gmotransitions -->
EOD;
}