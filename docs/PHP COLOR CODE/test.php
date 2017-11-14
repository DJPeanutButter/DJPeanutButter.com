<style>
div{
    display: inline-block;
    width: 100%;
    height: 100%;
    white-space: pre;
    font-family: monospace;
    word-wrap: break-word;
    word-break: break-word;
}
</style>
<div>
<?
function colorCode ($lang, $code){
    return postColorCode(preColorCode ($lang, $code));
}

function preColorCode ($lang, $code){
    $inp = $code;
    if (strtoupper($lang)===strtoupper("javascript")){
        $pos=0;
        do{
            if(($temp="function")===substr($inp,$pos,($l=strlen($temp)))){
                $open="/col=#2020a0//weight=bolder/";
                $close="\\weight\\\\col\\";
                if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                    ($inp[$pos+$l]<"0" or $inp[$pos+$l]>"z" or ($inp[$pos+$l]<"A" and $inp[$pos+$l]>"9") or ($inp[$pos+$l]>"Z" and $inp[$pos+$l]<"a"))){
                    $inp = substr_replace ($inp, $open, $pos, 0);
                    $inp = substr_replace ($inp, $close, $pos+strlen($open)+$l, 0);
                    $pos += strlen($open)+strlen($close)+$l-1;
                }
            }else if(($temp="var")===substr($inp,$pos,($l=strlen($temp)))){
                $open="/col=#2020a0//weight=bolder/";
                $close="\\weight\\\\col\\";
                if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                    ($inp[$pos+$l]<"0" or $inp[$pos+$l]>"z" or ($inp[$pos+$l]<"A" and $inp[$pos+$l]>"9") or ($inp[$pos+$l]>"Z" and $inp[$pos+$l]<"a"))){
                    $inp = substr_replace ($inp, $open, $pos, 0);
                    $inp = substr_replace ($inp, $close, $pos+strlen($open)+$l, 0);
                    $pos += strlen($open)+strlen($close)+$l-1;
                }
            }else if(($temp="document")===substr($inp,$pos,($l=strlen($temp)))){
                $open="/col=#209820//weight=900/";
                $close="\\weight\\\\col\\";
                if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                    ($inp[$pos+$l]<"0" or $inp[$pos+$l]>"z" or ($inp[$pos+$l]<"A" and $inp[$pos+$l]>"9") or ($inp[$pos+$l]>"Z" and $inp[$pos+$l]<"a"))){
                    $inp = substr_replace ($inp, $open, $pos, 0);
                    $inp = substr_replace ($inp, $close, $pos+strlen($open)+$l, 0);
                    $pos += strlen($open)+strlen($close)+$l-1;
                }
            }else if(($temp="window")===substr($inp,$pos,($l=strlen($temp)))){
                $open="/col=#209820//weight=900/";
                $close="\\weight\\\\col\\";
                if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                    ($inp[$pos+$l]<"0" or $inp[$pos+$l]>"z" or ($inp[$pos+$l]<"A" and $inp[$pos+$l]>"9") or ($inp[$pos+$l]>"Z" and $inp[$pos+$l]<"a"))){
                    $inp = substr_replace ($inp, $open, $pos, 0);
                    $inp = substr_replace ($inp, $close, $pos+strlen($open)+$l, 0);
                    $pos += strlen($open)+strlen($close)+$l-1;
                }
            }else if(($temp="body")===substr($inp,$pos,($l=strlen($temp)))){
                $open="/col=#209820//weight=900/";
                $close="\\weight\\\\col\\";
                if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                    ($inp[$pos+$l]<"0" or $inp[$pos+$l]>"z" or ($inp[$pos+$l]<"A" and $inp[$pos+$l]>"9") or ($inp[$pos+$l]>"Z" and $inp[$pos+$l]<"a"))){
                    $inp = substr_replace ($inp, $open, $pos, 0);
                    $inp = substr_replace ($inp, $close, $pos+strlen($open)+$l, 0);
                    $pos += strlen($open)+strlen($close)+$l-1;
                }
            }else if(($temp="style")===substr($inp,$pos,($l=strlen($temp)))){
                $open="/col=#209820//weight=900/";
                $close="\\weight\\\\col\\";
                if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                    ($inp[$pos+$l]<"0" or $inp[$pos+$l]>"z" or ($inp[$pos+$l]<"A" and $inp[$pos+$l]>"9") or ($inp[$pos+$l]>"Z" and $inp[$pos+$l]<"a"))){
                    $inp = substr_replace ($inp, $open, $pos, 0);
                    $inp = substr_replace ($inp, $close, $pos+strlen($open)+$l, 0);
                    $pos += strlen($open)+strlen($close)+$l-1;
                }
            }else if(($temp="value")===substr($inp,$pos,($l=strlen($temp)))){
                $open="/col=#209820//weight=900/";
                $close="\\weight\\\\col\\";
                if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                    ($inp[$pos+$l]<"0" or $inp[$pos+$l]>"z" or ($inp[$pos+$l]<"A" and $inp[$pos+$l]>"9") or ($inp[$pos+$l]>"Z" and $inp[$pos+$l]<"a"))){
                    $inp = substr_replace ($inp, $open, $pos, 0);
                    $inp = substr_replace ($inp, $close, $pos+strlen($open)+$l, 0);
                    $pos += strlen($open)+strlen($close)+$l-1;
                }
            }else if(($temp="width")===substr($inp,$pos,($l=strlen($temp)))){
                $open="/col=#209820//weight=900/";
                $close="\\weight\\\\col\\";
                if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                    ($inp[$pos+$l]<"0" or $inp[$pos+$l]>"z" or ($inp[$pos+$l]<"A" and $inp[$pos+$l]>"9") or ($inp[$pos+$l]>"Z" and $inp[$pos+$l]<"a"))){
                    $inp = substr_replace ($inp, $open, $pos, 0);
                    $inp = substr_replace ($inp, $close, $pos+strlen($open)+$l, 0);
                    $pos += strlen($open)+strlen($close)+$l-1;
                }
            }else if(($temp="height")===substr($inp,$pos,($l=strlen($temp)))){
                $open="/col=#209820//weight=900/";
                $close="\\weight\\\\col\\";
                if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
                    ($inp[$pos+$l]<"0" or $inp[$pos+$l]>"z" or ($inp[$pos+$l]<"A" and $inp[$pos+$l]>"9") or ($inp[$pos+$l]>"Z" and $inp[$pos+$l]<"a"))){
                    $inp = substr_replace ($inp, $open, $pos, 0);
                    $inp = substr_replace ($inp, $close, $pos+strlen($open)+$l, 0);
                    $pos += strlen($open)+strlen($close)+$l-1;
                }
            }else if($inp[$pos]>="0" and $inp[$pos]<="9" and ($inp[$pos-1]<'A' or $inp[$pos-1]>'z' or ($inp[$pos-1]>'Z' and $inp[$pos-1]<'a'))){
                //NUMBER
                $open="/col=#e8a727//weight=700/";
                $close="\\weight\\\\col\\";
                $inp = substr_replace ($inp, $open, $pos, 0);
                $pos += strlen($open);
                
                for (;($inp[$pos]>="0" and $inp[$pos]<="9") or ($inp[$pos]>='A' and $inp[$pos]<='Z') or ($inp[$pos]>='a' and $inp[$pos]<='z') or $inp[$pos]===".";$pos++);
                
                $inp = substr_replace ($inp, $close, $pos, 0);
                $pos += strlen($close)-1;
            }else if($inp[$pos]==="\""){
                //DOUBLE QUOTE
                $open="/col=#c83737//weight=700/";
                $close="\\weight\\\\col\\";
                $inp = substr_replace ($inp, $open, $pos, 0);
                $pos += strlen($open)+1;
                
                for (;$inp[$pos]!=="\"";$pos++);
                
                $inp = substr_replace ($inp, $close, ++$pos, 0);
                $pos += strlen($close)-1;
            }else if($inp[$pos]==="'"){
                //SINGLE QUOTE
                $open="/col=#c83737//weight=700/";
                $close="\\weight\\\\col\\";
                $inp = substr_replace ($inp, $open, $pos, 0);
                $pos += strlen($open)+1;
                
                for (;$inp[$pos]!=="'";$pos++);
                
                $inp = substr_replace ($inp, $close, ++$pos, 0);
                $pos += strlen($close)-1;
            }else if(($inp[$pos]<'A' or $inp[$pos]>'z' or ($inp[$pos]>'Z' and $inp[$pos]<'a')) and ($inp[$pos]>"9" or $inp[$pos]<"0") and !($inp[$pos]==="\"" or $inp[$pos]==="\'") and $inp[$pos]>" "){
                //OPERATOR
                $open="/col=#982798//weight=900/";
                $close="\\weight\\\\col\\";
                $inp = substr_replace ($inp, $open, $pos, 0);
                $pos += strlen($open);
                
                for (;($inp[$pos]<'A' or $inp[$pos]>'z' or ($inp[$pos]>'Z' and $inp[$pos]<'a')) and ($inp[$pos]>"9" or $inp[$pos]<"0") and !($inp[$pos]==="\"" or $inp[$pos]==="'") and!($inp[$pos]==="\r") and $pos<strlen($inp);$pos++);
                
                $inp = substr_replace ($inp, $close, $pos, 0);
                $pos += strlen($close)-1;
            }
            $pos++;
        }while($pos<strlen ($inp) and $pos!==false);
    }
    return $inp;
}

