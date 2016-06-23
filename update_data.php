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
        <li class=\"active\"><a href=\"update_data.php\">Edit</a></li>
        <li><a href=\"del_data.php\">Delete</a></li>
        <li><a href=\"admin.php?logout\">Logout</a></li>
      </ul>";
  /* Соединяемся с базой данных */
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbName = "guestbook";
  /* Table with data */
  $table = "test_table";
  /* Creating connection */
  mysql_connect($hostname, $username, $password) or die ("Не могу создать соединение");
  /* Choosing the db */
  mysql_select_db($dbName) or die (mysql_error());
  $update = $_POST["update"];
  $name = $_POST["name"];
  $email = $_POST["email"];
  $numb = $_POST["numb"];
  $enquiry = $_POST["enquiry"];
  $other = $_POST["other"];
  /* Making changes in the db */
  $submit_edit = $_POST["submit_edit"];
  $query = "UPDATE $table SET name='$name', email='$email', numb='$numb', enquiry='$enquiry', other='$other' WHERE id='$update'";
  mysql_query($query) or die (mysql_error());
  $query = "SELECT * FROM $table";
  /* Processing the query */
  $res = mysql_query($query) or die(mysql_error());
  /* Get the quantity of rows */
  $row = mysql_num_rows($res);
  /* Output of data from the table */
  echo ("
  <style type=\"text/css\">
  <!--
  table { width: 100%; border-collapse: collapse; margin: 0px auto; background: #E6E6E6; }
  td { padding: 5px; text-align: center; vertical-align: middle; }
  -->
  </style>
  <h3>Edit records in MySQL table</h3>
  ");
  /* Output loop */
  while ($row = mysql_fetch_array($res)) {
      echo "<form action=\"update_data.php\" method=\"post\" name=\"edit_form\">\n";
      echo "<input type=\"hidden\" name=\"update\" value=\"".$row["id"]."\" />\n";
      echo "<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\">\n";
      echo "<tr>\n";
      echo "<td colspan=\"2\" style=\"text-align: left;\"><b><i><div id=\"num\">#".$row["id"]."</div>".$row['data']."</b></i></td>\n";
      echo "</tr><tr>\n";
      echo "<td>Name:</td><td><input  class=\"form-control\" type=\"text\" value=\"".$row['name']."\" name=\"name\" /></td>\n";
      echo "</tr><tr>\n";
      echo "<td>Number:</td><td><input  class=\"form-control\" type=\"text\" value=\"".$row['numb']."\" name=\"numb\" /></td>\n";
      echo "</tr><tr>\n";
      echo "<td>E-Mail:</td><td><input  class=\"form-control\" type=\"text\" value=\"".$row['email']."\" name=\"email\" /></td>\n";
      echo "</tr><tr>\n";
      echo "<td>Age:</td><td><input  class=\"form-control\" type=\"text\" value=\"".$row['age']."\" name=\"age\" /></td>\n";
      echo "</tr><tr>\n";
      echo "<td>Message:</td><td><textarea  class=\"form-control\" name=\"enquiry\">".$row['enquiry']."</textarea></td>\n";
      echo "</tr><tr>\n";
      echo "<td>Other:</td><td><textarea  class=\"form-control\" name=\"other\">".$row['other']."</textarea></td>\n";
      echo "</tr><tr>\n";
      echo "<td colspan=\"2\" align=\"left\" style=\"text-align: left;\"><input type=\"submit\" name=\"submit_edit\" class=\"buttons btn btn-success\" value=\"Save\" /></td>\n";
      echo "</tr></table><br /></form>\n\n";
  }   
  mysql_close();   
  echo "<footer>
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