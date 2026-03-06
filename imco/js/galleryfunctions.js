$().ready(function(e){
	$('.bottom-menu .views .arrow').click(function(e){
		e.preventDefault();
		if($(this).hasClass('ready')){
			orientacion = $(this).hasClass('left')?'left':'right';
			$('.bottom-menu .views .arrow').removeClass('ready');
			change_gallery_AP(
				orientacion,
				4,//limite para funcionar
				'.bottom-menu .views .screen .reel .item',//item a mover
				'.bottom-menu .views .screen .reel',//reel
				'.bottom-menu .views .arrow'//arrows
			);
		}
		
	});
	$('.apps-screen .arrow').click(function(e){
		e.preventDefault();
		if($(this).hasClass('ready')){
			console.log('entra');
			orientacion = $(this).hasClass('left')?'left':'right';
			$('.apps-screen .arrow').removeClass('ready');
			change_gallery_AP(
				orientacion,
				4,//limite para funcionar
				'.apps-screen .screen .reel .item',//item a mover
				'.apps-screen .screen .reel',//reel
				'.apps-screen .arrow'//arrows
			);
		}
	});
	$('.bottom-menu .banners .bullets a').addClass('ready');
	$('.bottom-menu .banners .bullets a').click(function(e){
		e.preventDefault();
		if($(this).hasClass('ready') && !$(this).hasClass('on')){
			index = $(this).index();
			$('.bottom-menu .banners .bullets a').removeClass('ready');
			actual = $('.bottom-menu .banners .bullets a.on').index();
			entrada = $('.bottom-menu .banners .screen .reel a').eq(index);
			salida  = $('.bottom-menu .banners .screen .reel a').eq(actual);
			orientacion = index>actual?'left':'right';
			$('.bottom-menu .views .arrow').removeClass('ready');
			moveGal(
				orientacion,
				'385',//width
				'.bottom-menu .banners .screen .reel',//item a mover
				'.bottom-menu .banners .bullets a',//bullet on
				entrada,salida,
				'',//arrow
				false //callback
			);
			$(this).addClass('on');
		}
		
	});
	var countB = $('.banners-main').length;
	$($('.banners-main')[0]).toggleClass('on');
	$('.banner a.right, .banner a.left').click(function(e){
		e.preventDefault();
		if($(this).hasClass('ready')){
			$('.banner a.arrow').removeClass('ready');
			actual = $('.banners-main.on').index();
			index = $(this).hasClass('right')?
					(countB-1>actual?actual+1:0):
					(actual>0?actual-1:countB-1);
			entrada = $('.banners-main').eq(index);
			salida  = $('.banners-main').eq(actual);
			orientacion = index>actual?'left':'right';
			if($(this).hasClass('right') && index==0)
				orientacion='left';
			else if($(this).hasClass('left') && actual==0)
				orientacion='right';
			moveGal(
				orientacion,
				'543',
				'.ban-ct',
				'.banner a.arrow',
				entrada,
				salida,
				'',
				false
			);
			$(this).addClass('on');
		}
	});

	/*var tmOut,tmBanersMain;
	$('.banner a.right, .banner a.left').hover(function(){
		clearInterval(tmBanersMain);//detiene el automatico
		clearTimeout(tmOut);//si hay otro hover no lo lanza
		tmOut = setTimeout(function(){//se alista para iniciar el automatico de nuevo.
			tmBanersMain=mvBanners();	
		},10500);*/

	galleryComplements('.banner a.right, .banner a.left','.banner a.right',countB,10500);


/* Banner Top */
	var countBTop = $('#content .container .top .reel .banner').length;
	$('.container .top .arrow.right,.container .top .arrow.left').click(function(e){
		e.preventDefault();
		if($(this).hasClass('ready')){
			$('.container .top .arrow').removeClass('ready');
			actual = $('#content .container .top .reel .banner.on').index();
			index = $(this).hasClass('right')?
					(countBTop-1>actual?actual+1:0):
					(actual>0?actual-1:countBTop-1);
			entrada = $('#content .container .top .reel .banner').eq(index);
			salida  = $('#content .container .top .reel .banner').eq(actual);
			orientacion = index>actual?'left':'right';
			if($(this).hasClass('right') && index==0)
				orientacion='left';
			else if($(this).hasClass('left') && actual==0)
				orientacion='right';
			moveGal(
				orientacion,
				'1201',
				'#content .container .top .reel',
				'.container .top .arrow',
				entrada,
				salida,
				'',
				false
			);
			$(this).addClass('on');
		}
	});

	galleryComplements('.container .top .arrow.right,.container .top .arrow.left','.container .top .arrow.right',countBTop,10000);

		
});

function mvBanners(arrow_right,time){
	return setInterval(function(){
		/*$('.banner a.right').trigger('click');},10500);*/
		$(arrow_right).trigger('click');
	},time);
}

function moveGal(direccion,width,reel,item_t,entrada,salida,arrows,callback){
	if(direccion=='left'){//  <--
		entrada.css('left',width+'px').addClass('on');
		$(reel).animate({left:'-'+width+'px'},{duration:900,complete:function(){
			$(item_t).addClass('ready');
			$(arrows).addClass('ready');
			entrada.css('left','0');
			$(reel).css('left','0');
			salida.removeClass('on');
			if(callback)
				callback();
		}});
	}else{//  -->
		entrada.addClass('on').css('left','-'+width+'px');
		$(reel).animate({left:width+'px'},{duration:900,complete:function(){
			$(item_t).addClass('ready');
			$(arrows).addClass('ready');
			entrada.css('left','0');
			$(reel).css('left','0');
			salida.removeClass('on');
			if(callback)
				callback();
		}});
	}
	$(item_t+'.on').removeClass('on');
}
function change_gallery_AP(orientation,limit,item_,target,arrow){
	var item = $(item_);
	var L = item.size();
	var size = item.width();
	if(L>limit){
		if(orientation=='left'){
			$(target).prepend($(item_ + ':last'));
			$(target).css('left','-'+size+'px');
			$(target).animate({left:'0'},300,function(){
				$(arrow).addClass('ready');
			});
		}else{
			$(target).animate({left:'-'+size+'px'},300,function(){
				$(target).append($(item_ + ':first'));
				$(target).css('left','0');
				$(arrow).addClass('ready');
			});
		}
	}
}

function galleryComplements(arrows,arrow_right,item_length,time)
{
	var tmOut,tmBanersMain;
	$(arrows).hover(function(){
		clearInterval(tmBanersMain);//detiene el automatico
		clearTimeout(tmOut);//si hay otro hover no lo lanza
		tmOut = setTimeout(function(){//se alista para iniciar el automatico de nuevo.
			tmBanersMain=mvBanners(arrow_right,time);	
		},10500);
	});
	
	if(item_length>1)
		tmBanersMain = mvBanners(arrow_right,time);
	else
		$(arrows).css('display','none');
}
