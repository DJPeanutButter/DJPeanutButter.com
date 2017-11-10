var hEditor = 600,
    wEditor = 800,

    tEditor = document.createElement ("textarea");
    bRun    = document.createElement ("button");

window.onload = function(){
    tEditor.style.width = wEditor;
    tEditor.style.height= hEditor;
    
    bRun.appendChild (document.createTextNode ("Run"));
    bRun.onclick = function(){
        eval (tEditor.value);
    }
    
    document.body.appendChild (tEditor);
    document.body.appendChild (bRun);
}