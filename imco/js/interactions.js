var paginationD = 6;
function reorderdownloadlist(element){
	//primero animaremos hasta el top de la página
	$('html,body').animate({ scrollTop: 0 }, 'fast');
	lista = $('.documentscontainer ul.titles');
	lista.find('li').removeClass('on');
	element.addClass('on');
	index = element.index();
	$('.documentscontainer .docsection .docsindiv').removeClass('on');
	element2 = $('.documentscontainer .docsection .docsindiv').eq(index);
	aux2 = element2.clone();
	element2.remove();
	aux2.addClass('on');
	$('.documentscontainer .docsection').prepend(aux2);
	
	if(index > 0){
		aux = element.clone();
		element.remove();
		lista.prepend(aux);
		/*aux.find('a').click(function(e){
			e.preventDefault();
			element = $(this).parent();
			reorderdownloadlist(element);
		});*/
	}
}
function addremovelink(action,item){
	url = item.attr('name');
	target = item.parent().parent().parent().find('.files_to');
	if(action=='add'){
		links = [];
		if(target.val() == ''){
			links[0] = url;
			target.val(JSON.stringify(links));
		}else{
			links = $.parseJSON(target.val());
			if(!searchlink(links,url)){
				links.push(url);
				target.val(JSON.stringify(links));
			}
		}
	}else{
		if(target.val() != '' && target.val() != '[]'){
			links = $.parseJSON(target.val());
			if(searchlink(links,url)){
				links = $.grep(links,function(value){
					return value != url;
				});
				target.val(JSON.stringify(links));
			}
		}
	}
}
function searchlink(links,url){
	flag = false;
	$.each(links,function(index,value){
		if(value == url)
			flag = true;
	});
	return flag;
}
function chargeMorefiles(){
	console.log('page: ' + paginationD);
	$.get('/temasrssajax.php?page='+paginationD, function(data){
	  console.log(data);
	  if(data == false){
		flag = false;
		console.log('no data');
		$('#loadmore').text('No hay más documentos').delay(5000).css('display','none');
	  }else{
		  $.each(data,function(index,value){
			$('.documentscontainer ul.titles').append("<li><a href='#'>"+data[index].title+"</a></li>");
			toprint = "<div class='docsindiv'>	\
				<h4>"+data[index].cut_title+"<a href='#' class='downloadselected' >Descargar todos los archivos seleccionados</a></h4>\
				<input type='hidden' class='files_to' value=''>\
				<ul>";
			docs = data[index].docs;
			$.each(docs,function(index,value){
				toprint += "<li><a name='"+docs[index].url+"' href='#' class='checkbox' ></a><a href=''>" + docs[index].docname + "</a></li>";
				console.log(docs[index].url)
			});
			toprint +=  '</ul></div>';
			$('.documentscontainer .docsection').append(toprint);
			flag = true;
			
		  });
	  }
	  $('#loadmore').css('display','none');
	  paginationD = parseInt(paginationD) + 1;
	},'json').fail(function() { 
		flag = false;
		//console.log('no data error');
		$('#loadmore').css('display','none');
	});
}

