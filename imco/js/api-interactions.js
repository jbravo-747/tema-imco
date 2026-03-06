var paiscambio = false;
var ft = true;
$().ready(function(){
	$(document).on( 'click', '.tab-container .item h2', function(e){
		e.preventDefault();
		window.location.hash = "pais_" + $(this).attr('id');
	});
	//seleccionando país
	$('#countryselect').change(function(){
		//console.log($(this).val());
		if( $('#comparador-pais').val() != $(this).val() ){
			$('#comparador-pais').val($(this).val());
			paiscambio = true;
		}else{
			paiscambio = false;
		}
	});
	//seleccionando índice
	$('#indiceselect').change(function(){
		//console.log($(this).val());
		if( $('#comparador-indice').val() != $(this).val() )
			$('#comparador-indice').val($(this).val());
	});
	$('#compare-button').click(function(e){
		e.preventDefault();
		if($('#comparador-indice').val() != '' && $('#comparador-pais').val() != ''){
			if(paiscambio || ft){ //cargar los datos
				getCountryToCompare($('#comparador-pais').val());
				getCIndiceToCompare($('#comparador-indice').val());
				ft = false;
			}else{ //mostrar el correcto
				getCIndiceToCompare($('#comparador-indice').val());
			}
		}
	});
	//cargando los resultados de México
	if($('#mexico-comparador').length){
		$.ajax({
			url: "http://api.imco.org.mx/imco-indice-internacional/web_service.php",
			crossDomain : true,
			dataType : 'jsonp',
			data : {
				accion 			: 'datos_indice_general_individual_x_anio',
				anio			: '2011',
				exportacion		: 'json',
				id_entidad 		: '10029'
			},
			success : function(data){
				if(data){
					printAllIndices(data,false,true);
				}else{
					console.log('NO DATA');
				}
			}
		});
	}
	if($('#indicecontent').length){ //datos_indice_general_todos_x_anio
		$.ajax({
			url: "http://api.imco.org.mx/imco-indice-internacional/web_service.php",
			crossDomain : true,
			dataType : 'jsonp',
			data : {
				accion 			: 'datos_indice_general_todos_x_anio',
				anio			: '2011',
				exportacion		: 'json'
			},
			success : function(data){
				if(data){
					printAllCountries(data);
					//printChartTable(data);
					type = $('.charttype li.on').index()==0?true:false;
					aplichart('freq1',false,type);
				}else{
					console.log('NO DATA');
				}
			}
		});
	}
	$(".charttype li a").click(function(e){
		e.preventDefault();
		$(".charttype li").removeClass('on');
		$(this).parent().addClass('on');
		index = $(".tab-container.general .indices-table li.on").index();
		type = $(this).parent().index()==0?true:false;
		aplichart(rankingdataset.rankingindexes[index].id,rankingdataset.rankingindexes[index].color,type);
	});
	$(".tab-container.general .indices-table li a").click(function(e){
		e.preventDefault();
		index = $(this).parent().index();
		$(".tab-container.general .indices-table li").removeClass('on');
		$(this).parent().addClass('on');
		//console.log(index);
		//console.log(rankingdataset.rankingindexes[index].id);
		type = $('.charttype li.on').index()==0?true:false;
		aplichart(rankingdataset.rankingindexes[index].id,rankingdataset.rankingindexes[index].color,type);
	});
});
function barchartanimate(barras){
	$.each(barras.find('li'),function(index,value){
		bar = $(value).find('a');
		bar.animate({width : bar.attr('name') + '%'},{queue:false,duration:200});
	});
}
function loadHashCountry(country){
	country = country.split('_');
	if(country && country[0] == '#pais'){
		$('#indiceIndividual .tabs li').eq(2).find('a').trigger('click');
		
		index = $('#' + country[1]).parent().index();
		//console.log(  $('#' + country[1])  );
		//console.log('hash: #' + country[1] + ' _ ' + index);
		$( '.tab-container.indices .item h2' ).eq(index).trigger('click');
		setTimeout(function () { $('html, body').animate({scrollTop: $("#" + country[1]).offset().top + - 200 }, 1000); }, 500);
	}else{
		//$( '.tab-container.indices .item h2' ).eq(0).trigger('click');
	}
}
function sortranking(a,b){
	if ( parseInt(a[1]) < parseInt(b[1]) ) return -1;
	if ( parseInt(a[1]) > parseInt(b[1]) ) return 1;
	return 0;
}
function printAllCountries(data){
	console.log('PAISES');
	console.log(data.resultados);
	var tosortgeneral = [];
	tosort = [];
	for(n in rankingdataset.rankingindexes){
		tosort[n] = [];
	}
	i = 0;
	for(x in data.resultados){
		pais = data.resultados[x].calificaciones['2011'].indice_competitividad_internacional;
		for(n in rankingdataset.rankingindexes){
			aux = [x,pais[rankingdataset.rankingindexes[n].handle]];
			tosort[n].push(aux);
		}
		i++;
	}
	for(n in rankingdataset.rankingindexes){
		tosort[n].sort(sortranking);
	}
	on = '';
	//style = 'style="display: block;"';
	style = '';
	i = 1;
	console.log('-----');
	for(x in data.resultados){
		x = tosort[0][i-1][0];
		pais = data.resultados[x].calificaciones['2011'].indice_competitividad_internacional;
		item = $("<div class='item'></div>");
		r_url = x;
		r_url = remove_accent(r_url.replace(new RegExp(' ','g'),'_').replace('.',''));
		//console.log('http://imco.org.mx/indices/#pais_' + r_url);
		item.append("<h2 id='"+r_url+"'><a class='ranking'>"+i+"</a>"+x+"</h2>");
		item.append("<div class='item-expandable' "+style+"><h3>Calificación</h3><ul class='indices-table table-complete'></ul></div><div class='clear'></div>");
		/*tr = $("<tr></tr>"); //for the table
		tr.append("<td class='dir'>"+x+"</td>");*/
		//rankingvalues
		barras = $("<ul class='barras'></ul>");
		for(y in rankingdataset.rankingindexes){
			r = pais[rankingdataset.rankingindexes[y].handle].replace('.000','');
			item.find('.indices-table').append("<li><a href='#' class='list-title'><span></span>"+rankingdataset.rankingindexes[y].label+"</a><a class='value'>"+r+"°</a></li>");
			if(rankingdataset.rankingindexes[y].handle == 'Ranking indice Internacional'){
				item.find('.ranking').html(r + '°');
				ranking = r;
			}
			barras.append("<li><a name='"+( Math.abs(parseInt(r) - 100) )+"'>"+r+"°</a></li>");
			
			xx = tosort[y][i-1][0];
			paisx = data.resultados[xx].calificaciones['2011'].indice_competitividad_internacional;
			rr = paisx[rankingdataset.rankingindexes[y].handle].replace('.000','');
			tr = $("<tr></tr>"); //for the table
			tr.append("<td class='dir'>"+xx+"</td>");
			tr.append("<td class='data'>"+( Math.abs(parseInt(rr) - 100) )+"</td>");
			$("#" + rankingdataset.rankingindexes[y].id ).append(tr);
		}
		//$("#freq").append(tr);
		social = $("<div class='social'></div>");
		
		social.append("<a href='https://twitter.com/share' class='twitter-share-button' data-url='"+countrieslinkshare[i-1]+"' data-text='"+x+" ocupa el lugar "+ranking+" de 46 países medidos en el Índice de Competitividad Internacional 2013 del @IMCOmx' data-lang='es'>Twittear</a> \
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>");
		item.find('.item-expandable').append(barras);
		item.find('.item-expandable').append("<div class='clear'></div>");
		$('#indicecontent .tab-container.indices').append(item);
		item.find('h2').append(social);
		on = '';
		style = '';
		i++;
	}
	loadHashCountry(window.location.hash);
}
function remove_accent(str) {
	var map={'À':'A','Á':'A','Â':'A','Ã':'A','Ä':'A','Å':'A','Æ':'AE','Ç':'C','È':'E','É':'E','Ê':'E','Ë':'E','Ì':'I','Í':'I','Î':'I','Ï':'I','Ð':'D','Ñ':'N','Ò':'O','Ó':'O','Ô':'O','Õ':'O','Ö':'O','Ø':'O','Ù':'U','Ú':'U','Û':'U','Ü':'U','Ý':'Y','ß':'s','à':'a','á':'a','â':'a','ã':'a','ä':'a','å':'a','æ':'ae','ç':'c','è':'e','é':'e','ê':'e','ë':'e','ì':'i','í':'i','î':'i','ï':'i','ñ':'n','ò':'o','ó':'o','ô':'o','õ':'o','ö':'o','ø':'o','ù':'u','ú':'u','û':'u','ü':'u','ý':'y','ÿ':'y','Ā':'A','ā':'a','Ă':'A','ă':'a','Ą':'A','ą':'a','Ć':'C','ć':'c','Ĉ':'C','ĉ':'c','Ċ':'C','ċ':'c','Č':'C','č':'c','Ď':'D','ď':'d','Đ':'D','đ':'d','Ē':'E','ē':'e','Ĕ':'E','ĕ':'e','Ė':'E','ė':'e','Ę':'E','ę':'e','Ě':'E','ě':'e','Ĝ':'G','ĝ':'g','Ğ':'G','ğ':'g','Ġ':'G','ġ':'g','Ģ':'G','ģ':'g','Ĥ':'H','ĥ':'h','Ħ':'H','ħ':'h','Ĩ':'I','ĩ':'i','Ī':'I','ī':'i','Ĭ':'I','ĭ':'i','Į':'I','į':'i','İ':'I','ı':'i','Ĳ':'IJ','ĳ':'ij','Ĵ':'J','ĵ':'j','Ķ':'K','ķ':'k','Ĺ':'L','ĺ':'l','Ļ':'L','ļ':'l','Ľ':'L','ľ':'l','Ŀ':'L','ŀ':'l','Ł':'L','ł':'l','Ń':'N','ń':'n','Ņ':'N','ņ':'n','Ň':'N','ň':'n','ŉ':'n','Ō':'O','ō':'o','Ŏ':'O','ŏ':'o','Ő':'O','ő':'o','Œ':'OE','œ':'oe','Ŕ':'R','ŕ':'r','Ŗ':'R','ŗ':'r','Ř':'R','ř':'r','Ś':'S','ś':'s','Ŝ':'S','ŝ':'s','Ş':'S','ş':'s','Š':'S','š':'s','Ţ':'T','ţ':'t','Ť':'T','ť':'t','Ŧ':'T','ŧ':'t','Ũ':'U','ũ':'u','Ū':'U','ū':'u','Ŭ':'U','ŭ':'u','Ů':'U','ů':'u','Ű':'U','ű':'u','Ų':'U','ų':'u','Ŵ':'W','ŵ':'w','Ŷ':'Y','ŷ':'y','Ÿ':'Y','Ź':'Z','ź':'z','Ż':'Z','ż':'z','Ž':'Z','ž':'z','ſ':'s','ƒ':'f','Ơ':'O','ơ':'o','Ư':'U','ư':'u','Ǎ':'A','ǎ':'a','Ǐ':'I','ǐ':'i','Ǒ':'O','ǒ':'o','Ǔ':'U','ǔ':'u','Ǖ':'U','ǖ':'u','Ǘ':'U','ǘ':'u','Ǚ':'U','ǚ':'u','Ǜ':'U','ǜ':'u','Ǻ':'A','ǻ':'a','Ǽ':'AE','ǽ':'ae','Ǿ':'O','ǿ':'o'};
	var res='';
	for (var i=0;i<str.length;i++){
		c=str.charAt(i);
		res+=map[c]||c;
	}
	return res;
}
function getCIndiceToCompare(indice){
	//console.log(indice);
	for(y in rankingdataset.rankingindexes){
		if(rankingdataset.rankingindexes[y].handle == indice){
			$('#mexico-comparador .mexico-indices .country-result,#mexico-comparador .paises-indices .country-result').removeClass('on');
			$('#mexico-comparador .mexico-indices .country-result.'+rankingdataset.rankingindexes[y].clase+',#mexico-comparador .paises-indices .country-result.' + rankingdataset.rankingindexes[y].clase).addClass('on');
		}
	}
};
function getCountryToCompare(country){
	//console.log('Enviando: ' + country );
	$.ajax({
		url: "http://api.imco.org.mx/imco-indice-internacional/web_service.php",
		crossDomain : true,
		dataType : 'jsonp',
		data : {
			accion 			: 'datos_indice_general_individual_x_anio',
			anio			: '2011',
			exportacion		: 'json',
			id_entidad 		: country
		},
		success : function(data){
			if(data){
				printAllIndices(data,true,false);
			}else{
				console.log('NO DATA');
			}
		}
	});
}
function printAllIndices(data,flagw,flagt){
	//console.log(data.resultados);
	i = 0;
	for(x in data.resultados){
		result = data.resultados[x].calificaciones['2011'].indice_competitividad_internacional;
		//console.log(result);
		where = flagw?'paises-indices':'mexico-indices';
		$('#mexico-comparador .' + where).html('');
		barras = $("<ul class='barras'></ul>");
		for(y in rankingdataset.rankingindexes){
			r = result[rankingdataset.rankingindexes[y].handle].replace('.000','');
			on = ($('#comparador-indice').val()!='' && rankingdataset.rankingindexes[y].handle == $('#comparador-indice').val())?'on':'';
			$('#mexico-comparador .' + where).append("<p id='mexico-value"+i+"' class='country-result "+on+" "+rankingdataset.rankingindexes[y].clase+"'><a class='country'>"+x+"</a><a class='value'>Posición | "+r+"°</a><div class='clear'></div></p>");
			i++;
			if(flagt){
				$('.indices-table.ranking-table').append("<li><a><span></span>"+rankingdataset.rankingindexes[y].label+"</a><a class='value'>"+r+"°</a></li>");
				barras.append("<li><a name='"+( Math.abs(parseInt(r) - 100) )+"'>"+r+"°</a></li>");
			}
				
		}
	}
	$(".indices-table.ranking-table").after(barras);
}
var rankingdataset = {
	rankingindexes : [
		{handle:'Ranking indice Internacional',					label:'General',					clase: 'general',	id:'freq1',	color:'#394052'},
		{handle:'Ranking Subindice Derecho',					label:'Derecho',					clase: 'derecho',	id:'freq2',	color:'#48A28F'},
		{handle:'Ranking Subindice Medio Ambiente',				label:'Medio Ambiente',				clase: 'medioa',	id:'freq3',	color:'#45A12C'},
		{handle:'Ranking Subindice Sociedad',					label:'Sociedad',					clase: 'sociedad',	id:'freq4',	color:'#2D9FF3'},
		{handle:'Ranking Subindice Economia',					label:'Economia',					clase: 'economia',	id:'freq5',	color:'#D25561'},
		{handle:'Ranking Subindice Politico',					label:'Sistema político',			clase: 'politico',	id:'freq6',	color:'#257BCB'},
		{handle:'Ranking Subindice Factores',					label:'Factores de producción',		clase: 'factores',	id:'freq7',	color:'#DAA800'},
		{handle:'Ranking Subindice Precursores',				label:'Precursores',				clase: 'precursores',id:'freq8',color:'#5F5F5F'},
		{handle:'Ranking Subindice Gobierno',					label:'Gobiernos',					clase: 'gobiernos',	id:'freq9',	color:'#773A7F'},
		{handle:'Ranking Subindice Relaciones Internacionales',	label:'Relaciones Internacionales',	clase: 'relaciones',id:'freq10',color:'#DD6A00'},
		{handle:'Ranking Subindice Innovacion',					label:'Innovación',					clase: 'innovacion',id:'freq11',color:'#8D2A11'},
	],
	rankingvalues : [
		{handle:'Datos indice Internacional',					label:'General',					clase: 'general'},
		{handle:'Datos Subindice Derecho',						label:'Derecho',					clase: 'derecho'},
		{handle:'Datos Subindice Medio Ambiente',				label:'Medio Ambiente',				clase: 'medioa'},
		{handle:'Datos Subindice Sociedad',						label:'Sociedad',					clase: 'sociedad'},
		{handle:'Datos Subindice Economia',						label:'Economia',					clase: 'economia'},
		{handle:'Datos Subindice Politico',						label:'Sistema político',			clase: 'politico'},
		{handle:'Datos Subindice Factores',						label:'Factores de producción',		clase: 'factores'},
		{handle:'Datos Subindice Precursores',					label:'Precursores',				clase: 'precursores'},
		{handle:'Datos Subindice Gobierno',						label:'Gobiernos',					clase: 'gobiernos'},
		{handle:'Datos Subindice Relaciones Internacionales',	label:'Relaciones Internacionales',	clase: 'relaciones'},
		{handle:'Datos Subindice Innovacion',					label:'Innovación',					clase: 'innovacion'},
	]
}
var countrieslinkshare = new Array();
countrieslinkshare[0] = 'http://bit.ly/12gEXYM';
countrieslinkshare[1] = 'http://bit.ly/12gEXrZ';
countrieslinkshare[2] = 'http://bit.ly/12gEXYO';
countrieslinkshare[3] = 'http://bit.ly/12gEXIh';
countrieslinkshare[4] = 'http://bit.ly/12gEXYQ';
countrieslinkshare[5] = 'http://bit.ly/12gEXIj';
countrieslinkshare[6] = 'http://bit.ly/12gEXYS';
countrieslinkshare[7] = 'http://bit.ly/12gEXYU';
countrieslinkshare[8] = 'http://bit.ly/12gEXYW';
countrieslinkshare[9] = 'http://bit.ly/12gEXIl';
countrieslinkshare[10] = 'http://bit.ly/12gEXIn';
countrieslinkshare[11] = 'http://bit.ly/12gEXIp';
countrieslinkshare[12] = 'http://bit.ly/12gEXZ0';
countrieslinkshare[13] = 'http://bit.ly/12gEXIr';
countrieslinkshare[14] = 'http://bit.ly/12gEXZ2';
countrieslinkshare[15] = 'http://bit.ly/12gEXIt';
countrieslinkshare[16] = 'http://bit.ly/12gEXIv';
countrieslinkshare[17] = 'http://bit.ly/12gEXIx';
countrieslinkshare[18] = 'http://bit.ly/12gF0DX';
countrieslinkshare[19] = 'http://bit.ly/12gEYfi';
countrieslinkshare[20] = 'http://bit.ly/12gEYfk';
countrieslinkshare[21] = 'http://bit.ly/12gF0E1';
countrieslinkshare[22] = 'http://bit.ly/12gEYfm';
countrieslinkshare[23] = 'http://bit.ly/12gEYfo';
countrieslinkshare[24] = 'http://bit.ly/12gF0E3';
countrieslinkshare[25] = 'http://bit.ly/12gF0E5';
countrieslinkshare[26] = 'http://bit.ly/12gF0E7';
countrieslinkshare[27] = 'http://bit.ly/12gF0E9';
countrieslinkshare[28] = 'http://bit.ly/12gEYfr';
countrieslinkshare[29] = 'http://bit.ly/12gEYft';
countrieslinkshare[30] = 'http://bit.ly/12gF0Eb';
countrieslinkshare[31] = 'http://bit.ly/12gF0Ed';
countrieslinkshare[32] = 'http://bit.ly/12gEYfv';
countrieslinkshare[33] = 'http://bit.ly/12gF0Ef';
countrieslinkshare[34] = 'http://bit.ly/12gEYfx';
countrieslinkshare[35] = 'http://bit.ly/12gEYfz';
countrieslinkshare[36] = 'http://bit.ly/12gEYfB';
countrieslinkshare[37] = 'http://bit.ly/12gF0Ut';
countrieslinkshare[38] = 'http://bit.ly/12gEYvR';
countrieslinkshare[39] = 'http://bit.ly/12gEYvT';
countrieslinkshare[40] = 'http://bit.ly/12gEYvX';
countrieslinkshare[41] = 'http://bit.ly/12gF0Uv';
countrieslinkshare[42] = 'http://bit.ly/12gEYvZ';
countrieslinkshare[43] = 'http://bit.ly/12gF0Ux';
countrieslinkshare[44] = 'http://bit.ly/12gEYw1';
countrieslinkshare[45] = 'http://bit.ly/12gEYw3';