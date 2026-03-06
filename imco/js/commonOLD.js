var $ = jQuery.noConflict();
var working = false;
var lastwidth, lastheight = 0;
var win_height = $.windowHeight();
var main_swiper = null;
$(function() {
	//Add target _blank to external links
	$('a').each(function() {
   var a = new RegExp('/' + window.location.host + '/');
   if(this.href){
   if (!a.test(this.href)) {
      $(this).attr("target","_blank");
   }
   }
});
   // Text ellipsis
   $('.ellipsis').each(function(){
   	var lines = $(this).attr('lines');
   	if(!lines){
   		lines = 2;
   	}
   	 $(this).ellipsis(
    	{
    		  lines: parseInt(lines),
    		  responsive:true
    	 });
   });
   // Go to previews page 
   $('.btn_goback').click(function(){
   var referrer =  document.referrer;
    var loc = window.location;
	myurl = loc.hostname;
	var hostname = $('<a>').prop('href', referrer).prop('hostname');
    if(hostname != myurl || document.referrer==loc) {
       return true;
    }else{
	location.href = referrer;
    return false;
    }
   });
   
   	$('.hamburger').click(function() {
		var items = $('.mobile_menu,.menu_black_btn');
		if (!$('.mobile_menu').hasClass('open')) {
				items.addClass('open');
				$('body').addClass('open_menu');
		} else {
				items.removeClass('open');
				$('body').removeClass('open_menu');
		}
	});
// Close main banner
$('.close_main_banner').click(function(){
$('.main_banner_container_wrapper').animate({'opacity':0},200,function(){
$('.main_banner_container').slideUp('slow');
});
});
//Share buttons actions
$('.whatsapp_share_btn').click(function(){
	shareWhatsapp();
});
$('.facebook_share_btn').click(function(){
	shareFb();
});
$('.twitter_share_btn').click(function(){
	shareTw();
});
$('.twitter_module_container').click(function(){
shareTwModule($(this).attr('quote'));
});
// Newsletter ajax action
$('.newsletter_form').ajaxForm({
		context : this,
		beforeSubmit : function(arr, $form) {
			if (!working) {
				if (validateNewsletter($form)) {
					working = true;
					$('body').addClass('waiting');
					$form.find('input[type=submit]').prop('disabled', true);
					return true;
				}
			}
			return false;
		},
		success : function(html, status, xhr, myForm) {
					$(myForm).find('.newsletter_thanks_wrapper').fadeIn();
								
				$(myForm)[0].reset();
			$(myForm).find('input[type=submit]').prop('disabled', false);
		},
		complete : function(xhr) {
			working = false;
			$('body').removeClass('waiting');
			$('form').find('input[type=submit]').prop('disabled', false);
		}
	});

    fix_links();
    fix_all();
    set_orientation();
    $('body').addClass('loaded');
   
});
document.addEventListener("touchstart", function(){}, true);
// Actions on load
$(window).on('load', function() {
           
});
// Actions on scroll
$(window).scroll(function() {
    fix_all();
    fix_header();
});
// Actions on resize window
$(window).resize(function() {
    set_orientation();
    fix_all();
    fix_header();
});
// Keep ration on containers
$.fn.keepRatio = function(which, width, height, resize) {

    var $this = $(this);

    var w = width;
    var h = height;
    var ratio = w / h;
    switch (which) {
        case 'width':
            var nh = Math.round($this.width() / ratio);
            $this.css('height', nh + 'px');
            break;
        case 'height':
            var nw = Math.round($this.height() * ratio);
            $this.css('width', nw + 'px');
            break;
    }
    if (resize != false) {
        $(window).resize(function() {
            switch (which) {
                case 'width':
                    var nh = Math.round($this.width() / ratio);
                    $this.css('height', nh + 'px');
                    break;
                case 'height':
                    var nw = Math.round($this.height() * ratio);
                    $this.css('width', nw + 'px');
                    break;
            }

        });
    }

};
// Check if string is an email
function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
// If element is visible in viewport
function elementInViewport(el) {
    if ($(el)[0]) {
        var top = el.offsetTop;
        var left = el.offsetLeft;
        var width = el.offsetWidth;
        var height = el.offsetHeight;

        while (el.offsetParent) {
            el = el.offsetParent;
            top += el.offsetTop;
            left += el.offsetLeft;
        }

        return (
            top < (window.pageYOffset + window.innerHeight) &&
            left < (window.pageXOffset + window.innerWidth) &&
            (top + height) > window.pageYOffset &&
            (left + width) > window.pageXOffset
        );
    } else {
        return false;
    }
}
// select current link
function fix_links() {

    $('nav .main-nav li.active,.sub-menu ul li.active,.about_submenu nav ul li a.active,.children_menu ul li a.active').removeClass('active');
    $('nav .main-nav li a,.about_submenu nav ul li a,.children_menu ul li a').each(function() {
    	var ob = $(this);
        if (ob.attr('url')) {
            ob.attr('href', ob.attr('url'));
        }
        var url = ob.attr('href');
        ob.attr('url', url);
        if (url) {
        	if(url.indexOf('#')!==-1){
        		url = url.substr(0,url.indexOf('#'));
        	}
        	$('.associated_page').each(function(){
        		current_url = $(this).val() ?$(this).val() : window.location.href;
        		
            if ((url) == (current_url)) {
                ob.parent().addClass('active');
                if (ob.parent().attr('parent_id')) {
                    var parent_id =ob.parent().attr('parent_id');
                    $('nav .main-nav li[item_id="' + parent_id + '"]').addClass('active');
                }
            } else {
                ob.attr('href', $(this).attr('url'));
            }
        	});

        }
    });

}

