<?
function createMenuFromFileLS ($path){
    $inpf = fopen($path, "r") or die("Unable to load code!");
	$inp = fread($inpf,filesize($path));
	fclose($inpf);
    
    $out = "";
    $pos = 0;
    $start = 0;
    
    do {
        $pos = strpos ($inp, "[", $start);
        if($pos!==false){
            $pos = strpos ($inp, "]", ($start=$pos+1));
            if ($pos!==false){
                $disp = substr ($inp, $start, $pos-$start);
                $pos = strpos ($inp, "\"", $pos+1);
                if ($pos!==false){
                    $pos = strpos ($inp, "\"", ($start=$pos+1));
                    if ($pos!==false){
                        $link = substr($inp, $start, $pos-$start);
                        if ($link!=="NULL")
                            $out .= "<a href=\"" . $link . "\"><div class=\"col-10\">" . $disp . "</div></a>";
                        else{
                            $out .= "<a href=\"\" class=\"current\"><div class=\"col-10\">" . $disp . "</div></a><div class=\"col-10\">";
                            $i = 1;
                            do{
                                $pos2 = strpos ($inp, "{", $start);
                                if($pos2!==false){
                                    $pos2 = strpos ($inp, "}", ($start=$pos2+1));
                                    if ($pos2!==false){
                                        $disp = substr ($inp, $start, $pos2-$start);
                                        $pos2 = strpos ($inp, "\"", $pos2+1);
                                        if ($pos2!==false){
                                            $pos2 = strpos ($inp, "\"", ($start=$pos2+1));
                                            if ($pos2!==false){
                                                $link = substr($inp, $start, $pos2-$start);
                                                if ($link!=="NULL")
                                                    $out .= "<a href=\"" . $link . "\"><div class=\"col-10\">" . $i . ". " . $disp . "</div></a>";
                                                else{
                                                    $out .= "<a href=\"\" class=\"current\"><div class=\"col-10\">" . $i . ". " . $disp . "</div></a><div class=\"col-10\">";
                                                    $i = 'a';
                                                    do{
                                                        $pos3 = strpos ($inp, "(", $start);
                                                        if ($pos3!==false){
                                                            $pos3 = strpos ($inp, ")", ($start=$pos3+1));
                                                            if ($pos3!==false){
                                                                $disp = substr ($inp, $start, $pos3-$start);
                                                                $pos3 = strpos ($inp, "\"", $pos3+1);
                                                                if ($pos3!==false){
                                                                    $pos3 = strpos ($inp, "\"", ($start=$pos3+1));
                                                                    if ($pos3!==false){
                                                                        $link = substr($inp, $start, $pos3-$start);
                                                                        if ($link!=="NULL")
                                                                            $out .= "<a href=\"" . $link . "\"><div class=\"col-10\">" . $i . ") " . $disp . "</div></a>";
                                                                        else
                                                                            $out .= "<a href=\"\" class=\"current\"><div class=\"col-10\">" . $disp . "</div></a>";
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        $i++;
                                                        $nextParen   = strpos ($inp, "(", $start);
                                                        $nextCurly   = strpos ($inp, "{", $start);
                                                        $nextBracket = strpos ($inp, "[", $start);
                                                    }while($nextParen!==false && (($nextCurly===false || ($nextParen<$nextCurly)) && ($nextBracket===false || ($nextParen<$nextBracket))));
                                                    $out .= "</div>";
                                                }
                                            }
                                        }
                                    }
                                }
                                $i++;
                            }while($pos2<=strpos ($inp, "[", $start) and $pos2!==false);
                            $out .= "</div>";
                        }
                    }
                }
            }
        }
    }while ($pos<=strlen ($inp) and $pos!==false);
    
    return $out;
}

function createContentPageFromFileLS ($path){
    $inpf = fopen($path, "r") or die("Unable to load code!");
	$inp = fread($inpf,filesize($path));
	fclose($inpf);
    $page           = "PAGE TITLE";
    $menu           = "menu.html";
    $title          = "TITLE";
    $backText       = "";
    $backAddress    = "back.xxx";
    $contentPath    = "content.lsf";
    $nextText       = "";
    $nextAddress    = "next.xxx";
    $prevText       = "";
    $prevAddress    = "prev.xxx";
    
    $pos = strpos ($inp, " Page");
    if ($pos!==false){
        $pos = strpos ($inp, "\"", $pos);
        if ($pos!==false){
            $start = $pos+1;
            $pos = strpos ($inp, "\"", $start);
            if ($pos!==false)
                $page = substr($inp, $start, $pos-$start);
        }
    }
    
    $pos = strpos ($inp, " Menu");
    if ($pos!==false){
        $pos = strpos ($inp, "\"", $pos);
        if ($pos!==false){
            $start = $pos+1;
            $pos = strpos ($inp, "\"", $start);
            if ($pos!==false)
                $menu = substr($inp, $start, $pos-$start);
        }
    }
    
    $pos = strpos ($inp, " Main");
    if ($pos!==false){
        $pos = strpos ($inp, "\"", $pos);
        if ($pos!==false){
            $start = $pos+1;
            $pos = strpos ($inp, "\"", $start);
            if ($pos!==false){
                $title = substr($inp, $start, $pos-$start);
                $pos = strpos ($inp, "\"", $pos+1);
                if ($pos!==false){
                    $start = $pos+1;
                    $pos = strpos ($inp, "\"", $start);
                    if ($pos!==false)
                        $contentPath = substr ($inp, $start, $pos-$start);
                }
            }
        }
    }
    
    $pos = strpos ($inp, " Back");
    if ($pos!==false){
        $pos = strpos ($inp, "\"", $pos);
        if ($pos!==false){
            $start = $pos+1;
            $pos = strpos ($inp, "\"", $start);
            if ($pos!==false){
                $backText = substr($inp, $start, $pos-$start);
                $pos = strpos ($inp, "\"", $pos+1);
                if ($pos!==false){
                    $start = $pos+1;
                    $pos = strpos ($inp, "\"", $start);
                    if ($pos!==false)
                        $backAddress = substr($inp, $start, $pos-$start);
                }
            }
        }
    }
    
    $pos = strpos ($inp, " Next");
    if ($pos!==false){
        $pos = strpos ($inp, "\"", $pos);
        if ($pos!==false){
            $start = $pos+1;
            $pos = strpos ($inp, "\"", $start);
            if ($pos!==false){
                $nextText = substr($inp, $start, $pos-$start);
                $pos = strpos ($inp, "\"", $pos+1);
                if ($pos!==false){
                    $start = $pos+1;
                    $pos = strpos ($inp, "\"", $start);
                    if ($pos!==false)
                        $nextAddress = substr($inp, $start, $pos-$start);
                }
            }
        }
    }
    
    $pos = strpos ($inp, " Prev");
    if ($pos!==false){
        $pos = strpos ($inp, "\"", $pos);
        if ($pos!==false){
            $start = $pos+1;
            $pos = strpos ($inp, "\"", $start);
            if ($pos!==false){
                $prevText = substr($inp, $start, $pos-$start);
                $pos = strpos ($inp, "\"", $pos+1);
                if ($pos!==false){
                    $start = $pos+1;
                    $pos = strpos ($inp, "\"", $start);
                    if ($pos!==false)
                        $prevAddress = substr($inp, $start, $pos-$start);
                }
            }
        }
    }
    
    return createContentPageLS ($page, $menu, $title, $contentPath, $backText, $backAddress, $nextText, $nextAddress, $prevText, $prevAddress);
}
function createContentPageLS ($page, $menuPath, $title, $contentPath, $backText="", $backAddress="", $nextText="", $nextAddress="", $prevText="", $prevAddress=""){
    $inpf = fopen($menuPath, "r") or die("Unable to load menu!");
	$menu = fread($inpf,filesize($menuPath));
	fclose($inpf);
    
    $out = "<html><head><title>" . $page . "</title><link rel=\"stylesheet\" type=\"text/css\" href=\"http://www.djpeanutbutter.com/layout-styles.css\"><link rel=\"stylesheet\" type=\"text/css\" href=\"http://www.djpeanutbutter.com/docs/code.css\"><meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\"><meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\"></head><body><div class=\"col-12 gray\"></div><div class=\"menu\">" . $menu . "</div><div class=\"col-10 white\">";
    $out .= "<div class=\"col-12 white\">&nbsp;</div><div class=\"col-12 white\">" . $title . "</div><div class=\"col-12 white\">&nbsp;</div><div class=\"col-12\">";
    if(strlen($backText)>0)
        $out .= "<a href=\"" . $backAddress . "\"><div class=\"col-10\">" . $backText . "</div></a>";
    $out .= readFileLS ($contentPath);
    if(strlen($nextText)>0)
        $out .= "<a href=\"" . $nextAddress . "\"><div class=\"col-10\">" . $nextText . "</div></a>";
    if(strlen($prevText)>0){
        $out .= "<a href=\"" . $prevAddress . "\"><div class=\"col-10\">" . $prevText . "</div></a>";
    }
    $out .= "</div></div></body></html>";
    return $out;
}

function readFileLS ($path){
    $inpf = fopen($path, "r") or die("Unable to load code!");
	$inp = fread($inpf,filesize($path));
	fclose($inpf);
    
    $start = 0;
    $pos = 0;
    
    $out = "";
    
    do{
        $pos = strpos ($inp, "[code]", $start);
        
        if ($pos===false){
            $out .= "<div class=\"col-12\">" . formatContentBetaLS(substr($inp,$start)) . "</div>";
            break;
        }
        
        $out .= "<div class=\"col-12\">" . formatContentBetaLS(substr($inp, $start, $pos-$start)) . "</div>";
        $pos+=6;
        
        $start = strpos($inp, "[/code]",$pos);
        
        if ($start===false)
            break;
        
        $out .= "<pre><div class=\"col-12 white\">" . formatCodeBetaLS(substr ($inp, $pos, ($start+7)-($pos+7))) . "</div></pre>";
        $start+=7;
    }while($start!==false);
    
    return $out;
}

function formatContentBetaLS ($inp){
    $inp = htmlentities ($inp);
    
    $start = 0;
    
    while (($start=strpos($inp, "/menu=&quot;", $start))!==false){
        $pos = strpos ($inp, "&quot;/", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, createMenuFromFileLS (substr($inp, $start+12, $pos-$start-12)), $start, $pos-$start+19);
        }
    }
    
    $start = 0;
    
    do{
        $pos = strpos($inp, "/lf/", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "<br>", $pos, 4);
            $start += 4;
            }
    }while($pos!==false);
    
    $start = 0;
    
    do{
        $pos = strpos ($inp, "/b/", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "<span class=\"type\">", $pos, 3);
            $start += 19;
        }
    }while($pos!==false);
    
    $start = 0;
    
    do{
        $pos = strpos ($inp, "/i/", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "<span class=\"name\">", $pos, 3);
            $start += 19;
        }
    }while ($pos!==false);
    
    $start = 0;
    
    do{
        $pos = strpos ($inp, "/l=&quot;", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "<a href=\"", $pos, 9);
            $start += 9;
            $pos = strpos ($inp, "&quot;/", $start);
            if ($pos!==false){
                $inp = substr_replace ($inp, "\">", $pos, 7);
                $start += 2;
            }
        }
    }while ($pos!==false);

    $start = 0;

    do{
        $pos = strpos ($inp, "\\b\\", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "</span>", $pos, 3);
            $start += 7;
        }
    }while ($pos!==false);

    $start = 0;

    do{
        $pos = strpos ($inp, "\\i\\", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "</span>", $pos, 3);
            $start += 7;
        }
    }while ($pos!==false);
    
    $start = 0;
    
    do{
        $pos = strpos ($inp, "\\l\\", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "</a>", $pos, 3);
            $start += 4;
        }
    }while ($pos!==false);
    
    return $inp; 
}
function formatCodeBetaLS ($inp){
    /*
    TODO:   Create escape characters for \ and /
    */
    $pos=0;
    do{
        if ($inp[$pos]==="#"){
            if ($pos===0 or $inp[$pos-1]<" "){
                $inp = substr_replace ($inp, "/inc/", $pos, 0);
                
                for(;$inp[$pos]!=="\n" and $pos<=strlen($inp);$pos++);
                
                $inp = substr_replace ($inp, "\\inc\\", $pos-1, 0);
            }
            $pos+=3;
        }else if($inp[$pos]==="/" and $inp[$pos+1]==="/"){
            $inp = substr_replace ($inp, "/inc/", $pos, 0);
            for (;$inp[$pos]!=="\n";$pos++);
            $inp = substr_replace ($inp, "\\inc\\", $pos-1, 0);
            $pos+=3;
        }else if($inp[$pos]==="/" and $inp[$pos+1]==="*"){
            $inp = substr_replace ($inp, "/inc/", $pos, 0);
            for (;!($inp[$pos]==="/" and $inp[$pos-1]==="*") and $pos<strlen($inp);$pos++);
            $inp = substr_replace ($inp, "\\inc\\", $pos+1, 0);
            $pos+=5;
        }else if(($inp[$pos]<'A' or $inp[$pos]>'z' or ($inp[$pos]>'Z' and $inp[$pos]<'a')) and ($inp[$pos]>"9" or $inp[$pos]<"0") and !($inp[$pos]==="\"" or $inp[$pos]==="\'") and $inp[$pos]>" "){
            $inp = substr_replace ($inp, "/op/", $pos, 0);
            $pos += 4;
            
            for (;($inp[$pos]<'A' or $inp[$pos]>'z' or ($inp[$pos]>'Z' and $inp[$pos]<'a')) and ($inp[$pos]>"9" or $inp[$pos]<"0") and !($inp[$pos]==="\"" or $inp[$pos]==="\'") and!($inp[$pos]==="\r") and $pos<strlen($inp);$pos++);
            
            $inp = substr_replace ($inp, "\\op\\", $pos, 0);
            $pos += 3;
        }else if($inp[$pos]>="0" and $inp[$pos]<="9" and ($inp[$pos-1]<'A' or $inp[$pos-1]>'z' or ($inp[$pos-1]>'Z' and $inp[$pos-1]<'a'))){
            $inp = substr_replace ($inp, "/n/", $pos, 0);
            $pos += 3;
            
            for (;($inp[$pos]>="0" and $inp[$pos]<="9") or ($inp[$pos]>='A' and $inp[$pos]<='Z') or ($inp[$pos]>='a' and $inp[$pos]<='z') or $inp[$pos]===".";$pos++);
            
            $inp = substr_replace ($inp, "\\n\\", $pos, 0);
            $pos += 2;
        }else if($inp[$pos]==="\""){
            $inp = substr_replace ($inp, "/qq/", $pos, 0);
            $pos += 5;
            
            for (;$inp[$pos]!=="\"";$pos++);
            
            $inp = substr_replace ($inp, "\\qq\\", ++$pos, 0);
            $pos += 3;
        }else if(substr($inp,$pos,($x=3))==="int"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=6))==="return"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=4))==="bool"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=4))==="void"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=3))==="for"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=2))==="do"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=5))==="while"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=2))==="if"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=5))==="break"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=6))==="struct"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=5))==="float"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=4))==="char"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=3))==="not"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=2))==="or"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=3))==="and"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=4))==="else"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=4))==="case"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=4))==="null"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=7))==="default"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(substr($inp,$pos,($x=4))==="NULL"){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(($temp="false")===substr($inp,$pos,($x=strlen($temp)))){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }else if(($temp="true")===substr($inp,$pos,($x=strlen($temp)))){
            if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
                $inp = substr_replace ($inp, "/t/", $pos, 0);
                $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
                $pos += 5+$x;
            }
        }
        $pos++;
    }while ($pos<strlen ($inp) and $pos!==false);

    $inp = htmlentities ($inp);

    $start = 0;

    do{
        $pos = strpos ($inp, "/inc/", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "<span class=\"include\">", $pos, 5);
            $start += 22;
        }
    }while($pos!==false);

    $start = 0;

    do{
        $pos = strpos ($inp, "\\inc\\", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "</span>", $pos, 5);
            $start += 7;
        }
    }while ($pos!==false);

    $start = 0;

    do{
        $pos = strpos ($inp, "/op/", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "<span class=\"operator\">", $pos, 4);
            $start += 23;
        }
    }while ($pos!==false);

    $start = 0;

    do{
        $pos = strpos ($inp, "\\op\\", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "</span>", $pos, 4);
            $start += 7;
        }
    }while ($pos!==false);

    $start = 0;

    do{
        $pos = strpos ($inp, "/qq/", $start);
        if ($pos!==false){
            $inp = substr_replacE ($inp, "<span class=\"quote\">", $pos, 4);
            $start += 20;
        }
    }while ($pos!==false);

    $start = 0;

    do{
        $pos = strpos ($inp, "\\qq\\", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "</span>", $pos, 4);
            $start += 7;
        }
    }while ($pos!==false);

    $start = 0;

    do{
        $pos = strpos ($inp, "/t/", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "<span class=\"type\">", $pos, 3);
            $start += 19;
        }
    }while ($pos!==false);

    $start = 0;

    do{
        $pos = strpos ($inp, "\\t\\", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "</span>", $pos, 3);
            $start += 7;
        }
    }while ($pos!==false);

    $start = 0;

    do{
        $pos = strpos ($inp, "/n/", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "<span class=\"number\">", $pos, 3);
            $start += 21;
        }
    }while ($pos!==false);

    $start = 0;

    do{
        $pos = strpos ($inp, "\\n\\", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "</span>", $pos, 3);
            $start += 7;
        }
    }while ($pos!==false);
    
    return $inp;
}
?>