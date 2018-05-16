(function () {
    var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
    window.requestAnimationFrame = requestAnimationFrame;
})();

var canvas = document.getElementById("canvas"),
    ctx = canvas.getContext("2d"),
    width = 1800,
    height = 800,
    player = {
        x: 100,
        y: 100,
        width: 55,
        height: 55,
        speed: 12,
        velX: 0,
        velY: 0,
        jumping: false,
        grounded: false
    },
    keys = [],
    friction = 0.9,
    gravity = 0.8;

var boxes = [];

// dimensions
//walls
boxes.push({
    x: 0,
    y: 800,
    width: width,
    height: 1,
});
boxes.push({
    x: 0,
    y: 0,
    width: 1,
    height: height,
});
boxes.push({
    x: 1800,
    y: 0,
    width: 1,
    height: height,
});
//platforms
boxes.push({
    x: 200,
    y: 600,
    width: 150,
    height: 7,
});
boxes.push({
    x: 600,
    y: 600,
    width: 150,
    height: 7,
});
boxes.push({
    x: 1000,
    y: 600,
    width: 250,
    height: 7,
});
boxes.push({
    x: 420,
    y: 300,
    width: 250,
    height: 7,
});
boxes.push({
    x: 850,
    y: 400,
    width: 100,
    height: 7,
});
boxes.push({
    x: 1100,
    y: 200,
    width: 150,
    height: 7,
});


canvas.width = width;
canvas.height = height;

function update() {
    // check keys
    if (keys[38] || keys[87]) {
        // up arrow and W
        if (!player.jumping && player.grounded) {
            player.jumping = true;
            player.grounded = false;
            player.velY = -player.speed * 2;
        }
    }
    if (keys[39] || keys[68]) {
        // right arrow and D
        if (player.velX < player.speed) {
            player.velX++;
        }
    }
    if (keys[37] || keys[65]) {
        // left arrow and A
        if (player.velX > -player.speed) {
            player.velX--;
        }
    }
    if (keys[40] || keys[83]) {
      // down arrow and S
    }
    if (keys[32]) {
      // spacebar
    }

    player.velX *= friction;
    player.velY += gravity;

    ctx.clearRect(0, 0, width, height);
    ctx.fillStyle = "black";
    ctx.beginPath();

    player.grounded = false;
    for (var i = 0; i < boxes.length; i++) {
        ctx.fillRect(boxes[i].x, boxes[i].y, boxes[i].width, boxes[i].height);

        var dir = colCheck(player, boxes[i]);

        if (dir === "l" || dir === "r") {
            player.velX = 0;
            player.jumping = false;
        } else if (dir === "b") {
            player.grounded = true;
            player.jumping = false;
        } else if (dir === "t") {
            player.velY *= -1;
        }

    }

    if(player.grounded){
         player.velY = 0;
    }

    player.x += player.velX;
    player.y += player.velY;

    var img = document.getElementById("capt");
    ctx.drawImage(img, player.x, player.y, player.width, player.height);

    requestAnimationFrame(update);
}

function colCheck(shapeA, shapeB) {
    // get the vectors to check against
    var vX = (shapeA.x + (shapeA.width / 2)) - (shapeB.x + (shapeB.width / 2)),
        vY = (shapeA.y + (shapeA.height / 2)) - (shapeB.y + (shapeB.height / 2)),
        // add the half widths and half heights of the objects
        hWidths = (shapeA.width / 2) + (shapeB.width / 2),
        hHeights = (shapeA.height / 2) + (shapeB.height / 2),
        colDir = null;

    // if the x and y vector are less than the half width or half height, they we must be inside the object, causing a collision
    if (Math.abs(vX) < hWidths && Math.abs(vY) < hHeights) {
        // figures out on which side we are colliding (top, bottom, left, or right)
        var oX = hWidths - Math.abs(vX),
            oY = hHeights - Math.abs(vY);
        if (oX >= oY) {
            if (vY > 0) {
                colDir = "t";
                shapeA.y += oY;
            } else {
                colDir = "b";
                shapeA.y -= oY;
            }
        } else {
            if (vX > 0) {
                colDir = "l";
                shapeA.x += oX;
            } else {
                colDir = "r";
                shapeA.x -= oX;
            }
        }
    }
    return colDir;
}

document.body.addEventListener("keydown", function (e) {
    keys[e.keyCode] = true;
});

document.body.addEventListener("keyup", function (e) {
    keys[e.keyCode] = false;
});


window.addEventListener("load", function () {
    update();
});
