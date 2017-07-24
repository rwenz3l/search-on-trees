<?php
header('Content-type: text/html; charset=utf-8');

function getDirContents($path) {
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));

    $files = array(); 
    foreach ($rii as $file)
        if (!$file->isDir())
            $files[] = $file->getPathname();

    return $files;
}

$index = getDirContents("../index/");
echo("<pre>");
foreach($index as $i) {
    $command = "tail -n 1" . " " . $i . "";
    $output = shell_exec($command);
    echo("> ".basename($i)." | "."$output".PHP_EOL);
}
echo("</pre>");
?>