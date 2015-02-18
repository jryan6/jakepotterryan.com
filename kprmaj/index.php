<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>KPR.com</title>
        <meta name="author" content="Jake P. Ryan, Jakepotterryan.com">
        <meta name="Keywords" content="Kim Ryan, project manager, blr,inc., Kim potter ryan">
        <meta name="description" content="Kim Ryan.com">
        <link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="style.css">
        <script src="http://code.jquery.com/jquery.js"></script>
        <script type="text/javascript" src="Bootstrap/js/bootstrap.min.js"></script>
    </head>
    
    <body>
        <a name="home"></a>
        <div class="content">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                <!--responsive nav-->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#">Kim Ryan</a>
                    </div>
                <!--end resp nav-->
               <div class="collapse navbar-collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active dropdown">
                            <a href="#home" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true"><span class="glyphicon glyphicon-align-justify">   </span><span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="#about">About Me</a>
                                </li>
                                <li>
                                    <a href="#about">Contact</a>
                                </li>
                                <li>
                                    <a href="#photos">Photos</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/navbar-collapse-->
            </div><!--/container-fluid-->
        </nav>
        <div id="top" class="container-fluid">
            <div class="jumbotron container-fluid">
                <h1>Welcome to <br /> KimRyan.com</h1>
                <p></p>
            </div>
        </div>
            
        <a name="about"></a>
        <div class="content2">
            <div class="container">
                <div class="about col-md-7">
                    <div class="page-header">
                    <h1>About Me.</h1><small><br />Hi, there!</small>
                    </div>
                    <p>I'm Kim Ryan, an IT Project Manager.</p>
                    <p>Find my LinkedIn <a href="www.linkedin.com/in/kimberlypotterryan/" target="_blank">here:</a></p>
                    <p>If you would like to contact me, feel free to use the form below.</p>
                    <p>Have a great day!</p>
                </div>
            </div>
        </div>
<a name="contact"></a>            
        <div class="contact">
            <div class="container">
                <div class="contact col-md-7">
                    <div class="page-header">
                        <h1>Contact Me.</h1>
                    </div>
                    <form action="http://jakepotterryan.com/kprmaj/index.php#contact" method="post">
                        <div class="form">
                            <input type='hidden' name='submitted' id='submitted' value='1'/>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                <input name="name" type="text" class="form-control" placeholder="Your Name">
                            </div>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-inbox"></span></span>
                                <input name="email" type="text" class="form-control" placeholder="Your Email Address">
                            </div>
                            <div class="input-group input-group-lg">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                                <textarea name="body" type="text" class="form-control" placeholder="Your Message" style="height:200px;">
                            </div>
                            <input name="submit" type="submit" value="Submit" class="btn btn-default">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="footer">
            <div class="container">
                <div id="socials" >
                    <a href="www.linkedin.com/in/kimberlypotterryan/" target="_blank"><img src="images/LinkedIn.png" alt="
LinkedIn Profile" /></a>
                    <a href="mailto:kim@kimryan.com"><img src="images/Mail.png" alt="Shoot me an Email"/></a>
                </div>
                <p class="muted">&copy; Kimberly Ryan, <script type="text/javascript">
                    var theDate=new Date()
                    document.write(theDate.getFullYear())
                </script></p>
            </div>
        </div>
    </body>
</html>