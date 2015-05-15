<?php
$input_hostname = htmlspecialchars($_GET["hostname"]);

$data_file = fopen('data.csv', 'r');
while (($line = fgetcsv($data_file, 0, ";")) !== FALSE) {
  $hostname = htmlspecialchars($line[0]);
  $ip       = htmlspecialchars($line[1]);
  $netmask  = htmlspecialchars($line[2]);
  $gateway  = htmlspecialchars($line[3]);
  $dns      = htmlspecialchars($line[4]);

  if ($input_hostname == $hostname) {
    $kickstart_template = file_get_contents('centos-template.cfg');

    $kickstart_template = str_replace('%HOSTNAME%', $hostname, $kickstart_template);
    $kickstart_template = str_replace('%IPADDR%', $ip, $kickstart_template);
    $kickstart_template = str_replace('%NETMASK%', $netmask, $kickstart_template);
    $kickstart_template = str_replace('%GATEWAY%', $gateway, $kickstart_template);
    $kickstart_template = str_replace('%DNS%', $dns, $kickstart_template);

    #echo nl2br($kickstart_template);
    echo $kickstart_template;
  }
}

fclose($data_file);
?>

