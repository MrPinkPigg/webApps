<?php
/*
  getuserinfo.php
  author: Christopher Kramer
  desc: This file is not meant for browsing directly. Instead, it is called by an AJAX function, and simply retrieves the currently logged in username, according to a cookie. You could actually just do this on the client side with javascript, but the code is CRAZY
*/

if (!isset($_COOKIE['uname'])) {
 die("GUEST");
}

echo $_COOKIE['uname'];

?>