/*

Fumodal is a jQuery plugin for creating modal dialog windows

Copyright (c) 2008-2009
Version: 0.88
Author: Daniel Fudala
Email: contact@fudini.net
Plugin Url: fudini.net/fumodal
Licence: GPL 

to-do:

- escape button
- loading animation
- busy text
- the actual content div should not have padding.

change log:
14.07.2009
- now preventing double click (it won't try to open another fumodal window)

20.05.2009
- use fade:false to stop animations

17.05.2009
- now you can set the z-index of the modal window

20.05.2008 
- window content width
- setting content div



*/
(function($) {
	$.fumodal = function(settings) {
		var settings = $.extend({
			width:300,
			height:200,
			backgroundColor:'#f0f0f0',
			overlayColor:'#ffffff',
			overlayOpacity:0.8,
			url:'',
			data:{},
			callback:function(){},
			style:false,
			title:'',
			content:'',
			zIndex:1000,
			fade:true
		}, settings||{});
		
		
		if($('#fumodal').size() != 1) {
			var ie6 = ($.browser.msie && parseInt($.browser.version) < 7);
			if(settings.style) {
				$('body').append('<div id="fumodal_background"></div><div id="fumodal"><div id="fumodal_window_container"><div id="fumodal_window_top"><div id="fumodal_window_TL"></div><div id="fumodal_window_TR"></div></div><div id="fumodal_window_middle"><div id="fumodal_window_L"></div><div id="fumodal_window_inner"><div id="fumodal_window_top_bar"><div id="fumodal_window_title">Title</div><div id="fumodal_window_close"></div></div><div id="fumodal_window_busy_back"></div><div id="fumodal_window_busy"><div id="fumodal_window_busy_icon"></div></div><div id="fumodal_window_content"><div id="fumodal_content"></div></div></div><div id="fumodal_window_R"></div></div><div id="fumodal_window_bottom"><div id="fumodal_window_BL"></div><div id="fumodal_window_BR"></div></div></div></div>');
			} else {
				$('body').append('<div id="fumodal_background"></div><div id="fumodal"><div id="fumodal_content"></div></div>');
			}
			$('#fumodal').hide();
			$('#fumodal_background').hide();
			if(ie6) {
				$('#fumodal_background').css({	width:'100%',
											 	height:'100%',
											 	backgroundColor:settings.overlayColor,
												position:'absolute',
												opacity:settings.overlayOpacity,
												top:'0',
												left:'0',
												display:'block',
												zIndex:settings.zIndex
											});
				$('#fumodal').css({width:settings.width,
									height:settings.height,
									top:'50%',
									left:'50%',
									display:'block',
									backgroundColor:settings.backgroundColor,
									zIndex:settings.zIndex + 1,
									position:'absolute'});
				position_fumodal();
				$(window).scroll(function(){
						position_fumodal();
				});
				$(window).resize(function(){
						position_fumodal();
				});
			} else {
				$('#fumodal_background').css({width:'100%',
											height:'100%',
											backgroundColor:settings.overlayColor,
											opacity:settings.overlayOpacity,
											position:'fixed',
											top:'0',
											left:'0',
											zIndex:settings.zIndex
											});
			
				$('#fumodal').css({width:settings.width,
									height:settings.height,
									marginLeft:-settings.width/2,
									marginTop:-settings.height/2,
									display:'block',
									backgroundColor:settings.backgroundColor,
									top:'50%',
									left:'50%',
									position:'fixed',
									zIndex:settings.zIndex + 1
									});
			}
			if(settings.style) {
				$('#fumodal_window_containter').css({width:settings.width,height:settings.height});
				$('#fumodal_window_inner').css({width:(settings.width-10)});
				$('#fumodal_window_busy_back').css({width:(settings.width-10),
											height:(settings.height-40),
											opacity:.7,
											display:'none'
											});
				$('#fumodal_window_busy').css({width:(settings.width-10),
											height:(settings.height-40),
											display:'none'
											});
				$('#fumodal_window_content').css({width:(settings.width-30)});
				$('#fumodal_window_top_bar').css({width:(settings.width-10)});
				$('#fumodal_window_title').css({width:(settings.width-60)});
				$('#fumodal_window_inner').css({width:(settings.width-10)});
				$('#fumodal_window_middle').css({height:(settings.height-10)});
				$('#fumodal_window_close').hover(function(event) {
												//roll over
												$(this).css({backgroundPosition:'-30px',
															cursor:'pointer'});
												},function(event) {
												//roll out
												$(this).css({backgroundPosition:'0px'});
												});
				$('#fumodal_window_close').click(function() {
					$.fumodal_close();
					return false;
				});
				$('#fumodal_window_title').html(settings.title);
			};
		
			$('#fumodal').hide();
			$('#fumodal_background').hide();
		
			if(settings.url=='') {
				if(settings.content!='') {
					$('#fumodal_content').html(settings.content);
					show_fumodal();						   
				
				} else {
					show_fumodal();
				}
			} else {
				$('#fumodal_content').load(settings.url,settings.data,function(result){
					settings.callback(result);
					show_fumodal();						   
				});
			}
		}
		function show_fumodal() {
			if(settings.fade) {
				$('#fumodal').fadeIn();
				$('#fumodal_background').fadeIn();
			} else {
				$('#fumodal').show();
				$('#fumodal_background').show();
			}
		}
		//this is only for internet explorer 6
		function position_fumodal() {
			var scrollTop = $(window).scrollTop();
			var scrollLeft = $(window).scrollLeft();
			$('#fumodal').css({marginTop:-settings.height/2+scrollTop,marginLeft:-settings.width/2+scrollLeft});
			var windowWidth = $(window).width();
			var windowHeight = $(window).height();
			$('#fumodal_background').css({width:windowWidth+scrollLeft,height:windowHeight+scrollTop});
		}
		
		$.fumodal_content = function() {
			return $('#fumodal_content');
		}
		
		$.fumodal_close = function() {
			if(settings.fade) {
				$('#fumodal').fadeOut(500,function() {
					$('#fumodal').remove();
					$('#fumodal_background').remove();
				});
				$('#fumodal_background').fadeOut(500);
			} else {
				$('#fumodal').remove();
				$('#fumodal_background').remove();
			}
		}
		
		$.fumodal_busy = function(state) {
			if(state) {
				$('#fumodal_window_busy_back').css({display:'block'});
				$('#fumodal_window_busy').css({display:'block'});
			} else {
				$('#fumodal_window_busy_back').css({display:'none'});
				$('#fumodal_window_busy').css({display:'none'});
			}
		}
	}
}) (jQuery);