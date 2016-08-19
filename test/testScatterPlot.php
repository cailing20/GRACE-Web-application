<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
</head>
<select id="genes">
  <option value="ACSS2" selected="true">ACSS2</option>
  <option value="GCK">GCK</option>
  <option value="PGK2">PGK2</option>
  <option value="PGK1">PGK1</option>
  <option value="PDHB">PDHB</option>
  <option value="PDHA1">PDHA1</option>
  <option value="PDHA2">PDHA2</option>
  <option value="PGM2">PGM2</option>
  <option value="TPI1">TPI1</option>
  <option value="ACSS1">ACSS1</option>
</select>
<button onclick="generateScatterPlot()">Generate Scatter Plot</button>
<div id="scatterPlot" class="hide"></div>
<script>
function generateScatterPlot(){
	var urlRNA, urlCN;
	var RNAsamples = [];
	var COMMONsamples = [];
	var commonData = [];
	var RNAindex;
	var gene = $('#genes').val();
	urlRNA = "http://firebrowse.org/api/v1/Samples/mRNASeq?format=json&gene="+gene+"&cohort=BRCA&sample_type=TP&protocol=RSEM&page_size=2000&sort_by=tcga_participant_barcode";
	urlCN = "http://firebrowse.org/api/v1/Analyses/CopyNumber/Genes/All?format=json&cohort=BRCA&gene="+gene+"&page_size=2000&sort_by=tcga_participant_barcode";


	$.when(
			$.ajax({
			   type: 'GET',
			   url: urlRNA,
			   xhrFields: {
			      withCredentials: false
			   },
			   success: function(data) {
				   RNA = data;
				   console.log('RNA success');
			   }
			}),
			$.ajax({
				   type: 'GET',
				   url: urlCN,
				   xhrFields: {
				      withCredentials: false
				   },
				   success: function(data) {
					   CN = data;
					   console.log('CN success');
				   }
				})
		).then(function() {
		    if(RNA&&CN){
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
/* 				$("#loading").fadeOut('slow', function()
			            {
			                // without this the DOM will contain multiple elements
			                // with the same ID, which is bad.
			                $(this).remove();
			            }); */
				$('#scatterPlot').highcharts({
			        chart: {
			            type: 'scatter',
			            zoomType: 'xy'
			        },
			        title: {
			            text: 'DNA Copy Number Versus RNA Expression of '+commonData.length+' '+'BRCA'+' tumor samples'
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
			            name: gene,
			            color: 'rgba(229, 42, 111, .5)',
			            data: commonData
			        }]
			    }).fadeIn('slow');

		    }
		});
}
</script>
</html>