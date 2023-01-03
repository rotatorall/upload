<?php
/*
=====================================================
 DataLife Engine - by SoftNews Media Group 
-----------------------------------------------------
 http://dle-news.ru/
-----------------------------------------------------
 Copyright (c) 2004-2022 SoftNews Media Group
=====================================================
 This code is protected by copyright
=====================================================
 File: newsletter.php
-----------------------------------------------------
 Use: WYSIWYG for newsletter
=====================================================
*/

if( !defined( 'DATALIFEENGINE' ) ) {
	header( "HTTP/1.1 403 Forbidden" );
	header ( 'Location: ../../' );
	die( "Hacking attempt!" );
}

if($config['bbimages_in_wysiwyg']) {
	$implugin = 'dleimage';
} else $implugin = 'image';

if( @file_exists( ROOT_DIR . '/templates/'. $config['skin'].'/editor.css' ) ) {
	
		$editor_css = "templates/{$config['skin']}/editor.css";
		
} else $editor_css = "engine/editor/css/content.css";

$version = substr(md5($config['version_id'].SECURE_AUTH_KEY),0,5);

echo <<<HTML
<script>
$(function(){

	tinyMCE.baseURL = 'engine/editor/jscripts/tiny_mce';
	tinyMCE.suffix = '.min';

	if(dle_theme === null) dle_theme = '';

	tinymce.init({
		selector: 'textarea.wysiwygeditor',
		language : "{$lang['wysiwyg_language']}",
		element_format : 'html',
		body_class: dle_theme,
		skin: dle_theme == 'dle_theme_dark' ? 'oxide-dark' : 'oxide',
		
		width : "100%",
		height : "400",

		deprecation_warnings: false,
		promotion: false,
		cache_suffix: '?v={$version}',

		plugins: "fullscreen advlist autolink lists link image charmap anchor searchreplace visualblocks visualchars nonbreaking table codemirror dlebutton codesample quickbars autosave wordcount pagebreak toc",

		relative_urls : false,
		convert_urls : false,
		remove_script_host : false,
		verify_html: false,
		nonbreaking_force_tab: true,
		branding: false,
		link_default_target: '_blank',
		browser_spellcheck: true,
		editable_class: 'contenteditable',
		noneditable_class: 'noncontenteditable',
		contextmenu: 'image table lists',
		
		paste_data_images: false,

		draggable_modal: true,
		menubar: 'edit insert format table view',
		toolbar: 'bold italic underline strikethrough | align | bullist numlist | link unlink | {$implugin} dleemo | fontformatting textformatting fullscreen code',
		toolbar_mode: 'floating',
		toolbar_groups: {
		  
			fontformatting: {
			  icon: 'change-case',
			  tooltip: 'Formatting',
			  items: 'forecolor backcolor | blocks fontfamily fontsize'
			},
			  
			textformatting: {
			  icon: 'edit-block',
			  tooltip: 'Tools',
			  items: 'searchreplace | dletypo removeformat'
			},
			
			align: {
			  icon: 'align-center',
			  tooltip: 'Formatting',
			  items: 'alignleft aligncenter alignright alignjustify'
			}
		  
		},
		
		menu: {
			view: { title: 'View', items: 'restoredraft | visualaid visualchars visualblocks | fullscreen' }
		},
		removed_menuitems: 'codeformat, bold, italic, underline, strikethrough',

		quickbars_insert_toolbar: '',
		quickbars_selection_toolbar: 'bold italic underline quicklink | forecolor backcolor blocks fontsize | dlequote dlespoiler dlehide',

		autosave_ask_before_unload: true,
		autosave_interval: '10s',
		autosave_prefix: 'dle-editor-{path}{query}-{id}-',
		autosave_restore_when_empty: false,
		autosave_retention: '10m',
  
		formats: {
		  bold: {inline: 'b'},  
		  italic: {inline: 'i'},
		  underline: {inline: 'u', exact : true},  
		  strikethrough: {inline: 's', exact : true}
		},
		
		dle_root : "",
		dle_upload_area : "",
		dle_upload_user : "",
		dle_upload_news : "",

		content_css : "{$editor_css}"

	});

});
</script>
    <div class="editor-panel"><textarea id="message" name="message" class="wysiwygeditor" style="width:100%;height:300px;"></textarea></div>
HTML;

?>