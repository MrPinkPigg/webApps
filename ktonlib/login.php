<?php
/*
  login.php
  author: Christopher Kramer
  desc: should recieve GET data relating to login from 'index.html'. queries the database to confirm login credentials. If the login is successful, sets a cookie and redirects to the main page. If login is not successful, show a message and throw back to login page.
*/

if (!isset($_GET['uname']) || !isset($_GET['pass'])) {
 echo "<meta http-equiv='REFRESH' content='2;url=index.html'>";
 echo "<h1>Login failed!</h1>Please wait while we redirect you to the login page.";
} else {

$con = new mysqli("localhost","root","","library");
if ($con->connect_errno) {
 echo "<meta http-equiv='REFRESH' content='2;url=index.html'>";
 die("<h1>Login failed!</h1>Could not connect to database! ".$con->connect_error."<br>Please wait while we redirect you to the login page.");
}

$a = $_GET['uname'];
$b = $_GET['pass'];

// Generate a MySQL query to get login information
$res = $con->query("
SELECT * FROM patrons
WHERE uname = '$a' AND password = '$b'
");
if (!$res) {
 die("MySQL query failed! ".$con->error);
}

// if the query succeeded, but didn't return any rows, then the login info was incorrect.
$row = $res->fetch_assoc();
if (!$row) {
 die("Login failed! Bad username or password.");
}

echo "Login successful! <br>Setting cookie...";
setcookie("uname", $a, time()+3600);  // cookie lasts 1 hour
setcookie("pass", $b, time()+3600);

// echo $_COOKIE['uname']."/".$_COOKIE['pass']; //This line of code is commented out and doesn't work. This is because when you use setcookie, the cookie is created on the client side, whereas this script is still being executed on the server side. Therefore, the $_COOKIE variable still doesn't exist until the next page is loaded.

echo "<meta http-equiv='REFRESH' content='2;url=main.html'>";
echo $a."/".$b."<br>";

}
?>