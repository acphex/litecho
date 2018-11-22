<?php
function walkforest_setup() {
	
	// 添加RSS feed链接到head
	add_theme_support( 'automatic-feed-links' );

	// 页面标题
	add_theme_support( 'title-tag' );

	// 缩略图
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'walkforest-featured-image', 700, 700, true );

	add_image_size( 'walkforest-thumbnail-avatar', 50, 50, true );

	// 自定义菜单
	register_nav_menus( array(
		'top'    => 'Top Menu',
		'social' => 'Social Links Menu',
	) );

	// html5表单验证
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// 文章类型
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// 自定义logo
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// 所见即所得编辑器样式
	//add_editor_style( array( 'assets/css/editor-style.css', twentyseventeen_fonts_url() ) );

}
add_action( 'after_setup_theme', 'walkforest_setup' );

function walkforest_scripts() {

	// 主题样式
	wp_enqueue_style( 'walkforest-style', get_theme_file_uri( '/assets/css/style.css' ) );
	wp_enqueue_style( 'google-code-prettify-style', get_theme_file_uri( '/assets/plugins/google-code-prettify/prettify.css' ) );
	
	// Load the html5 shiv.
	//wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	//wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	//wp_enqueue_script( 'google-code-prettify', get_theme_file_uri( '/assets/plugins/code-prettify-master/loader/run_prettify.js?autoload=true&skin=walkforest' ), array(), '1.0', true );
	//google-code-prettify
	wp_enqueue_script( 'google-code-prettify', get_theme_file_uri( '/assets/plugins/google-code-prettify/prettify.js' ), array(), '1.0', true );
	wp_enqueue_script( 'clipboard', get_theme_file_uri( '/assets/js/clipboard.min.js' ), array(), '1.0', true );

	//wp_enqueue_script( 'twentyseventeen-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'walkforest_scripts' );
/*rename上传媒体名：转为16位MD5*/
function custom_upload_name( $file ){
    if ( !$ext )
    $ext = ltrim(strrchr($file['name'], '.'), '.');
	$md5names = $file['name'].time();
	$md5name = substr(md5($md5names),8,16);
    //$file['name'] = $md5name.time().'.'.$ext;
	$file['name'] = $md5name.'.'.$ext;
    return $file;
}
add_filter( 'wp_handle_upload_prefilter', 'custom_upload_name' );   

function spces_code_plugin() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }
 
   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'specs_mce_external_plugins_filter' );
      add_filter( 'mce_buttons', 'specs_mce_buttons_filter' );
   }
 
}
add_action('admin_head', 'spces_code_plugin');

function specs_mce_external_plugins_filter($plugin_array) {
    $plugin_array['specs_code_plugin'] = get_template_directory_uri() . '/assets/js/my_code_input/my_code_input.js';
        
    return $plugin_array;
}
function specs_mce_buttons_filter($buttons) {
    array_push($buttons, 'specs_code_plugin');
        
    return $buttons;
}

function walkforest_footer_scripts(){
	static $printed = false;

	if ( $printed ) {
		return;
	}

	$printed = true;
?>
<script type="text/javascript">

var clipboard = new ClipboardJS('.btn');

clipboard.on('success', function(e) {
	//console.log(e);
	//$('.btn').tooltip('show')
});
clipboard.on('error', function(e) {
	//console.log(e);
});
</script>
<?php
}
add_action( 'wp_footer', 'walkforest_footer_scripts',30);





/*function my_format_TinyMCE( $in ) {
	$in['remove_linebreaks'] = false;
	$in['gecko_spellcheck'] = false;
	$in['keep_styles'] = true;
	$in['accessibility_focus'] = true;
	$in['tabfocus_elements'] = 'major-publishing-actions';
	$in['media_strict'] = false;
	$in['paste_remove_styles'] = false;
	$in['paste_remove_spans'] = false;
	$in['paste_strip_class_attributes'] = 'none';
	$in['paste_text_use_dialog'] = true;
	$in['wpeditimage_disable_captions'] = true;
	$in['plugins'] = 'tabfocus,paste,media,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpemoji';
	$in['content_css'] = get_template_directory_uri() . "/editor-style.css";
	$in['wpautop'] = true;
	$in['apply_source_formatting'] = false;
    $in['block_formats'] = "Paragraph=p; Heading 3=h3; Heading 4=h4";
	$in['toolbar1'] = 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,wp_fullscreen,wp_adv ';
	$in['toolbar2'] = 'formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help,wpemoji ';
	$in['toolbar3'] = '';
	$in['toolbar4'] = '';
	return $in;
}
add_filter( 'tiny_mce_before_init', 'my_format_TinyMCE' );*/





