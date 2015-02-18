<?php # main html view banner, logo and login/register links, starts header ?>
<header>
	<?php
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    	<div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href=<?php echo '"'.$rootLoc.'"'; ?>><img src="images/Blinkblk.png" class="nav-logo img-responsive" /></a>
      	</div>
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
              <li><a id="nav-register" >REGISTER</a></li>
              <li><a href="#">STORE</a></li>
        </ul>
        </div>
    </nav>
</header>	
