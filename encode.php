<html>
    <head>
        <title>Still in Testing!</title>
    </head>
    <body>
        <?
            $path = $_POST["file"];
            $inpf = fopen($path, "r") or die("Unable to load code!");
            $inp = fread($inpf,filesize($path));
            fclose($inpf);
            echo htmlspecialchars($inp);
        ?>
    </body>
</html>