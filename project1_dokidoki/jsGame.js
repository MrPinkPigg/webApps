function loadGame () {
	var audio = new Audio("./assets/music.mp3");
	audio.play();
}

var text = [
	"Welcome to Doki Doki ACM!",
	
];

$(function(){
	$('#fadeIn').fadeIn(4000);
});

function changeText() {
	document.getElementById('text').innerHTML = 'test';
}