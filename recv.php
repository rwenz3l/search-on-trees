<?php
/* Debug
print_r($_POST);
print_r($_FILES);
*/
if( isset($_FILES['logfile']) && isset($_POST['sub']) )
{
  $uploaddir = "index/" . $_POST['sub'] . "/";
  if ( ! file_exists($uploaddir) ) {
    mkdir($uploaddir, 0777, true);
  }
  $uploadfile = $uploaddir . basename( $_FILES['logfile']['name']);
  if ( file_exists($uploadfile) ) {
    echo("Delete old file..");
    unlink($uploadfile);
  }
  if(move_uploaded_file($_FILES['logfile']['tmp_name'], $uploadfile))
  {
    echo "The file has been added to the index";
  }
  else
  {
    echo "There was an error!";
    print_r($_FILES);
  }
}
?>