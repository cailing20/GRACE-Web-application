/**Adapted From : http://www.formget.com/multi-step-form-using-jquery-and-css3/
 * 
 */
$(document).ready(function() {
    $(".next_btn").click(function() { // Function Runs On NEXT Button Click
    	var valid = true;
    	valid = grace.validGene && valid;
        if(!valid){
            return;
        }
        $(this).parent().next().fadeIn('slow');
        $(this).parent().css({
            'display': 'none'
        });
        // Adding Class Active To Show Steps Forward;
        $('.MSFactive').nextAll('li').eq($('.MSFactive').length - 1).addClass('MSFactive');
    });
    $(".pre_btn").click(function() { // Function Runs On PREVIOUS Button Click
        $(this).parent().prev().fadeIn('slow');
        $(this).parent().css({
            'display': 'none'
        });
        // Removing Class Active To Show Steps Backward;
        $('.MSFactive:last').removeClass('MSFactive');
    });
    // Validating All Input And Textarea Fields
    $(".submit_btn").click(function(e) {
    	$(".MSF").hide();
    	if(grace.analysis==="Co-expression Analysis") $("#CoexpressionAnalysisResult").show();
    	if(grace.analysis==="RNA Copy Number Scatter Plot") $("#scatterPlot").show();
    });
});

