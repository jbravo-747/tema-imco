var chart ={};
$(function(){
	// initialise tabs
	$('.chart_tab').click(function(){
		var ob= $(this);
		if(!ob.hasClass('active')){
			$('.chart_tab').removeClass('active');
			var chart_id = ob.attr('goto');
			if(chart_id && $('.chart_object[chart_id="'+chart_id+'"]')[0]){
			ob.addClass('active');
			to=500;
			 $('.chart_object:visible').stop().fadeOut(to);
			 if(!$('.chart_object:visible')[0]){
			 to=0;
			 }
			 setTimeout(function(){
			 $('.chart_object[chart_id="'+chart_id+'"]').stop().fadeIn();
			  var chart_div=  $('.chart_object[chart_id="'+chart_id+'"]').find('.chart');
				draw_chart(chart_id,chart_div);
			},to);
			}
			
		}
	});
	 setTimeout(function(){
	$('.chart_object').each(function(){
		var ob= $(this);
		var chart_div= ob.find('.chart');
		var chart_id = ob.attr('chart_id');
		draw_chart(chart_id,chart_div);
	});
	},400);
});
// Draw Chart
function draw_chart(chart_id,chart_div){
	if(chart_titles[chart_id] && chart_data[chart_id]){
		  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
  var prot_serie = {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            },
            
       };
      }else{
        var prot_serie = {
            borderWidth: 0,
              pointWidth: 40,
            dataLabels: {
                enabled: true,
                format: '{point.y:.1f}%'
            },
            
       };
      }
		chart[chart_id]=	chart_div.highcharts({

  chart: {
  	  height: 600,
        type: 'column'
    },
    title: {
        text: ''
    },
    subtitle: {
        text: ''
    },
    credits: {
                    enabled: false
               },
 		xAxis: {
        categories: chart_titles[chart_id],
        labels: {
            rotation:- 90
        }
    },
    yAxis: {
        title: {
            text: ''
        },
        labels: {
          enabled: false
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: prot_serie
    },

    tooltip: {
        enabled: false
    },

    series: [
    			{
    				data:chart_data[chart_id],
					color: {
      linearGradient: {
        x1: 0,
        x2: 0,
        y1: 0,
        y2: 1
      },
      stops: [
        ['70%', '#31bfd9'],
        [1, '#ffffff']
      ]
    }

    			}
    		]
	});
}
}
