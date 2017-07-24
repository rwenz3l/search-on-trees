<?php
header('Content-type: text/html; charset=utf-8');

function getDirContents($dir, $results = array()){
    $files = scandir($dir);

    foreach($files as $key => $value){
        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        if(!is_dir($path)) {
            $results[] = $path;
        } else if($value != "." && $value != "..") {
            getDirContents($path, $results);
            $results[] = $path;
        }
    }

    return $results;
}

$index = getDirContents("../index/", $index = array());
echo("<pre>");
foreach($index as $i) {
    $command = "tail -n 1" . " " . $i . "";
    $output = shell_exec($command);
    echo("> ".basename($i)." | "."$output".PHP_EOL);
}
echo("</pre>");
?>