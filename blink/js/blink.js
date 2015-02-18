//<!--

function formPageInit(){
  // Ensure we're working with a relatively standards compliant user agent
  if (!document.getElementById || !document.createElement || !document.createTextNode)
    return;


$(document).ready(function(){



	$(".navButton").click(function(){ // makes entire nav li into a clickable button
    	window.location=$(this).find("a").attr("href"); 
    	return false;
	});
}); // /ready

//-->
