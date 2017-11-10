var hWindow     = 300,
    wWindow     = 1300,
    nodeCount   = 3,
    
    xBall,
    yBall,
    xLastBall,
    yLastBall,
    rBall       = 5,
    
    fMouseDown  =
    !(fMouseUp  =true);

function getMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    return {
      x: evt.clientX - rect.left,
      y: evt.clientY - rect.top
    };
}

var myGameArea = {
    canvas : document.createElement("canvas"),
    start : function() {
        this.canvas.width = wWindow;
        this.canvas.height = hWindow;
        this.canvas.style.cursor = "none";
        this.context = this.canvas.getContext("2d");
        if(document.body.childNodes.length===nodeCount){
            document.body.appendChild(this.canvas);
            nodeCount++;
        }
        this.canvas.onmousemove = function(e){
            var mousePos = getMousePos(myGameArea.canvas, e);
            xBall = mousePos.x;
            yBall = mousePos.y;
        };
        this.canvas.onmousedown = function(e){
            fMouseUp = !(fMouseDown=true);
        };
        this.canvas.onmouseup   = function(e){
            fMouseUp = !(fMouseDown=false);
        };
        this.interval = setInterval(gameLoop, 20);
    },
    clear : function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    },
    draw : function (){
        this.context.fillStyle = "#373737";
        this.context.beginPath ();
        this.context.arc (xBall, yBall, rBall, 0, Math.PI * 2, true);
        this.context.fill();
        this.context.closePath ();
    }
};

function gameLoop(){
    if (fMouseDown){
        xLastBall = xBall;
        yLastBall = yBall;
    }
    myGameArea.clear();
    myGameArea.draw();
}