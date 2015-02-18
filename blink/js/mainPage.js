//<--


function formPageInit(){
  // Ensure we're working with a relatively standards compliant user agent
  if (!document.getElementById || !document.createElement || !document.createTextNode)
    return;
}


$(document).ready(function(){
	
	// $(".navButton").hover(
	// 	function(){
	// 		 $(this).css('box-shadow', '10px 10px 5px #888');
	// 	},
	// 	function(){
	// 		$(this).css('box-shadow', 'none');
	// 	}
	// );

	$(".navButton").click(function(){ // makes entire nav li into a clickable button
    	window.location=$(this).find("a").attr("href"); 
    	return false;
	});
}); // /ready

//-->
