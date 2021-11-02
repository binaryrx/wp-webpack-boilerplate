<?php

require_once __DIR__ . '/inc/theme-setup.php';

/* ---------- helper functions ----------- */

function the_assets_image($name = "") {
    if($name) {
        echo get_template_directory_uri() . '/dist/images/' . $name;
    } else {
        echo "";
    }
}


function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}




/* ---------- wp filters ----------- */

function my_wp_nav_menu_objects( $items, $args ) {
	
	foreach( $items as &$item ) {
		
		$img_url = get_field('img_url', $item);
		
		if( $img_url ) {
			$title = $item->title;
			$item->title = "
				<img src='". $img_url ."'/>
				<span>". $title ."</span>
            ";
		}
		
	}
	// return
	return $items;
	
}
add_filter('wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2);

function my_wp_check_filetype_and_ext ($data, $file, $filename, $mimes) {
	$filetype = wp_check_filetype( $filename, $mimes );
	return [
		'ext'             => $filetype['ext'],
		'type'            => $filetype['type'],
		'proper_filename' => $data['proper_filename']
	];
	  
};

//allow svg files 
add_filter( 'wp_check_filetype_and_ext', 'my_wp_check_filetype_and_ext' , 10, 4 );

function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
//add svg mime
add_filter( 'upload_mimes', 'cc_mime_types' );








/* ---------- wp actions ---------- */


//remove extra tag added by acf wysiwug
function my_acf_add_local_field_groups() {
    remove_filter('acf_the_content', 'wpautop' );
}
add_action('acf/init', 'my_acf_add_local_field_groups');


function fix_svg() {
	echo '<style type="text/css">
		  .attachment-266x266, .thumbnail img {
			   width: 100% !important;
			   height: auto !important;
		  }
		  </style>';
}
//add snippet to admin head
add_action( 'admin_head', 'fix_svg' );






