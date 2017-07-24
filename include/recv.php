<?php
/* Check for $_FILES => logfiile and $_POST => sub content */
if( isset($_FILES['logfile']) && isset($_POST['sub']) )
{
  /* Init Upload-Dir, Create if not exists */
  $uploaddir = "index/" . $_POST['sub'] . "/";
  if ( ! file_exists($uploaddir) ) {
    mkdir($uploaddir, 0777, true);
  }

  /* Init Upload-File, delete if version exists */
  $uploadfile = $uploaddir . basename( $_FILES['logfile']['name']);
  if ( file_exists($uploadfile) ) {
    echo("Delete old file..");
    unlink($uploadfile);
  }

  /* Save Recieved File */
  if(move_uploaded_file($_FILES['logfile']['tmp_name'], $uploadfile)) {
    echo("The file has been added to the index" . PHP_EOL);
  } else {
    echo("There was an error!");
    print_r($_FILES);
  }
}
?>