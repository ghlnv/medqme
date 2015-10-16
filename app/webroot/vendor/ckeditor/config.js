/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.language = 'pt-br';
	config.entities = false;
	config.htmlEncodeOutput = false;
	config.entities_greek = false;
	config.entities_latin = false;
	config.autoGrow_onStartup = true;
	config.autoGrow_maxHeight = 800;
	
	config.resize_enabled = false;
	
	config.scayt_autoStartup = true;
	config.scayt_sLang = 'pt_BR';
	
	config.enterMode = CKEDITOR.ENTER_BR;
	config.shiftEnterMode = CKEDITOR.ENTER_P;
	
	config.toolbar_Padrao =	[
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
		{ name: 'insert', items : [ 'Image','Table','HorizontalRule','SpecialChar','PageBreak' ] },
		{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
                '/',
		{ name: 'styles', items : [ 'Styles' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Subscript','Superscript','-','Outdent','Indent','-','Blockquote','-',
				'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
		{ name: 'tools', items : [ 'Maximize','-','About' ] }
	];
	config.toolbar_TextoBasico =	[
		{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','Subscript','Superscript','-','RemoveFormat' ] },
		{ name: 'paragraph', items : ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
	];
	config.toolbar_Medium =	[
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','RemoveFormat','-','Scayt' ] },
		{ name: 'paragraph', items : [ 
				'NumberedList','BulletedList','-','Subscript','Superscript','-','Outdent','Indent','-','Blockquote','-',
				'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock',
				'/'
		]},
		{ name: 'insert', items : [ 'Image','HorizontalRule','SpecialChar']},
		{ name: 'styles', items : [ 'Format','FontSize','Source' ] },
	];
};
