var script = document.createElement('script');
script.src= "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js";
script.type = 'text/javascript';

const $ = require('jquery');

function loadGame () {
	var audio = new Audio("./assets/music.mp3");
	audio.play();

	$(function(){
		$("#start").onLoad(function(){
        	$("#wal").fadeIn(100);
    	});
	})
}


function start () {
	alert("test");
}

