<?php
$input_hostname = htmlspecialchars($_GET["hostname"]);
$input_action   = htmlspecialchars($_GET["action"]);

$data_file = fopen('data.csv', 'r');
while (($line = fgetcsv($data_file, 0, ";")) !== FALSE) {
  $hostname = htmlspecialchars($line[0]);
  $ip       = htmlspecialchars($line[1]);
  $netmask  = htmlspecialchars($line[2]);
  $gateway  = htmlspecialchars($line[3]);
  $dns      = htmlspecialchars($line[4]);
  $template = htmlspecialchars($line[5]);
  if ($template == "") { 
    $template = "centos-template.cfg"; 
  } else {
    $template = $template . ".cfg";
  }

  if ($input_hostname == $hostname) {
    $kickstart_template = file_get_contents($template);

    $kickstart_template = str_replace('%HOSTNAME%', $hostname, $kickstart_template);
    $kickstart_template = str_replace('%IPADDR%',   $ip, $kickstart_template);
    $kickstart_template = str_replace('%NETMASK%',  $netmask, $kickstart_template);
    $kickstart_template = str_replace('%GATEWAY%',  $gateway, $kickstart_template);
    $kickstart_template = str_replace('%DNS%',      $dns, $kickstart_template);

    if($input_action == "show") {
       echo nl2br($kickstart_template);
    } else {
       echo $kickstart_template;
    }
  }
}

fclose($data_file);
?>

