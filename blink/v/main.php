<?php # main html view for initial landing page /blink ?>
<div class="main-wrapper">
    <div class="content-section clearfix" id="section1">
        <h3 class="center">THE CURRENT PASSWORD SYSTEM IS HOPELESSLY BROKEN.</h3>
    </br>
    </br>
    	<div class="content-left">
            <iframe width="420" height="315" src="//www.youtube-nocookie.com/embed/8f9BcZGu4d4?rel=0" frameborder="0"></iframe>
        </div>
        <div class="content-right">
        </br>
            <h4><span class="boldtxt">Frustrating</span> to remember.</h4> 
            <h4><span class="boldtxt">Tedious</span> to continuously enter.</h4>
            <h4><span class="boldtxt">Insecure</span> and stolen often.</h4>
            <h4 class="">Blink Secure replaces manual passwords with a wearable bluetooth device offering <span class="boldtxt">proximity-based</span>, dynamic authentication.</h4>
        </div>
    </div>
    <!--<div class="content-pad">
        <h3 class="">Blink Demonstration.</h3>
    </div>-->

    <div class="divider"><img src="images/divider.png" class="img-responsive" /></div>
    <div class="content-section clearfix" id="section2">
   		<div class="content-left">
        	<div class="inner-content-top clearfix">
            	<div class="inner-content-left">
                	<img src="images/step1.png" class="step-img" id="step1" />
                </div>
                <div class="inner-content-right">
                	<span class="glyphicon glyphicon-shopping-cart glyph-format"></span>
                </div>
            </div>
            <div class="inner-content-bottom">
            	<h3>Buy a bracelet.</h3>
                <h4>Available in our store.</h2>
                <button class="btn btn-lg btn-success" href="#" role="button">Buy</button>
            </div>
        </div>
        <div class="content-right">
            <img src="images/bracelets.jpg" id="bracelet-pic" class="img-responsive" alt="Bracelet!" />
        </div>
    </div>
    <div class="divider"><img src="images/divider.png" class="img-responsive" /></div>
    <div class="content-section clearfix" id="section3">
    	<div class="content-left">
			<img src="//www.ri.gov/img/iphone/appstore.png"  id="appstore-pic" class="img-responsive" />
        </div>
        <div class="content-right">
            <div class="inner-content-top clearfix">
            	<div class="inner-content-left">
                	<img src="images/step2.png" class="step-img" id="step2" />
                </div>
                <div class="inner-content-right">
                	<span class="glyphicon glyphicon-save glyph-format"></span>
                </div>
            </div>
            <div class="inner-content-bottom">
           		
                <h3 class="">Download the app.</h3>
                <h4>Available on the AppStore.</h4>
                <button class="btn btn-lg btn-success" href="#" role="button">Download</button>
            </div>
        </div>
    </div>
    <div class="divider"><img src="images/divider.png" class="img-responsive" /></div>
    <div class="content-section clearfix" id="section4">
    	<div class="content-left">
        	<div class="inner-content-top clearfix">
            	<div class="inner-content-left">
                	<img src="images/step3.png" class="step-img" id="step3" />
                </div>
                <div class="inner-content-right">
                	<span class="glyphicon glyphicon-ok glyph-format"></span>
                </div>
            </div>
            <div class="inner-content-bottom">
            	<h3 class="">Register your bracelet.</h3>
                <h4>Get Secured!</h4>
                
            </div>
        </div>
        <div class="content-right">
        	 <img src="images/devices.jpg" id="devices-pic" class="img-responsive" alt="Bracelet!" />
        </div>
    </div>
    <div class="push">
	</div>
    <div id="register-overlay" class="no-select">
    	<div id="register-overlay-content">
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
	$('#nav-register').on('mousedown', function(){
		$('#register-overlay').fadeIn("fast");//addClass('active-overlay');
		$('#register-overlay-content').fadeIn("fast");//addClass('active-overlay');
		$('#register-overlay-content').load('/~cdavenp1/blink/v/register.php');
		
    });
	$('#register-overlay').on('click',function(e){
		if (e.target == this) {
			$('#register-overlay').fadeOut("fast");//addClass('active-overlay');
			$('#register-overlay-content').fadeOut("fast");//addClass('active-overlay');	
		}
    });

});
</script>