function getPathFromUrl(url) {
    return url.split(/[?#]/)[0];
}
// Get value from query string by string
var getUrlParameter = function getUrlParameter(sParam, url) {
    if (!url) {
        var sPageURL = decodeURIComponent(window.location.search.substring(1));
    } else {
        var sPageURL = decodeURIComponent(url.split(/[?#]/)[1]);
    }
    var sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

// Event on mouse up
$(document).mouseup(function(e) {

    if ($('.main_menu.open')[0]) {
        var container = $(".main_menu .main_menu_wrapper,.menu_black_btn");
        var container_close_div = $('.menu_black_btn');
    }



    if (container) {
        if (!container.is(e.target) // if the target of the click isn't the container...
            &&
            container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            if (container_close_div) {
                container_close_div.click();
                $('body,html').removeClass('overflow_hidden');
            } else {
                container.hide();
            }
        }
    }
});

// Event on keybord key is press
$(document).keydown(function(e) {
    switch (e.which) {
        case 37:
            //left


            break;
           case 13:
           case 32:
         
            break;

        case 38:
            // up
           
            break;

        case 39:
            // right
          
            break;

        case 40:
         
            break;
        case 27:
           
            break;

        default:
            return;
            // exit this handler for other keys
    }
   
    // prevent the default action (scroll / move caret)
});

// Set orientation class
function set_orientation() {
    if (window.innerHeight > window.innerWidth) {
        $('body').addClass('portrait');
        win_height = $.windowHeight();
        $('body').removeClass('landscape');
    } else {
        $('body').removeClass('portrait');
        win_height = $.windowHeight();
        $('body').addClass('landscape');
    }
}
// Fix heights to avoid using vh
function fix_all() {
    if (lastheight != win_height) {
        var full_height_ob = '';
        // $(full_height_ob).css('height', win_height);
        
        var full_min_height_ob = 'html,body,.page_content_container';
        $(full_min_height_ob).css('min-height', win_height);

        var full_height_ob_no_header = '.about_container';
        $(full_height_ob_no_header).css('height', win_height - $('#masthead').outerHeight());
        var full_height_ob_no_header_no_footer = '.media_info_wrapper';
        lastheight = win_height;
    }
    	if($('.top_scroll_bar')[0]){
		var full_height = $(document).height() - $(window).height();
		var scrolltop = $(window).scrollTop();
		per = scrolltop*100/full_height;
		$('.top_scroll_bar_progress').css('width',per+'%');
	}
}

// Open Pop up
function PopupCenter(pageURL, title, w, h) {
	var left = (screen.width / 2) - (w / 2);
	var top = (screen.height / 2) - (h / 2);
	var targetWin = window.open(pageURL, '', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
}

// Action to share on Facebook
function shareFb() {
	title=$('#social_title').val();
	desc=$('#social_description').val();
	image=$('#social_image').val();
	url=$('#social_url').val();
	var dest = 'https://www.facebook.com/sharer/sharer.php?u=' + url;
	PopupCenter(dest, 'Compartir en Facebook', 650, 350);
}
// Action to share on Whatsapp
function shareWhatsapp() {
	title=$('#social_title').val();
	desc=$('#social_description').val();
	image=$('#social_image').val();
	url=$('#social_url').val();
	
	var dest = 'https://api.whatsapp.com/send?text='+encodeURIComponent(desc+' '+url);
	PopupCenter(dest, 'Compartir en Whatsapp', 650, 350);
}
// Action to share on Twitter
function shareTw() {
	title=$('#social_title').val();
	desc=$('#social_description').val();
	image=$('#social_image').val();
	url=$('#social_url').val();	
	textString=desc;
	if (textString.length > (276 - url.length)) {
		textString = textString.substring(0, ((276 - url.length)) - 1);
		textString += "... ";
	}

	var text = encodeURIComponent(textString)  + encodeURIComponent(url);
	var dest = 'http://twitter.com/intent/tweet?lang=es&text=' + text;
	PopupCenter(dest, 'Compartir en Twiiter', 650, 350);
}
// Action to share quote on Twitter
function shareTwModule(quote) {
	textString=quote;
	if (textString.length > 280) {
		textString = textString.substring(0, ((277)) - 1);
		textString += "...";
	}

	var text = encodeURIComponent(textString);
	var dest = 'http://twitter.com/intent/tweet?lang=es&text="' + text+'"';
	PopupCenter(dest, 'Compartir en Twiiter', 650, 350);
}
function fix_header() {

}
//validate newsletter form
function validateNewsletter($form){
	var email = $form.find('.newsletter_email');
	if($.trim(email.val())==''){
		email.parents('.newsletter_content_right_column_wrapper').addClass('empty_error');
	}else{
		email.parents('.newsletter_content_right_column_wrapper').removeClass('empty_error');
		if(IsEmail($.trim(email.val()))){
			email.parents('.newsletter_content_right_column_wrapper').removeClass('invalid_email');
		}else{
			email.parents('.newsletter_content_right_column_wrapper').addClass('invalid_email');
		}	
	}
	

	if($form.find('.empty_error')[0] || $form.find('.invalid_email')[0]){
		return false;
	}else{
		return true;
	}
}
