<script>
function generateScatterPlot(){
	var $scatterPlotContainer = $('#scatterPlot');
	var RNA, CN;
	var RNAsamples = [];
	var COMMONsamples = [];
	var commonData = [];
	var RNAindex;
	var urlRNA, urlCN;
	var data = $.getValues("./getRNACNsymbol.php?q="+grace.id);
	urlRNA = "http://firebrowse.org/api/v1/Samples/mRNASeq?format=json&gene="+data['RNA']+"&cohort="+grace.cohort+"&sample_type=TP&protocol=RSEM&page_size=2000&sort_by=tcga_participant_barcode";
	urlCN = "http://firebrowse.org/api/v1/Analyses/CopyNumber/Genes/All?format=json&cohort="+grace.cohort+"&gene="+data['CN']+"&page_size=2000&sort_by=tcga_participant_barcode";

	$scatterPlotContainer.html('<img id="loading" src="./images/ajax-loader.GIF" alt="Loading" style="width:50px;height:50px;margin:100px;">');
	$scatterPlotContainer.show();
	$.when(
		$.ajax({
			   type: 'GET',
			   url: urlCN,
			   xhrFields: {
			      withCredentials: false
			   },
			   success: function(data) {
				   CN = data;
			   }
			}),
		$.ajax({
		   type: 'GET',
		   url: urlRNA,
		   xhrFields: {
		      withCredentials: false
		   },
		   success: function(data) {
			   RNA = data;
		   }
		})


	).then(function() {
	    if(RNA&&CN){
			console.log(RNA.mRNASeq[0]['expression_log2']);
			for(i=0;i<RNA.mRNASeq.length;i++){
				RNAsamples.push(RNA.mRNASeq[i]['tcga_participant_barcode']);
			}
			for(i=0;i<CN.All.length;i++){
				var CNsample = CN.All[i]['tcga_participant_barcode'];
				RNAindex = RNAsamples.indexOf(CNsample);
				if(RNAindex>=0){
					COMMONsamples.push(CNsample);
					commonData.push([CN.All[i]['all_copy_number'],Math.round(100*(Math.pow(2,RNA.mRNASeq[RNAindex]['expression_log2'])-1))/100]);
					}
			}
			$("#loading").fadeOut('slow', function()
		            {
		                // without this the DOM will contain multiple elements
		                // with the same ID, which is bad.
		                $(this).remove();
		            });
			$('#scatterPlot').highcharts({
		        chart: {
		            type: 'scatter',
		            zoomType: 'xy'
		        },
		        title: {
		            text: 'DNA Copy Number Versus RNA Expression of '+commonData.length+' '+grace.cohort+' tumor samples'
		        },
		        subtitle: {
		            text: 'Source: TCGA'
		        },
		        xAxis: {
		            title: {
		                enabled: true,
		                text: 'Relative Copy Number'
		            },
		            startOnTick: true,
		            endOnTick: true,
		            showLastLabel: true
		        },
		        yAxis: {
		            title: {
		                text: 'RNA-seq V2 RSEM gene normalized'
		            },
		            labels: {
			            formatter: function() {
			                return this.value.toExponential(0); // 2 digits of precision
			            }
		            }
		        },
		        legend: {
		            layout: 'vertical',
		            verticalAlign: 'top',
		            align: 'right',
		            floating: true,
		            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF',
		            borderWidth: 1,
	            	y:50
		        },
		        credits: {
		            enabled: false
		        },
		        exporting: { 
			        enabled: true 
			    },
		        plotOptions: {
		            scatter: {
		                marker: {
		                    radius: 5,
		                    states: {
		                        hover: {
		                            enabled: true,
		                            lineColor: 'rgb(100,100,100)'
		                        }
		                    }
		                },
		                states: {
		                    hover: {
		                        marker: {
		                            enabled: false
		                        }
		                    }
		                },
		                tooltip: {
		                    headerFormat: '<b>{series.name}</b><br>',
		                    pointFormat: '{point.x}, {point.y}'
		                }
		            }
		        },
		        series: [{
		            name: grace.gene,
		            color: 'rgba(229, 42, 111, .5)',
		            data: commonData
		        }]
		    }).fadeIn('slow');

	    }
	});
		
}
</script>