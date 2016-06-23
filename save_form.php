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
    <li class='active'><a href='enquiry.html'>Enquiry</a></li>
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
    <h1><br />Adding Enquiry</h1>
  </div>
<?
/* Connect to the database */
$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "guestbook";
$table = "test_table";
/* Creating the connection */
mysql_connect($hostname, $username, $password) or die ("Не могу создать соединение");
/* Choose the db */
mysql_select_db($dbName) or die (mysql_error());
/* Get the current date */
$cdate = date("Y-m-d");
$error_msg = array();
$requiredFields = "name,numb,email,age,enquiry,other";
$requiredFields = explode(",", $requiredFields);
/* Get and validate the entered data */
if ($_SERVER['REQUEST_METHOD'] == "POST") {
foreach($requiredFields as $field) {
	trim($_POST[$field]);
	if (!isset($_POST[$field]) || empty($_POST[$field]) && array_pop($error_msg) != "Please fill in all the required fields and submit again.\r\n")
	$error_msg[] = "Please fill in all the required fields and submit again.";
}
if (!empty($_POST['name']) && !preg_match("/^[a-zA-Z-'\s]*$/", stripslashes($_POST['name'])))
	$error_msg[] = "The name field must not contain special characters.\r\n";
if (!empty($_POST['email']) && !preg_match('/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+' . '(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i', strtolower($_POST['email'])))
	$error_msg[] = "That is not a valid e-mail address.\r\n";
if (!empty($_POST['numb']) && !preg_match('/^(\(?\+?[0-9]*\)?)?[0-9_\- \(\)]*$/', $_POST['numb']))
	$error_msg[] = "Invalid phone humber.\r\n";
if ($error_msg == NULL) {
$query = "INSERT INTO $table SET name='".$_POST["name"]."', numb='".$_POST["numb"]."', email='".$_POST["email"]."',
age='".$_POST["age"]."', enquiry='".$_POST["enquiry"]."', other='".$_POST["other"]."', data='$cdate'";
/* Processing the query */
mysql_query($query) or die(mysql_error());
/* Closing the connection */
mysql_close();
echo ("<div style=\"text-align: center; margin-top: 10px;\">
<font color=\"green\">The enquiry successfully sent!</font>
<br /><br />
<a href=\"index.html\"><button class=\"btn btn-success\">Home</button></a>");
} else {
	echo ("<div style=\"text-align: center; margin-top: 10px;\">
	<font color=\"red\"><p class=\"error\">ERROR: ". implode("<br />", $error_msg) ."</p></font>
	 
	<button class=\"btn btn-danger\" onclick=\"history.back()\">Back</button>");
}
}
?>
    <footer>
    <p class='pull-right'><a href='#'>Back to top</a></p>
    <p>&copy; 2015 The Cake Shop LTD &middot; <a href='privacy.html'>Privacy</a> &middot; <a href='terms.html'>Terms</a></p>
    </footer>
</div><!-- /.container -->
</body>
</html>