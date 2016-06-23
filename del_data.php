<?php
// checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("libraries/password_compatibility_library.php");
}
// include the configs / constants for the database connection
require_once("config/db.php");
// load the login class
require_once("classes/Login.php");
// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process. in consequence, you can simply ...
$login = new Login();
// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
  echo "<!DOCTYPE html>
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

    <div class=\"page-header\">
      <h1><br />Enquiry Admin</h1>
      </div>
      <ul class=\"nav nav-tabs\" role=\"tablist\">
        <li><a href=\"admin.php\">View</a></li>
        <li><a href=\"update_data.php\">Edit</a></li>
        <li class=\"active\"><a href=\"del_data.php\">Delete</a></li>
        <li><a href=\"admin.php?logout\">Logout</a></li>
      </ul>";
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbName = "guestbook";
  $table = "test_table";
  mysql_connect($hostname, $username, $password) or die ("Не могу создать соединение");
  mysql_select_db($dbName) or die (mysql_error());
  $del = $_GET["del"];
  $query = "delete from $table where (id='$del')";
  mysql_query($query) or die(mysql_error());
  $query = "SELECT * FROM $table";
  $res = mysql_query($query) or die(mysql_error());
  $row = mysql_num_rows($res);
  echo ("
  <style type=\"text/css\">
  <!--
  table { width: 100%; border-collapse: collapse; margin: 0px auto; background: #E6E6E6; }
  td { padding: 5px; text-align: center; vertical-align: middle; }
  -->
  </style>
  <h3>Delete data from MySQL table</h3>
  <table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">
   <tr style=\"border: solid 1px #000\">
    <td><b>#</b></td>
    <td align=\"center\"><b>Date</b></td>
    <td align=\"center\"><b>Name</b></td>
    <td align=\"center\"><b>Number</b></td>
    <td align=\"center\"><b>E-Mail</b></td>
    <td align=\"center\"><b>Age</b></td>
    <td align=\"center\"><b>Enquiry</b></td>
    <td align=\"center\"><b>Other</b></td>
    <td align=\"center\"><b>Delete</b></td>
   </tr>
  ");
  while ($row = mysql_fetch_array($res)) {
      echo "<tr>\n";
      echo "<td>".$row['id']."</td>\n";
      echo "<td>".$row['data']."</td>\n";
      echo "<td>".$row['name']."</td>\n";
      echo "<td>".$row['numb']."</td>\n";
      echo "<td>".$row['email']."</td>\n";
      echo "<td>".$row['age']."</td>\n";
      echo "<td>".$row['enquiry']."</td>\n";
      echo "<td>".$row['other']."</td>\n";
      echo "<td><a method=\"post\" name=\"del\" href=\"del_data.php?del=".$row["id"]."\">Delete</a></td>\n";
      echo "</tr>\n";
  }
  echo ("</table>\n");
  mysql_close();
  echo "    <footer><p>&nbsp;</p>
      <p class='pull-right'><a href='#'>Back to top</a></p>
      <p>&copy; 2015 The Cake Shop LTD &middot; <a href='privacy.html'>Privacy</a> &middot; <a href='terms.html'>Terms</a></p>
      </footer>
  </div><!-- /.container -->
  </body>
  </html>";
} else {
    // the user is not logged in. you can do whatever you want here.
    // for demonstration purposes, we simply show the "you are not logged in" view.
    include("views/not_logged_in.php");
}
?>