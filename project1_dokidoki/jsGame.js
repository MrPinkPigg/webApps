function loadGame () {
	var audio = new Audio("./assets/music.mp3");
	audio.play();
}

var text = [
	"Welcome to Doki Doki ACM!",
	"Hey there, I'm Wednesday frog, my dude.",
	"Acording to all known laws of aviation...",
];

var i = 0;

function changeText() {
	var words = text[i];

		if (i == 0) {
			$(function(){
				$('#fadeIn').fadeIn(2000);
			});
		}
		else if (i == 1) {
			$(function(){
				$('#fadeIn2').fadeIn(2000);
				$('#fadeIn').css("opacity", "0.5");
			});
		}
		else if (i == 2) {
			$(function(){
				$('#fadeIn3').fadeIn(1000);
				$('#fadeIn2').css("opacity", "0.5");
			});
		}
	
	i++;	
	document.getElementById('text').innerHTML = words;
}