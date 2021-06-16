/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	/*
	Toolbar configuration
	 */
	config.toolbar = [
		{ name: 'styles', items: [ 'Font', 'FontSize', 'lineheight' ] },
		'/',
		{ name: 'paragraph', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
		{ name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
		{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
	];

	config.extraPlugins = 'font,copyformatting,lineheight';

	// Dialog windows are also simplified.
	config.removeDialogTabs = 'link:advanced';

	// Line height
	config.line_height="1em";

	// BG of the Editor
	config.uiColor = '#ffffff';

	// Font
	config.font_names =
		'Helvetica;'+
		'Courier New;'+
		'Times New Roman';

	//config.forcePasteAsPlainText = true;
	config.forcePasteDialog = true;
};

