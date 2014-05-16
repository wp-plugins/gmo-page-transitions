<?php
/*
Plugin Name: GMO Page Transitions
Plugin URI: http://wpshop.com
Description: GMO Page Transitions adds Page Transitions actions to your site. 
Click on the link, and page will slide over to left or right. This effect will not apply when "target=_brank" is used.

Version: 1.0
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

	echo <<<EOD
<div>
	<h2>slide settings</h2>
	<form action="" method="post">
		<p>
			<select name="houkou">
EOD;
			echo '<option value="1"'.$val1flag.'>Slide to left</option>';
			echo '<option value="2"'.$val2flag.'>Slide to right</option>';
echo <<<EOD
			</select>
		</p>
		<p><input type="submit" value="Save Changes"></p>
	</form>
</div>
EOD;
}