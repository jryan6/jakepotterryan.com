<?php # main html view banner, logo and login/register links, starts header ?>
	<header>
		<section id="topBar" class="topBar">
			<h1 id="logo"><img src=<?php echo '"'.$rootLoc.'/images/Blinkblk.png"'; ?> width="300" height="103"  alt="blink secure"/></h1>
			<!--<div id="loginform">-->
			<nav>
				<ul> <!-- all on the same line to avoid whitespace separators -->
					<li class="navButton"><a href=<?php echo '"'.$rootLoc.'/store"'; ?> >Store</a></li><li class="navButton"><a href=<?php echo '"'.$rootLoc.'/register"'; ?> >Register</a></li>
				</ul>
			</nav>
			<!--	<a href=<?php echo '"'.$rootLoc.'/members"'; ?> class="button">Login</a>
				<a href=<?php echo '"'.$rootLoc.'/register"'; ?> class="button">Register</a>-->
			<!--</div>-->
		</section>
	</header>	
