var hWindow=300,
    wWindow=1300,
    nodeCount=3,
    imageLoader,
    uploadedData = "",
    myGameArea = {
        submit  : document.createElement("button"),
        input   : document.createElement("textarea"),
        canvas  : document.createElement("canvas"),
        start   : function(){
            imageLoader = document.createElement ("input");
            imageLoader.type = "file";
            imageLoader.addEventListener ('change',handleImage,false);
            this.submit.appendChild(document.createTextNode("Create Image"));
            this.submit.onclick = function(){
                myGameArea.draw(uploadedData);
            };
            this.canvas.width   = this.input.style.width    = wWindow;
            this.canvas.height  = (this.input.style.height   = hWindow)/10;
            
            this.context = this.canvas.getContext("2d");
            if(document.body.childNodes.length===nodeCount){
                document.body.appendChild(document.createElement("br"));
                document.body.appendChild(imageLoader);
                document.body.appendChild(document.createElement("br"));
                document.body.appendChild(this.submit);
                document.body.appendChild(document.createElement("br"));
                document.body.appendChild(this.input);
                document.body.appendChild(this.canvas);
            }
        },
        clear   : function(){
            this.context.clearRect(0,0,this.canvas.width,this.canvas.height);
        },
        draw    : function (str){
            var tr = "a";
            var ta;
            this.clear();
            var arrColors = turnIntoColors (str);
            this.canvas.width = arrColors.length;
            console.log (arrColors);
            for (var i=0;i<arrColors.length;i++){
                this.context.fillStyle = "#"+arrColors[i];
                this.context.fillRect (i,0,1,hWindow);
            }
            console.log (arrColors);
        }
    };

window.onload=function(){
    myGameArea.start();
};

function turnIntoHex (str){
    var rs = "";
    for (var i=0;i<str.length;i++)
        rs += ("000"+str.charCodeAt(i).toString(16)).substr(-4);
    return rs;
}

function turnIntoStr (str){
    if (str.length%4!=0)
        return "ERROR!";
    var rs = "";
    for (var i=0;i<str.length;i+=4)
        rs += String.fromCharCode (Number.parseInt (str[i]+str[i+1]+str[i+2]+str[i+3],16));
    return rs;
}

function turnIntoColors (str){
    var rs = [];
    var ind=0;
    for (var i=0;i<str.length;i+=3){
        rs[ind++] = turnIntoHex (str[i])+(i+1<str.length?turnIntoHex(str[i+1]).substr(0,2):"00");
        if (i+1<str.length)
            rs[ind++] = turnIntoHex (str[i+1]).substr(2)+(i+2<str.length?turnIntoHex(str[i+2]):"0000");
    }
    return rs;
}

function colorsToStr (arr){
    var rs = "";
    for (var i=0;i<arr.length;i+=2)
        rs += turnIntoStr(arr[i]+arr[i+1]);
    return rs;
}

function imgDataToColors (id){
    var rA = [];
    rA [0] = ("000"+id[0].toString(16)).substr(-4)+("000"+id[1].toString(16)).substr(-4).substr(0,2);
    rA [1] = ("0"+id[1].toString(16)).substr(-2)+("000"+id[2].toString(16)).substr(-4);
    return rA;
}

function handleImage (e){
    var tFR = new FileReader();
    tFR.onload = function(evt){
        uploadedData = evt.target.result;
    }
    tFR.readAsBinaryString(e.target.files[0]);
}