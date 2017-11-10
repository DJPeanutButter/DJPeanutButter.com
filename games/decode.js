var imageLoader,
    canvas,
    ctx,
    checkButton,
    retString = "",
    retTextarea;

window.onload = function (){
    imageLoader = document.createElement ("input");
    imageLoader.type = "file";
    imageLoader.addEventListener ('change',handleImage,false);
    
    canvas = document.createElement ("canvas");
    ctx = canvas.getContext ('2d');
    
    checkButton = document.createElement("button");
    checkButton.appendChild (document.createTextNode ("Decode"));
    checkButton.onclick = function (){
        var imgData = [];
        for (var i=0;i<canvas.width;i+=2){
            imgData[0] = ctx.getImageData(i,0,1,1).data;
            imgData[1] = ctx.getImageData(i+1,0,1,1).data;
            console.log(imgData[0]);
            console.log(imgData[1]);
            console.log (imgDatasToColors(imgData));
            console.log (colorsToStr (imgDatasToColors (imgData)));
            retString += colorsToStr (imgDatasToColors (imgData));
        }
        retTextArea = document.createElement ("textarea");
        retTextArea.style.width     = 1200;
        retTextArea.style.height    = 800;
        retTextArea.style.overflow  = "scroll";
        retTextArea.appendChild (document.createTextNode (retString));
        document.body.appendChild (document.createElement("br"));
        document.body.appendChild (retTextArea);
    }
    document.body.appendChild (imageLoader);
    document.body.appendChild (document.createElement ("br"));
    document.body.appendChild (canvas);
    document.body.appendChild (document.createElement ("br"));
    document.body.appendChild (checkButton);
}

function handleImage (e){
    var reader = new FileReader();
    reader.onload = function (evt){
        var img = new Image();
        img.onload = function(){
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img,0,0);
        }
        img.src = evt.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);
}

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

function imgDatasToColors (id){
    var rA = [];
    for (var i=0;i<id.length;i++)
        rA[i] = ("0"+id[i][0].toString(16)).substr(-2)+("0"+id[i][1].toString(16)).substr(-2)+("0"+id[i][2].toString(16)).substr(-2);
    return rA;
}