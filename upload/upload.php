<?php
if ($_FILES["file"]["name"] = "data.csv")
  {
    echo "Filename correct <br>";
    echo "upload started";
    move_uploaded_file($_FILES["file"]["tmp_name"], "../data.csv");
  }
else
  {
  echo "Invalid filename. Must be data.csv";
  }

echo "<br><br><a href=../>Go back</a>";
?>
