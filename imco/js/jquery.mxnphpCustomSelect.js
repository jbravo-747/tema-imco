(function($){
	var methods = {
		//Main function switches out selects for custom-select and emulates behaivour
		init : function(options){
			var defaults = {
				id : "mxnphp-custom-select",
				callback : false
			}
			var options =  $.extend(defaults,options);
			return this.each(function(){		
				var select = $(this);
				var mainContainer = $("<div></div>").attr("id",options.id).append($("<div></div>").addClass("top"));
				var contentContainer = $("<div></div>").addClass("mxnphp-custom-select-content");
				var optionsContainer = $("<div></div>").addClass("options");
				var selectedOption = select.children("option:selected");
				var selected = $("<a></a>").attr("href","#").addClass('mxnphp-custom-select-selected').html(selectedOption.html());
				var button = $("<a></a>").attr("href","#").addClass('mxnphp-custom-select-button');
				selected = selected.appendTo(contentContainer);
				button = button.appendTo(contentContainer);
				select.children('option').each(function(){
					option = $("<a></a>").attr("href",$(this).val()).html($(this).html());
					optionsContainer.append(option);				
				});
				contentContainer.append(optionsContainer);
				mainContainer.addClass('custom-select-class');
				mainContainer.append(contentContainer);
				mainContainer.append($("<div></div>").addClass("bottom"));
				select.after(mainContainer);
				select.hide();
				
				//$("#"+options.id+" .mxnphp-custom-select-button, #"+options.id+" .mxnphp-custom-select-selected").live("click",function(e){
				$("#"+options.id+" .mxnphp-custom-select-button, #"+options.id+" .mxnphp-custom-select-selected").click(function(e){
					e.preventDefault();
					 mainContainer.toggleClass('on');
				});
				$("#"+options.id+" .options a").click(function(e){
					e.preventDefault();
					selected.html($(this).html());
					select.val($(this).attr('href'));
					select.trigger('change');
				});
				$(document).bind('click',function(e){
					var clicked = $(e.target).get(0);
					if(clicked != selected.get(0) && clicked != button.get(0)){
						 mainContainer.removeClass('on');
					}
				});
				
			});			
			
		}
	}
	//The standard jquery method calling logic
	$.fn.mxnphpCustomSelect = function(method){
		if ( methods[method] ) {
			return methods[ method ].apply( this, Array.prototype.slice.call(arguments,1));
		} else if ( typeof method === 'object' || ! method ) {
			return methods.init.apply( this, arguments );
		} else {
			$.error( 'Method ' +  method + ' does not exist on jQuery.mxnphpMulti' );
		} 
	}	
})(jQuery);	