function loadGame () {
	var audio = new Audio("./assets/music.mp3");
	audio.play();
}

var text = [
	"Welcome to Doki Doki ACM!", //wal
	"We don't really do anything except screw around on computers.", //wal
	"Hey there, I'm Wednesday frog, my dude.", //frog
	"It is not Wednesday :'(", //frog
	"Acording to all known laws of aviation,", //bee
	"there is no way a bee should be able to fly.", //bee
	"It's wings are too small to get it's", //bee
	"fat little body off the ground.", //bee
	"                        ", //blank space?
	"I'm not actually going to recite the whole script", //bee
	"This is just to show the characters fading in and out", //wal
	"and changing text.", //wal
	"I didn't know how detailed to make the story, so", //frog
	"maybe I'll extend it later. It was fun though", //frog
];

var i = 0;

function changeText() {
	var words = text[i];

		if (i == 0) {
			$(function(){
				$('#fadeIn').fadeIn(2000);
			});
		}
		else if (i == 2) {
			$(function(){
				$('#fadeIn2').fadeIn(2000);
				$('#fadeIn').css("opacity", "0.6");
			});
		}
		else if (i == 4) {
			$(function(){
				$('#fadeIn3').fadeIn(1000);
				$('#fadeIn2').css("opacity", "0.6");
			});
		}
		else if (i == 10) {
			$(function(){
				$('#fadeIn').css("opacity", "1.0");
				$('#fadeIn3').css("opacity", "0.6");
			})
		}
		else if (i == 12) {
			$(function(){
				$('#fadeIn2').css("opacity", "1.0");
				$('#fadeIn').css("opacity", "0.6");
			})
		}
		else if (i > 13) {
			words = "There is no more text. Didn't write a whole story. Sorry to get your hopes up"

			$(function(){
				$('#fadeIn2').css("opacity", "0.6");
			})
		}
	
	i++;	
	document.getElementById('text').innerHTML = words;
}