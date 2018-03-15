<?php
$file = 'chatLog.html';
$current = file_get_contents($file);
file_put_contents($file, $current."( ".$_POST["time"]." )  ".$_POST["nameThing"].":  ".$_POST["thingy"]."</br>");
echo $file;
?>