function postColorCode ($code){
    $inp = htmlentities($code);
    
    $start=0;
    do{
        $pos = strpos ($inp, $tempI="/col=", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "<span style=\"color: ", $pos, strlen($tempI));
            while ($inp[$pos]!=="/")
                $start = ($pos+=1);
            $inp =substr_replace($inp, $tempO=";\">", $pos, 1);
            $pos+=strlen($tempO);
        }
    }while ($pos!==false);
    
    $start=0;
    do{
        $pos = strpos ($inp, $tempI="\\col\\", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, $tempO="</span>", $pos, strlen($tempI));
            $start += strlen($tempO);
        }
    }while ($pos!==false);
    
    $start=0;
    do{
        $pos = strpos ($inp, $tempI="/weight=", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, "<span style=\"font-weight: ", $pos, strlen($tempI));
            while ($inp[$pos]!=="/")
                $start = ($pos+=1);
            $inp =substr_replace($inp, $tempO=";\">", $pos, 1);
            $pos+=strlen($tempO);
        }
    }while ($pos!==false);
    
    $start=0;
    do{
        $pos = strpos ($inp, $tempI="\\weight\\", $start);
        if ($pos!==false){
            $inp = substr_replace ($inp, $tempO="</span>", $pos, strlen($tempI));
            $start += strlen($tempO);
        }
    }while ($pos!==false);
    return $inp;
}

$menuFile = fopen($path="../../games\decode.js", "r") or die("Unable to load menu!");
$test = fread($menuFile,filesize($path));
fclose($menuFile);

echo colorCode("JavaScript",$test);
?>
</div>