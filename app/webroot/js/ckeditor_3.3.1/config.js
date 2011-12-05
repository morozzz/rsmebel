/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
    config.scayt_autoStartup = false;
    config.format_p = { element : 'div', attributes : { style : 'font-size:14px;' } };
    config.filebrowserImageBrowseUrl = config.baseHref+"images/browser";
    config.filebrowserImageUploadUrl = config.baseHref+"images/upload";

    config.contentsCss = 'p {margin: 0; padding: 0; font-size:14px;} div {margin: 0; padding: 0; font-size:14px;}';
    config.enterMode = CKEDITOR.ENTER_DIV;
    config.forceEnterMode = true;
//    config.format_den = { element : 'div', attributes : { style : 'font-size:24px;' } };
//    config.format_tags = 'den;p;h1;h2;h3;h4;h5;h6;pre;address;div';
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    var toolbar = CKEDITOR.config.toolbar_Full;
    toolbar.push(['BtnFastNote']);
    config.toolbar = toolbar;

    config.baseFloatZIndex = 9100;
};
