$().ready(function(){
	Highcharts.theme = {
		colors: [
				 "#394052",  //general
				 "#48A28F", //derecho
				 "#45A12C", //medio ambiente
				 "#2D9FF3", //sociedad
				 "#D25561", //Macroeconomía
				 "#257BCB", //sistema político
				 "#DAA800", //factores de producción
				 "#5F5F5F", //infraestructura
				 "#773A7F", //gobiernos
				 "#DD6A00", //relaciones internacionales
				 "#8D2A11", //innovación
				 ],
	   chart: {
		  backgroundColor: 'transparent',
		  borderWidth: 0,
		  borderRadius: 15,
		  plotBackgroundColor: null,
		  plotShadow: false,
		  plotBorderWidth: 0
	   },
	   //nombres de los estados y la línea del círculo más grande
	   xAxis: {
			lineColor: '#999',
			labels: {
				 style: {
					color: 'white'
				 }
			  }
	   },
	   
   };
   
   //---------------------------------------------------------------------------------------------------------------------------------
   //---------------------------------------------------------------------------------------------------------------------------------
   //---------------------------------------------------------------------------------------------------------------------------------
   //---------------------------------------------------------------------------------------------------------------------------------
   //---------------------------------------------------------------------------------------------------------------------------------
   //---------------------------------------------------------------------------------------------------------------------------------
   //---------------------------------------------------------------------------------------------------------------------------------
   //---------------------------------------------------------------------------------------------------------------------------------
   //---------------------------------------------------------------------------------------------------------------------------------
   
   /**
 * Gray theme for Highcharts JS
 * @author Torstein Hønsi
 */

Highcharts.theme = {
   colors: [
				 "#394052",  //general
				 "#48A28F", //derecho
				 "#45A12C", //medio ambiente
				 "#2D9FF3", //sociedad
				 "#D25561", //Macroeconomía
				 "#257BCB", //sistema político
				 "#DAA800", //factores de producción
				 "#5F5F5F", //infraestructura
				 "#773A7F", //gobiernos
				 "#DD6A00", //relaciones internacionales
				 "#8D2A11", //innovación],//general
			],
   chart: {
      backgroundColor: 'transparent',
	  borderWidth: 0,
	  borderRadius: 15,
	  plotBackgroundColor: null,
	  plotShadow: false,
	  plotBorderWidth: 0
   },
   
   xAxis: {
      gridLineWidth: 0,
      lineColor: '#999',
      tickColor: '#999',
      labels: {
         style: {
            color: '#999',
            fontWeight: 'bold'
         }
      },
      title: {
         style: {
            color: '#AAA',
            font: 'bold 12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
         }
      }
   },
   yAxis: {
      alternateGridColor: null,
      minorTickInterval: null,
      gridLineColor: 'rgba(255, 255, 255, .1)',
      minorGridLineColor: 'rgba(255,255,255,0.07)',
      lineWidth: 0,
      tickWidth: 0,
      labels: {
         style: {
            color: '#999',
            fontWeight: 'bold'
         }
      },
      title: {
         style: {
            color: '#AAA',
            font: 'bold 12px Lucida Grande, Lucida Sans Unicode, Verdana, Arial, Helvetica, sans-serif'
         }
      }
   },
   legend: {
      itemStyle: {
         color: '#CCC'
      },
      itemHoverStyle: {
         color: '#FFF'
      },
      itemHiddenStyle: {
         color: '#333'
      }
   },
   labels: {
      style: {
         color: '#CCC'
      }
   },
   tooltip: {
      backgroundColor: {
         linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
         stops: [
            [0, 'rgba(96, 96, 96, .8)'],
            [1, 'rgba(16, 16, 16, .8)']
         ]
      },
      borderWidth: 0,
      style: {
         color: '#FFF'
      }
   },


   plotOptions: {
      series: {
         shadow: true
      },
      line: {
         dataLabels: {
            color: '#CCC'
         },
         marker: {
            lineColor: '#333'
         }
      },
      spline: {
         marker: {
            lineColor: '#333'
         }
      },
      scatter: {
         marker: {
            lineColor: '#333'
         }
      },
      candlestick: {
         lineColor: 'white'
      }
   },

   toolbar: {
      itemStyle: {
         color: '#CCC'
      }
   },

   navigation: {
      buttonOptions: {
         symbolStroke: '#DDDDDD',
         hoverSymbolStroke: '#FFFFFF',
         theme: {
            fill: {
               linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
               stops: [
                  [0.4, '#606060'],
                  [0.6, '#333333']
               ]
            },
            stroke: '#000000'
         }
      }
   },

   // scroll charts
   rangeSelector: {
      buttonTheme: {
         fill: {
            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
            stops: [
               [0.4, '#888'],
               [0.6, '#555']
            ]
         },
         stroke: '#000000',
         style: {
            color: '#CCC',
            fontWeight: 'bold'
         },
         states: {
            hover: {
               fill: {
                  linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                  stops: [
                     [0.4, '#BBB'],
                     [0.6, '#888']
                  ]
               },
               stroke: '#000000',
               style: {
                  color: 'white'
               }
            },
            select: {
               fill: {
                  linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                  stops: [
                     [0.1, '#000'],
                     [0.3, '#333']
                  ]
               },
               stroke: '#000000',
               style: {
                  color: 'yellow'
               }
            }
         }
      },
      inputStyle: {
         backgroundColor: '#333',
         color: 'silver'
      },
      labelStyle: {
         color: 'silver'
      }
   },

   navigator: {
      handles: {
         backgroundColor: '#666',
         borderColor: '#AAA'
      },
      outlineColor: '#CCC',
      maskFill: 'rgba(16, 16, 16, 0.5)',
      series: {
         color: '#7798BF',
         lineColor: '#A6C7ED'
      }
   },

   scrollbar: {
      barBackgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
            stops: [
               [0.4, '#888'],
               [0.6, '#555']
            ]
         },
      barBorderColor: '#CCC',
      buttonArrowColor: '#CCC',
      buttonBackgroundColor: {
            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
            stops: [
               [0.4, '#888'],
               [0.6, '#555']
            ]
         },
      buttonBorderColor: '#CCC',
      rifleColor: '#FFF',
      trackBackgroundColor: {
         linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
         stops: [
            [0, '#000'],
            [1, '#333']
         ]
      },
      trackBorderColor: '#666'
   },

   // special colors for some of the demo examples
   legendBackgroundColor: 'rgba(48, 48, 48, 0.8)',
   legendBackgroundColorSolid: 'rgb(70, 70, 70)',
   dataLabelsColor: '#444',
   textColor: '#E0E0E0',
   maskColor: 'rgba(255,255,255,0.3)'
};

	// Apply the theme
	var highchartsOptions = Highcharts.setOptions(Highcharts.theme);
	
});
function aplichart(tableID,color,type){
	if(color){
		Highcharts.theme.colors = [color];
		highchartsOptions = Highcharts.setOptions(Highcharts.theme);
	}
	$('#chartcontainer').highcharts({
    	data: {
	    	table: tableID,
	    	startRow: 1,
	    	endRow: 47,
	    	endColumn: 1
	    },
	    chart: {
	        polar: type, //true: polar, false: bar
	        type: type?'column':'bar'
	    },
	    title: false,
	    subtitle: false,
	    pane: {
	    	size: '85%'
	    },
	    legend: false,
	    xAxis: {
	    	tickmarkPlacement: 'on',
	    },
	    yAxis: {
	        endOnTick: false,
	        showLastLabel: true,
	        title: {
	        	text: ''
	        },
	        labels: {
	        	formatter: function () {
	        		//return this.value + '%';
	        		//return this.value;
	        	}
	        }
	    },
	    tooltip: {
	    	valueSuffix: '°',
	    	followPointer: true,
			formatter: function(){
				this.y = Math.abs(this.y - 100);
				return  this.x + ': ' + this.series.name  + ' :' + this.y + '°</tspan>';
			}
	    },
	    plotOptions: {
	        series: {
	        	stacking: 'normal',
	        	shadow: false,
	        	groupPadding: 0,
	        	pointPlacement: 'on'
	        }
	    }
	});
}