var i = 0;
var flag = true;
$().ready(function(){
	$("#countryselect").mxnphpCustomSelect({id: 'country-select'});
	$("#indiceselect").mxnphpCustomSelect({id: 'indice-select'});
	//$('.tab-container .item h2').click(function(e){
	$(document).on( 'click', '.tab-container .item h2', function(e){
		e.preventDefault();
		if($('#indiceIndividual .tabs li').eq(2).hasClass('on')){
			item = $(this).parent();
			if(!item.hasClass('on')){
				$('.tab-container .item.on .item-expandable').slideToggle('fast');
				$('.tab-container .item').removeClass('on');
				item.addClass('on');
				$.each(item.find('.barras').find('li'),function(index,value){
					bar = $(value).find('a');
					bar.css('width', '23px');
				});
				item.find('.item-expandable').slideToggle('fast',function(){
					barchartanimate(item.find('.barras'));
				});
			}else{
				item.removeClass('on');
				item.find('.item-expandable').slideToggle('fast');
			}
		}
	});
	$('#indiceIndividual .tabs li a').click(function(e){
		e.preventDefault();
		window.location.hash = '';
		index = $(this).parent().index();
		$('#indiceIndividual .tabs li').removeClass('on');
		$(this).parent().addClass('on');
		$('#indicecontent .tab-container').hide();
		$('#indicecontent .tab-container').eq(index).show();
		//console.log(index);
		if($(this).parent().index() == 1){
			$.each($(".tab-container.mexico .barras li"),function(index,value){
				bar = $(value).find('a');
				bar.css('width', '23px');
			});
			barchartanimate($(".tab-container.mexico .barras"));
		}
			
	});
	$('#indicecontent .tab-container.indices .item .indices-table li .list-title').click(function(e){
		e.preventDefault();
		lista = $(this).parent().find('ul');
		if(lista.length){
			lista.slideToggle('fast');
		}
	});
	$(window).scroll(function(){
		if (($(window).innerHeight() + $(window).scrollTop()) >= $("#wrap").height() - 400 ){
			i++;
			if(i<10 && flag){
				$('#loadmore').css('display','block');
				chargeMorefiles();
				flag = false;
				console.log('chaaaarge');
				i = 0;
			}
				
		}
	});
	$('#loadmore').click(function(e){
		e.preventDefault();
		chargeMorefiles();
	});
	$(document).on( 'click', '.documentscontainer .docsection .docsindiv h4 .downloadselected', function(e){
		e.preventDefault();
		target = $(this).parent().parent().find('.files_to');
		if(target.val() != '' && target.val() != '[]'){
			location.href = "http://imco.org.mx/zipfiles.php?filesarray=" + target.val();
			//console.log("http://imcomx.local/zipfiles.php?filesarray=" + target.val());
		}else{
			alert('Selecciona antes los archivos');
		}
	});
	$(document).on( 'click', '.documentscontainer .docsection .docsindiv ul li .checkbox', function(e){
		e.preventDefault();
		if($(this).hasClass('on')){
			$(this).removeClass('on');
			addremovelink('remove',$(this));
		}else{
			$(this).addClass('on');
			addremovelink('add',$(this));
		}
	});
	$(document).on( 'click', '.documentscontainer ul.titles li a', function(e){
	//$('.documentscontainer ul.titles li a').click(function(e){
		e.preventDefault();
		element = $(this).parent();
		reorderdownloadlist(element);
	});
	$('#menu-header-menu li,#menu-header-menu-english li').prepend("<span class='backlabel'></span>");
	$('.custom_scroll').mCustomScrollbar({
		advanced:{
			updateOnContentResize: true
		},
		scrollInertia: 200
	});
	$('.categories .tab').click(function(e){
		e.preventDefault();
		if(!$(this).hasClass('on') && !$(this).hasClass('lonely')){
			$(this).parent().find('.on').removeClass('on');
			$(this).addClass('on');
		}
	});
	$('.window.home .categories .tab').click(function(e){
		e.preventDefault();
		index = $(this).index();
		console.log(index);
		$('.window.home .posts-feed ul').removeClass('on');
		$('.window.home .posts-feed ul').eq(index).addClass('on');
	});
	$('#header .block .search-link, #header .searchform .close').click(function(e){
		e.preventDefault();
		$('#header .top').slideToggle({duration:400,queue:false});
		//console.log('abrir/cerrar');
	});
	$('#header .menu li').hover(function(){
		if(!$(this).hasClass('current_page_item'))
			$(this).find('.backlabel').animate({height:'81px'},{duration:100,queue:false});
	},function(){
		if(!$(this).hasClass('current_page_item'))
			$(this).find('.backlabel').animate({height:'7px'},{duration:200,queue:true});
	});
	$('#content .lateral-menu li').hover(function(){
		offset = $(this).find('.text').width() + 90;
		//console.log('text width: ' + $(this).find('.text').width());
		$(this).find('.listscreen').animate({width: offset + 'px'},{duration:100,queue:false});
	},function(){
		$(this).find('.listscreen').animate({width:'70px'},{duration:200,queue:true});
	});
	$('.window .color-list ul li a').click(function(e){
		var section = $(this).attr('href').replace('#','');

		console.log(section);

		if (section!=='/staff' && section !== 'https://www.youtube.com/user/imcomexico' && section !== 'https://soundcloud.com/imcomx'){
			console.log(section);
			e.preventDefault();
			var index = $(this).parent().index();
			//console.log(section + ' -  ' + index);
			$(this).parent().parent().find('li.on').removeClass('on');
			$(this).parent().addClass('on');
			$('.window .column.center .title-subtitle .section').html('').html($(this).html());
			contents = $('.window .column.center').find('.custom_content');
			contents.removeClass('on');
			contents.eq(index).addClass('on');
			
			window.location.hash = section;

		}		
	});
	$('.window.home .posts-feed li').hover(function(){
		$(this).addClass('on');
		$(this).find('.back-label').animate({width:'426px'},{duration:100,queue:false});
	},function(){
		$(this).removeClass('on');
		$(this).find('.back-label').animate({width:'0'},{duration:200,queue:true});
	});
	$('#header .block .world-link').click(function(e){
		e.preventDefault();
		$('#header .mundo').slideToggle({duration:300,queue:false});
	});
		$('#header .top .searchform .input').focus(function(){
		$(this).animate({width:	'458px'},{duration:300,queue:false});
	}).focusout(function(){
		$(this).animate({width:	'190px'},{duration:200,queue:false});
	});
	setlinkslikebuttons();
	geturlhash();
	setTimeout(function(){
		changeHeight();
		setInterval(changeHeight,1000);
	}, 2000);

	/*var body_width = $('body').width();
	var aside_width = $('aside').width();
	var main_width =body_width-aside_width;
	console.log(main_width);
	$('.main').width(main_width);*/

	$('.lateral.customScroll').mCustomScrollbar({
		advanced:{
			updateOnContentResize: true
		},
		scrollInertia: 200
	});

	/*$('.cat-title h2').click(function()
	{
		var lista = $('ul.desplegable');
		console.log("Un hover");
		if($('ul.desplegable').css('display') == 'none')
			lista.css('display','block');
		else
			lista.css('display','none');		
	});

	if($('.cat-title h2').length > 0)
	{
		$('.main').css('margin-top','1.5em');
	}*/

});

