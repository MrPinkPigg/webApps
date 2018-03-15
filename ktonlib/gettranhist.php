<?php
/*
 gettranhist.php
 author: Christopher Kramer
 desc: this file should query the database and recieve all transactions done by the currently logged in user.
*/

if (!isset($_COOKIE['uname']) || !isset($_COOKIE['pass'])) {
 die ("Not logged in!");
}

$con = new mysqli("localhost","root","","library");
if($con->connect_errno) {
 die("Couldn't connect to DB server! Contact a system admin.<br>".$con->connect_error);
}

/*
 SECURITY NOTE: Cookies are NOT typically used to store passwords - you would use SESSIONS instead, which are similar in usage to cookies, but stored server-side. The reason is if the client is compromised (someone steals their computer or installs a virus), the password is not revealed to the attacker through browser cookie information. SESSIONS can also be spoofed, but it's much more difficult.
 
 The current code (the part that says "Bad Login Cookie!" will prevent users from trying to create random cookies and using them. That is a variation of something called cookie spoofing. The spoof is prevented by just checking the login credentials against the database.
*/
$un = $_COOKIE['uname'];
$pa = $_COOKIE['pass'];

$res = $con->query("
SELECT *
FROM patrons
WHERE uname='$un' AND password='$pa'
");

if (!$res) {
 die("Issue with cookie-check query!<br>".$con->error);
}

$row = $res->fetch_assoc();
if (!$row) {
 die ("Bad Login Cookie!<br>".$con->error);
}

/*
 THE FOLLOWING QUERY IS SUPER-IMPORTANT AND SHOULD BE EXAMINED IN DETAIL
 Table joins are an incredibly powerful feature of SQL, but they can be difficult to understand. Look it up in multiple places, ask Mr. Kramer about it, whatever it takes, but understand what this query is doing!
*/
$res = $con->query("
SELECT t.ttime, tt.t_name, b.title FROM patrons p
JOIN transactions t ON t.p_id = p.p_id
JOIN tran_types tt ON t.t_type = tt.t_type
JOIN books b ON t.b_id = b.b_id
WHERE p.uname = '$un'
");

if (!$res) {
 die("Issue with main query!<br>".$con->error);
}

$row = $res->fetch_assoc();
if(!$row) {
 die("No transaction data! Check out some books!");
}

echo "<table><tr><td>Transaction Time</td><td>Type of Transaction</td><td>Book Name</td></tr>";
// Reset the result pointer to the first row, because one row was read to check if there were any results
$res->data_seek(0);
while ($row = $res->fetch_assoc()) {
 $a = $row['ttime'];
 $b = $row['t_name'];
 $c = $row['title'];
 echo "<tr><td>$a</td><td>$b</td><td>$c</td></tr>";
}
echo "</table>";

?>