<!DOCTYPE html>
<html lang="en">

<?php

if (isset($_GET['q1'])) {
	echo "stuff";
	echo $_GET["q1"];
	if ($_GET['q1'] == 1) {echo "stuff 1";}
}

else {echo "TAKE THE QUIZ";}
?>

</html>