function changeHeight(){
	if($('.column-left').height() > $('.column-right').height()){
		$('.column-right').css('height',($('.column-left').height())+'px');
	}
}


function geturlhash(){
	var item = $('.window .color-list ul li a[href="'+window.location.hash+'"]');
	//console.log(item);
	console.log(window.location.hash);
	if(item.size() > 0){
		var index = item.parent().index();
		//console.log(section + ' -  ' + index);
		item.parent().parent().find('li.on').removeClass('on');
		item.parent().addClass('on');
		$('.window .column.center .title-subtitle .section').html('').html(item.html());
		contents = $('.window .column.center').find('.custom_content');
		contents.removeClass('on');
		contents.eq(index).addClass('on');
	}
}
function setlinkslikebuttons(){
	$('.column.center .indice-content a[href],.column.center .propuesta-content a[href]').each(function(index){
		var content = $(this).html();
		if(content=='Ver micrositio' || content=='Descargar PDF completo' || content=='Descargar PDF')
			$(this).addClass('tab');
	});
	$('.column.center .propuesta-content a[href],.window.principal .posts-feed a[href]').each(function(index){
		var content = $(this).html();
		if(content=='Ver micrositio' || content=='Descargar PDF completo' || content=='Descargar PDF')
			$(this).addClass('tab');
	});
}
