function load () {
	var audio = new Audio("./assets/music.mp3");
	audio.play();
}

function randColor () {
	var code1 = (Math.floor(Math.random()*255));
	var code2 = (Math.floor(Math.random()*255));
	var code3 = (Math.floor(Math.random()*255));

	var color = "rgb("+code1+", "+code2+", "+code3+")";
	//console.log(color);
	return color;
}

function textColor () {
	document.getElementById("textColor").style.color = randColor();
}

setInterval(textColor, 100);