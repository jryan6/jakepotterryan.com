<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width" />
<title>Native Supply Co.</title>
<meta name="Keywords" content="Native, Supply, lifestyle, apparel">
<meta name="description" content="Native Supply Co.">
<link href="Bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
<link href='http://fonts.googleapis.com/css?family=Lovers+Quarrel|Bad+Script|Dancing+Script|Norican' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light|Raleway|Indie+Flower' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js">
</script>
<script type="text/javascript" src="https://gist.githubusercontent.com/remy/2484402/raw/9e046d538ed42b87e5a5396e166c91083526958c/gistfile1.js"></script>
<script type="text/javascript" src="Bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</head>
    
<body class="body">
    <div id="page">
        <div class="jumbotron" role="banner">
            <div class="container">
                <h1 id="banner">Native Supply Co.</h1>
            </div>
        </div>
        
<!--main-links-->
        <div id="front-links" class="nav nav-tabs col-xs-12" role="tablist">
            <div id="container" class="col-xs-12 col-sm-9 col-md-5 col-xl-4">
            <li><a href="index.php" target= "_self" class="btn btn-default" role="button">Home</a></li>
            <li><a href="collections.html" target= "_self" class="btn btn-default" role="button">Collections</a></li>
            <li><a href="index.html#about" target= "_self" class="btn btn-default" role="button">About</a></li>
            <li><a href="store.html" target= "_self" class="btn btn-default" role="button">Shop</a></li>
            <li><a href="#news" target= "_self" class="btn btn-default" role="button">News</a></li>
            <li><a href="contact.php" target= "_self" class="active btn btn-default" role="button">Contact</a></li>
            </div>
        </div>
        
        <div class="jumbotron-contact jumbotron-sm">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <h1 class="h1">
                            Contact us <small>Inquiries about our company or products.</small></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="well well-sm">
                        <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter name" required="required" />
                                </div>
                                <div class="form-group">
                                    <label for="email">
                                        Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                        </span>
                                        <input type="email" class="form-control" id="email" placeholder="Enter email" required="required" /></div>
                                </div>
                                <div class="form-group">
                                    <label for="subject">
                                        Subject</label>
                                    <select id="subject" name="subject" class="form-control" required="required">
                                        <option value="na" selected="">Choose One:</option>
                                        <option value="service">General Customer Service</option>
                                        <option value="suggestions">Suggestions</option>
                                        <option value="product">Product Support</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">
                                        Message</label>
                                    <textarea name="message" id="message" class="form-control" rows="9" cols="25" required="required"
                                        placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                                    Send Message</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <form>
                    <legend><span class="glyphicon glyphicon-globe"></span> Our office</legend>
                    <address>
                        <strong>Native Supply Company</strong><br>
                        795 Church Street, Suite 600<br>
                        Burlington, VT 05401<br>
                        <abbr title="Phone">
                            P:</abbr>
                        (802) 456-7890
                    </address>
                    <address>
                        <strong>Joseph Gagliardo</strong><br>
                        <a href="mailto:#">Joe.Gags@example.com</a>
                    </address>
                    </form>
                </div>
            </div>
        </div>
<!--FOOTER-->
        <div id="footer" class="col-xs-12">
            <div id="foot-left" class="pull-left">
                <p>Website by<a href="http://jakepotterryan.com" target="_blank"> JR.Design</a></p>
            </div>
            <div id="foot-right" class="pull-right">
                <p>Copyright 2014 Native Supply Co.</p>
            </div>
        </div>
<!--END FOOTER-->
    </div>
</body>
</html>