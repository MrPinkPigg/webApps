<?php

$con = new mysqli("127.0.0.1","root","root"); 

if ($con->connect_errno) {
  die("couldn't connect! mysql said: ".$con->connect_errno."<br>".$con->connect_error."Halting");
}

echo "Connected to server!<br>";

if (!$con->query("CREATE DATABASE users")) {
	echo "Couldn't create database: ".$con->error."<br>";
} else {
	echo "Database: users created<br>";
}

if (!$con->select_db("users")){
	die("Error selecting database! ".$con->errno."<br>".$con->error."Halting.");
} else {
	echo "Selected database: users<br>";
}

$res = $con->query("
	CREATE TABLE info
	(
  b_id int NOT NULL AUTO_INCREMENT,
  uname text NOT NULL,
  pass text NOT NULL,
  PRIMARY KEY (b_id)
)
");

if (!$res) {
	echo "Couldn't create info table: ".$con->error."<br>";
} else {
	echo "Table created: info<br>";
}


/*======================================
  = inserting default data into tables =
  ======================================*/

  $res = $con->query("INSERT INTO info (uname, pass)
  	VALUES ('root','root')");
  if (!$res) {
  	echo "Failed to insert: info: root ".$con->error;
  } else {
  	echo "Inserted: info: root";
  }
  echo "<br>";

  $res = $con->query("INSERT INTO info (uname, pass)
    VALUES ('toor','toor')");
  if (!$res) {
    echo "Failed to insert: info: toor ".$con->error;
  } else {
    echo "Inserted: info: toor";
  }
  echo "<br>";

  ?>