<?php

/*
   install.php
   author: Christopher Kramer
   description: Part of the Kramerton Public Library web app. This file is meant to be run once on the server, to automatically set up the database, tables, and load information into the tables.
   
   DO NOT FEAR THE WALL OF TEXT. READ IT CAREFULLY TO UNDERSTAND WHAT I DID.
*/

$con = new mysqli("127.0.0.1","root","");  // connect to server and create a new mysqli connection object. Methods are called on this object with the -> operator in php (different than the dot (.) operator in java)

if ($con->connect_errno) { // if you can't connect, then halt with an error
 die("couldn't connect! mysql said: ".$con->connect_errno."<br>".$con->connect_error."Halting");
}

echo "Connected to server!<br>";

//Try to create database
if (!$con->query("CREATE DATABASE library")) {
  //If database creation fails, don't die - the db probably already exists
  echo "Couldn't create database: ".$con->error."<br>";
} else {
  echo "Database: library created<br>";
}

//Try to select the db - if this doesn't work, then die, because there's a bigger problem
if (!$con->select_db("library")){
 die("Error selecting database! ".$con->errno."<br>".$con->error."Halting.");
} else {
 echo "Selected database: library<br>";
}

// creating tables: notice all the error checking - after every table! Also, it echos lots of things so debugging is easy

// create the table of books - notice that the b_id field is the primary key and auto-increments
// had to rename the 'condition' field to 'b_condition' because condition is a reserved word in mysql
$res = $con->query("
CREATE TABLE books
(
b_id int NOT NULL AUTO_INCREMENT,
title text NOT NULL,
pdate date NOT NULL,
author text NOT NULL,
publisher text NOT NULL,
b_condition text,
PRIMARY KEY (b_id)
)
");

if (!$res) {
 echo "Couldn't create books table: ".$con->error."<br>";
} else {
 echo "Table created: books<br>";
}

// create the table of patrons - the UNIQUE keyword is used to make sure nobody has the same usernames
$res = $con->query("
CREATE TABLE patrons
(
p_id int NOT NULL AUTO_INCREMENT,
uname varchar(255) NOT NULL,
dob date NOT NULL,
password text NOT NULL,
email text NOT NULL,
PRIMARY KEY (p_id),
UNIQUE (uname)
)
");

if (!$res) {
 echo "Couldn't create patrons table: ".$con->error."<br>";
} else {
 echo "Table created: patrons<br>";
}

//transaction types table
$res = $con->query("
CREATE TABLE tran_types
(
t_type int NOT NULL,
t_name varchar(100) NOT NULL,
PRIMARY KEY (t_type),
UNIQUE (t_name)
)
");

if (!$res) {
 echo "Couldn't create tran_types table: ".$con->error."<br>";
} else {
 echo "Table created: tran_types<br>";
}

//transactions table - Note the use of FOREIGN KEY to establish relationships with other tables. Look up the syntax on w3schools!
$res = $con->query("
CREATE TABLE transactions
(
t_id int NOT NULL AUTO_INCREMENT,
p_id int NOT NULL,
b_id int NOT NULL,
ttime datetime NOT NULL,
t_type int NOT NULL,
PRIMARY KEY (t_id),
FOREIGN KEY (p_id) REFERENCES patrons(p_id),
FOREIGN KEY (b_id) REFERENCES books(b_id),
FOREIGN KEY (t_type) REFERENCES tran_types(t_type)
)");

if (!$res) {
 echo "Couldn't create transactions table: ".$con->error."<br>";
} else {
 echo "Table created: transactions<br>";
}

/*======================================
  = inserting default data into tables =
  ======================================*/
  
// patrons
$res = $con->query("INSERT INTO patrons (uname, dob, password, email)
VALUES ('root','1979-02-05','root','root@localhost')");
if (!$res) {
 echo "Failed to insert: patrons: root ".$con->error;
} else {
 echo "Inserted: patrons: root";
}
echo "<br>";

$res = $con->query("INSERT INTO patrons (uname, dob, password, email)
VALUES ('test','1991-09-23','test','test@localhost')");
if (!$res) {
 echo "Failed to insert: patrons: test ".$con->error;
} else {
 echo "Inserted: patrons: test";
}
echo "<br>";

// transaction types
$res = $con->query("INSERT INTO tran_types (t_type, t_name)
VALUES (1,'Check Out')");
if (!$res) {
 echo "Failed to insert: tran_types: Check Out ".$con->error;
} else {
 echo "Inserted: tran_types: Check Out ";
}
echo "<br>";
$res = $con->query("INSERT INTO tran_types (t_type, t_name)
VALUES (2,'Return')");
if (!$res) {
 echo "Failed to insert: tran_types: Return ".$con->error;
} else {
 echo "Inserted: tran_types: Return ";
}
echo "<br>";
$res = $con->query("INSERT INTO tran_types (t_type, t_name)
VALUES (3,'Purchase')");
if (!$res) {
 echo "Failed to insert: tran_types: Purchase ".$con->error;
} else {
 echo "Inserted: tran_types: Purchase ";
}
echo "<br>";
$res = $con->query("INSERT INTO tran_types (t_type, t_name)
VALUES (4,'Sale')");
if (!$res) {
 echo "Failed to insert: tran_types: Sale ".$con->error;
} else {
 echo "Inserted: tran_types: Sale ";
}
echo "<br>";

// books
// TODO: right now books are just dummy data to mess with
$res = $con->query("INSERT INTO books (title, pdate, author, publisher, b_condition )
VALUES ('Moby Dick','1880-12-20','Melville, Herman','Rhode Island Press','Worn cover, cracked spine')");
if (!$res) {
 echo "Failed to insert: books: Moby Dick ".$con->error;
} else {
 echo "Inserted: books: Moby Dick";
}
echo "<br>";
$res = $con->query("INSERT INTO books (title, pdate, author, publisher, b_condition )
VALUES ('Moby Dick','2005-08-11','Melville, Herman','Scholastica','')");
if (!$res) {
 echo "Failed to insert: books: Moby Dick2 ".$con->error;
} else {
 echo "Inserted: books: Moby Dick2";
}
echo "<br>";
$res = $con->query("INSERT INTO books (title, pdate, author, publisher, b_condition )
VALUES ('One Fish Two Fish Red Fish Blue Fish','1960-03-12','Suess, Dr.','Random House','Drool stain, pg. 4')");
if (!$res) {
 echo "Failed to insert: books: One Fish ".$con->error;
} else {
 echo "Inserted: books: One Fish";
}
echo "<br>";
$res = $con->query("INSERT INTO books (title, pdate, author, publisher, b_condition )
VALUES ('Nifty Shades of Beige','2012-05-30','Simms, B. D.','Vantage Books','Strange smell')");
if (!$res) {
 echo "Failed to insert: books: Nifty Shades ".$con->error;
} else {
 echo "Inserted: books: Nifty Shades";
}
echo "<br>";
// transactions (these are just dummy transactions for now)
$res = $con->query("INSERT INTO transactions (p_id, b_id, ttime, t_type )
VALUES (2, 4, '2012-11-27 14:17:46', 1)");
if (!$res) {
 echo "Failed to insert: transaction 1 ".$con->error;
} else {
 echo "Inserted: transaction 1";
}
echo "<br>";
$res = $con->query("INSERT INTO transactions (p_id, b_id, ttime, t_type )
VALUES (2, 4, '2012-11-29 10:12:31', 2)");
if (!$res) {
 echo "Failed to insert: transaction 2 ".$con->error;
} else {
 echo "Inserted: transaction 2";
}
echo "<br>";
//TODO: more books and transactions?
?>