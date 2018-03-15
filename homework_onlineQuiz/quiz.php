<!DOCTYPE html>
<html lang="en">
<?php
	if (isset($_GET['q1'])) {
		$score = 0;

		if ($_GET['q1'] == 1) {$score = $score + 5;}
		if ($_GET['q1'] == 2) {$score = $score + 0;}
		if ($_GET['q1'] == 3) {$score = $score + 2;}
		if ($_GET['q1'] == 4) {$score = $score + 1;}

		if ($_GET['q2'] == 1) {$score = $score + 1;}
		if ($_GET['q2'] == 2) {$score = $score + 2;}
		if ($_GET['q2'] == 3) {$score = $score + 0;}
		if ($_GET['q2'] == 4) {$score = $score + 5;}

		if ($_GET['q3'] == 1) {$score = $score + 2;}
		if ($_GET['q3'] == 2) {$score = $score + 1;}
		if ($_GET['q3'] == 3) {$score = $score + 0;}
		if ($_GET['q3'] == 4) {$score = $score + 5;}

		if ($_GET['q4'] == 1) {$score = $score + 1;}
		if ($_GET['q4'] == 2) {$score = $score + 0;}
		if ($_GET['q4'] == 3) {$score = $score + 5;}
		if ($_GET['q4'] == 4) {$score = $score + 2;}

		if ($_GET['q5'] == 1) {$score = $score + 2;}
		if ($_GET['q5'] == 2) {$score = $score + 5;}
		if ($_GET['q5'] == 3) {$score = $score + 0;}
		if ($_GET['q5'] == 4) {$score = $score + 1;}



		if ($score <= 2) {echo "You got our very own, Mr Haoda Wang";} 
		
		else if ($score <= 6) {echo "You could probably date the meme man, you're in a weird category bucko";}

		else if ($score <= 15) {echo "You want someone that's truly number one, like Stefan Karl!";}

		else {echo "You want someone on as many layers of irony as Eric the Long Boye";}
	}
	
	else {echo "Take the quiz, stoopid";}
?>
</html>