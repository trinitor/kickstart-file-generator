<?php
echo "<html>
<body>
<h1>Kickstart File Generator</h1>";

echo "<a href=data.csv>data.csv</a><br><br>";
$data_file = fopen('data.csv', 'r');
echo "<table border=1>";
while (($line = fgetcsv($data_file, 0, ";")) !== FALSE) {
  $hostname = htmlspecialchars($line[0]);
  $ip       = htmlspecialchars($line[1]);
  $netmask  = htmlspecialchars($line[2]);
  $gateway  = htmlspecialchars($line[3]);
  $dns      = htmlspecialchars($line[4]);
  $template = htmlspecialchars($line[5]);
  if ($template == "") { $template = "centos-template (default)"; }

  echo "<tr><td>$hostname</td><td>$ip</td><td>$netmask</td><td>$gateway</td><td>$dns</td><td>$template</td></tr>";
}
echo "</table><br><br>";
fclose($data_file);

echo "Upload a new data file:<br>
<form action=upload/upload.php method=post
enctype=multipart/form-data>
<input type=file name=file id=file><br>
<input type=submit name=submit value=Submit>
</form>";

echo "</body>
</html>";
?>

