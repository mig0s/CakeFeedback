<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <link rel='stylesheet' href='css/style.css'>
    <link rel='stylesheet' href='css/bootstrap.css'>
    <title>The Cake Shop</title>
</head>
<body>
<div class='navbar-wrapper'>
<div class='container'>
<nav class='navbar navbar-default navbar-fixed-top'>
    <div class='container'>
    <div class='navbar-header'>
        <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
        <span class='sr-only'>Toggle navigation</span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
        <span class='icon-bar'></span>
        </button>
        <a class='navbar-brand' href='index.html'>The Cake Shop</a>
    </div>
    <div id='navbar' class='navbar-collapse collapse'>
        <ul class='nav navbar-nav'>
        <li><a href='index.html'>Home</a></li>
        <li><a href='about.html'>About</a></li>
        <li><a href='contact.html'>Contact</a></li>
        <li><a href='menu.html'>Our Menu</a></li>
        <li><a href='feedback.html'>Feedback</a></li>
        <li><a href='enquiry.html'>Enquiry</a></li>
        <li class='active'><a href='admin.php'>Admin</a></li>
        </ul>
        <ul class='nav navbar-nav navbar-right'>
        </ul>
    </div><!--/.nav-collapse -->
    </div>
</nav>
</div>
</div>
<div class='container'>

    <div class="page-header">
        <h1><br />Enquiry Admin</h1>
    </div>
<!-- login form box -->
<form method="post" action="admin.php" name="loginform" class="form-horizontal">
<div class="form-group">
    <label for="login_input_username" class="col-sm-2 control-label">Username</label><div class="col-sm-3">
    <input id="login_input_username" class="login_input form-control" type="text" name="user_name" required /></div>
</div>
<div class="form-group">
    <label for="login_input_password" class="col-sm-2 control-label">Password</label><div class="col-sm-3">
    <input id="login_input_password" class="login_input form-control" type="password" name="user_password" autocomplete="off" required /></div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <input type="submit"  name="login" value="Log in" class="btn btn-primary"/>
    </div>
</div>
</form>
    <footer>
    <p class='pull-right'><a href='#'>Back to top</a></p>
    <p>&copy; 2015 The Cake Shop LTD &middot; <a href='privacy.html'>Privacy</a> &middot; <a href='terms.html'>Terms</a></p>
    </footer>
</div><!-- /.container -->
</body>
</html>