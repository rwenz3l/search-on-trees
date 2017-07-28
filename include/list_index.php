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

$files = getDirContents("../index/");
$index = array();

echo("<pre>");
foreach($files as $f) {
    $command = "tail -n 1" . " " . $f . "";
    $output = shell_exec($command);
    $fileName = basename($f);
    $index[] = "$fileName" . "$output";
}

sort($index);

foreach($index as $i => $s) {
    echo("> " . $s . PHP_EOL);
}

// echo("> ".basename($i)." | "."$output".PHP_EOL);
echo("</pre>");
?>