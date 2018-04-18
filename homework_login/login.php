<?php
/*
  login.php
  author: Christopher Kramer
  desc: should recieve GET data relating to login from 'index.html'. queries the database to confirm login credentials. If the login is successful, sets a cookie and redirects to the main page. If login is not successful, show a message and throw back to login page.
*/

  if (!isset($_POST['uname']) xor !isset($_POST['pass'])) {
  	echo "<meta http-equiv='REFRESH' content='2;url=index.html'>";
  	echo "<h1>Login failed!</h1>Please wait while we redirect you to the login page. is this broke";
  } else {

  	$con = new mysqli("localhost","root","root","users");
  	if ($con->connect_errno) {
  		echo "<meta http-equiv='REFRESH' content='2;url=index.html'>";
  		die("<h1>Login failed!</h1>Could not connect to database! ".$con->connect_error."<br>Please wait while we redirect you to the login page.");
  	}

  	$a = $_GET['uname'];
  	$b = $_GET['pass'];

  	$res = $con->query("
  		SELECT * FROM info
  		WHERE uname = '$a' AND pass = '$b'
  		");
  	if (!$res) {
  		die("MySQL query failed! ".$con->error);
  	}

  	$row = $res->fetch_assoc();
  	if (!$row) {
  		die("Login failed! Bad username or password.");
  	}

  	echo "Login successful! <br>Setting cookie...";
setcookie("uname", $a, time()+3600);  // cookie lasts 1 hour
setcookie("pass", $b, time()+3600);

echo "<meta http-equiv='REFRESH' content='2;url=main.html'>";
echo $a."/".$b."<br>";

}
?>