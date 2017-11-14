window.onload=function(){
    imageLoader = document.createElement ("input");
    imageLoader.type = "file";
    imageLoader.addEventListener ('change',handleImage,false);
    document.body.appendChild (imageLoader);
};

function handleImage (e){
    alert (this.value);
}