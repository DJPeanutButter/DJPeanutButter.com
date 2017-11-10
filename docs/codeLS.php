<?
//TODO comment the hell out of this file
function createMenuFromFileLS ($path){
  $inpf = fopen($path, "r") or die("Unable to load code!");
	$inp = fread($inpf,filesize($path));
	fclose($inpf);
    
  $out = "";
  $pos = 0;
  $start = 0;
    
  do{
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
  
  if(strlen($prevText)>0)
    $out .= "<a href=\"" . $prevAddress . "\"><div class=\"col-10\">" . $prevText . "</div></a>";
  
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
    if ($pos!==false)
      $inp = substr_replace ($inp, createMenuFromFileLS (substr($inp, $start+12, $pos-$start-12)), $start, $pos-$start+19);
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

function replaceKeywordLS ($keyword,&$inp,&$pos){
  if($keyword===substr($inp,$pos,($x=strlen($keyword)))){
    if (($inp[$pos-1] <"0" or $inp[$pos-1] >"z" or ($inp[$pos-1] <"A" and $inp[$pos-1] >"9") or ($inp[$pos-1] >"Z" and $inp[$pos-1] <"a")) and
       ($inp[$pos+$x]<"0" or $inp[$pos+$x]>"z" or ($inp[$pos+$x]<"A" and $inp[$pos+$x]>"9") or ($inp[$pos+$x]>"Z" and $inp[$pos+$x]<"a"))){
         
      $inp = substr_replace ($inp, "/t/", $pos, 0);
      $inp = substr_replace ($inp, "\\t\\", $pos+3+$x, 0);
      $pos += 5+$x;
    }
    return true;
  }
  return false;
}

function replaceTagsLS ($TML,$HTML,&$inp){
  $start = 0;
  
  do{
    $pos = strpos ($inp, $TML, $start);
    if ($pos!==false){
      $inp = substr_replace ($inp, $HTML, $pos, strlen($TML));
      $start += strlen($HTML);
    }
  }while($pos!==false);
}

function formatCodeBetaLS ($inp){
  /*
   * This function is going to go through $inp twice. On
   * the first pass, we will be looking for keywords and
   * characters that we want to highlight on the page (things
   * like int, char, true, false, etc...) and we'll use
   * Temporary Markup tags to indicate where and how we'll
   * be highlighting the code. We have to be careful that
   * these Temporary Markup tags don't have any HTML special
   * characters, because we're using them to get through a
   * function designed to remove HTML special characters.
   * After the first pass we'll clean the code up to make
   * sure there aren't any HTML characters that could affect
   * the display of the web page or even take control away
   * from it completely. After removing any unwanted HTML
   * characters, we'll replace our Temporary Markup tags
   * with our desired HTML tags so that we can have
   * highlighted code.
   *
   * TODO:   Create escape characters for \ and /
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
      
      for (;$pos<strlen($inp) and ($inp[$pos]<'A' or $inp[$pos]>'z' or ($inp[$pos]>'Z' and $inp[$pos]<'a')) and ($inp[$pos]>"9" or $inp[$pos]<"0") and !($inp[$pos]==="\"" or $inp[$pos]==="\'") and!($inp[$pos]==="\r");$pos++);
      
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
    }else
    /*
     * This huge set of nested if statements used to be a
     * bunch of if-then-else's that had a similar block of
     * code in each if statement. I couldn't figure out a
     * nicer way to put the ifs after making it one function
     * so I'm sticking with this for now. The reason they're
     * nested is to keep with the if-then-else functionality
     * so that we don't run through all the keywords if one
     * has already been found.
     */
    if (! replaceKeywordLS ("int",$inp,$pos))
    if (! replaceKeywordLS ("return",$inp,$pos))
    if (! replaceKeywordLS ("bool",$inp,$pos))
    if (! replaceKeywordLS ("void",$inp,$pos))
    if (! replaceKeywordLS ("for",$inp,$pos))
    if (! replaceKeywordLS ("do",$inp,$pos))
    if (! replaceKeywordLS ("while",$inp,$pos))
    if (! replaceKeywordLS ("if",$inp,$pos))
    if (! replaceKeywordLS ("break",$inp,$pos))
    if (! replaceKeywordLS ("struct",$inp,$pos))
    if (! replaceKeywordLS ("float",$inp,$pos))
    if (! replaceKeywordLS ("char",$inp,$pos))
    if (! replaceKeywordLS ("not",$inp,$pos))
    if (! replaceKeywordLS ("or",$inp,$pos))
    if (! replaceKeywordLS ("and",$inp,$pos))
    if (! replaceKeywordLS ("else",$inp,$pos))
    if (! replaceKeywordLS ("case",$inp,$pos))
    if (! replaceKeywordLS ("null",$inp,$pos))
    if (! replaceKeywordLS ("default",$inp,$pos))
    if (! replaceKeywordLS ("NULL",$inp,$pos))
    if (! replaceKeywordLS ("false",$inp,$pos))
          replaceKeywordLS ("true",$inp,$pos);
    $pos++;
  }while ($pos<strlen ($inp) and $pos!==false);
  
  //Clean up the code to get rid of any HTML characters
  $inp = htmlentities ($inp);
  
  //Replace the Temporary Markup tags with HTML tags
  replaceTagsLS ("/inc/",   "<span class=\"include\">",   $inp);
  replaceTagsLS ("\\inc\\", "</span>",                    $inp);
  replaceTagsLS ("/op/",    "<span class=\"operator\">",  $inp);
  replaceTagsLS ("\\op\\",  "</span>",                    $inp);
  replaceTagsLS ("/qq/",    "<span class=\"quote\">",     $inp);
  replaceTagsLS ("\\qq\\",  "</span>",                    $inp);
  replaceTagsLS ("/t/",     "<span class=\"type\">",      $inp);
  replaceTagsLS ("\\t\\",   "</span>",                    $inp);
  replaceTagsLS ("/n/",     "<span class=\"number\">",    $inp);
  replaceTagsLS ("\\n\\",   "</span>",                    $inp);
  
  return $inp;
}
?>