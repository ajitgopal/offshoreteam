<?php

$files = array ("css.css", "index.html", "js.js", "png.png");

    $info = finfo_open (FILEINFO_MIME_TYPE);

    for ($i = 0; $i < count ($files); $i ++) {
        $type = finfo_file ($info, $files[$i]);

        $files[$i] = $type;
    }

    finfo_close ($info);

    echo $files[0]; // text/x-c -> WHAT ?!
    echo $files[1]; // text/html -> Ok !
    echo $files[2]; // text/x-c++ -> WHAT ?!
    echo $files[3]; // image/png -> Ok !
	
?>	