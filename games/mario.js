var oHero,
    leftUp,rightUp,rightDown,leftDown=rightDown=!(leftUp=rightUp=true),
    wWindow=document.body.offsetWidth,
    hWindow=document.body.offsetHeight,
    mainLoopInt,
    
    collisionPrecision      = 10000,
    friction                = 0.25,
    characterAcceleration   = 0.5,
    gravity                 = 0.2,
    maxSpeed                = 10;

window.onload=function(){
    game.load();
}

var game = {
    field:document.createElement("canvas"),
    load:function(){
        document.body.appendChild (this.field);
        
        this.field.width  = wWindow;
        this.field.height = hWindow;
        this.field.style.backgroundColor = document.body.style.backgroundColor = "#FFFF00";
        
        oHero   = createTangibleObject (wWindow-10,0,-5.0,0,0,gravity,"blue",{x:0,y:0},{x:4,y:-6},{x:8,y:0},{x:4,y:3});
        oHero.conflictsWith = [createTangibleObject (0,hWindow-10,0,0,0,0,"#ffffff",{x:0,y:0},{x:wWindow,y:0},{x:wWindow,y:10},{x:0,y:10})];
        
        mainLoopInt = setInterval (function(){mainLoop(game.field)},20);
    }
}

window.onkeydown = function (e){
    var key = e.keyCode?e.keyCode:e.which;
    if (key===37&&leftUp)
        leftDown=!(leftUp=false);
    else if (key===39&&rightUp)
        rightDown=!(rightUp=false);
}

window.onkeyup = function (e){
    var key = e.keyCode?e.keyCode:e.which;
    if (key===37)
        leftDown=!(leftUp=true);
    else if (key===39)
        rightDown=!(rightUp=true);
}

function mainLoop(cvs){
    var ctx = cvs.getContext("2d");
    ctx.clearRect(0,0,cvs.width,cvs.height);
    oHero.draw (ctx);
    oHero.conflictsWith[0].draw (ctx);
    
    oHero.checkConflictions ();
    oHero.move();
    
    if (leftDown && !rightDown)
        oHero.ddX = (oHero.dX>-maxSpeed?-characterAcceleration:0);
    else if (rightDown && !leftDown)
        oHero.ddX = (oHero.dX<maxSpeed?characterAcceleration:0);
    else
        oHero.ddX = Math.sign (oHero.dX)*-friction;
}

function createTangibleObject (){
    var args = Array.from(arguments);
    var args = [...arguments];
    var temp,n=0;
    
    for (temp=0;typeof args[temp]!='object';temp++);
    
    return {
        x       : (temp>n?args[n++]:0),
        y       : (temp>n?args[n++]:0),
        dX      : (temp>n?args[n++]:0),
        dY      : (temp>n?args[n++]:0),
        ddX     : (temp>n?args[n++]:0),
        ddY     : (temp>n?args[n++]:0),
        color   : (temp>n?args[n++]:0),
        points  : args.splice(temp,args.length-temp),
        move    : function(){
            this.dX+= this.ddX;
            this.dY+= this.ddY;
            
            this.x += this.dX;
            this.y += this.dY;
            
        },
        minX    : function(){
            var min = this.x+this.points[0].x;
            for (i=1;i<this.points.length;i++)
                min = Math.min (min,this.x+this.points[i].x);
            return min;
        },
        maxX    : function(){
            var max = this.x+this.points[0].x;
            for (i=1;i<this.points.length;i++)
                max = Math.max (max,this.x+this.points[i].x);
            return max;
        },
        minY    : function(){
            var min = this.y+this.points[0].y;
            for (i=1;i<this.points.length;i++)
                min = Math.min (min,this.y+this.points[i].y);
            return min;
        },
        maxY    : function(){
            var max = this.y+this.points[0].y;
            for (i=1;i<this.points.length;i++)
                max = Math.max (max,this.y+this.points[i].y);
            return max;
        },
        checkConflictions (){
            var tObj = detectLocation (this,1);
                tObj.conflictsWith = [];
            for (var i=0;i<this.conflictsWith.length;i++){
                tObj.conflictsWith[i] = detectLocation(this.conflictsWith[i],1);
                if (tObj.maxY()>=tObj.conflictsWith[i].minY() &&
                    tObj.minY()<=tObj.conflictsWith[i].maxY()){
                    this.y = tObj.conflictsWith[i].minY()-tObj.maxY()+tObj.y;
                    this.dY = this.ddY = 0;
                }
            }
        },
        draw    : function(ctx){
            ctx.beginPath();
            ctx.moveTo(this.x+this.points[0].x,this.y+this.points[0].y);
            
            for (i=1;i<this.points.length;i++)
                ctx.lineTo(this.x+this.points[i].x,this.y+this.points[i].y);
            
            ctx.fillStyle = this.color;
            ctx.fill ();
        }
    };
}

function detectLocation (obj,nFrames){
    var args = [],
        tObj;
   
    args[args.length] = obj.x;
    args[args.length] = obj.y;
    args[args.length] = obj.dX;
    args[args.length] = obj.dY;
    args[args.length] = obj.ddX;
    args[args.length] = obj.ddY;
    args[args.length] = obj.color;
   
    for (i=0;i<obj.points.length;i++)
        args[args.length] = obj.points[i];
    
    tObj = createTangibleObject.apply(this,args);
    while (nFrames--)
        tObj.move();
    
    return tObj;
}

function compareLocations (a,b,p){
    if (Math.round(a*p)/p===Math.round(b*p)/p)
        return "same"+" "+a+" "+b;
    return "different"+" "+a+" "+b;
}