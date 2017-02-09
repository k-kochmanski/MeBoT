<?php

date_default_timezone_set('Europe/Warsaw');

require_once 'config/conf.php';
require_once 'include/ts3admin.class.php';

function autoregister() {
  global $query;
	global $config;
  $users = $query->getElement('data',$query->clientList('-groups -voice -away -times -uid'));
  foreach($users as $client) {
    $to_time = time();
    $from_time = $client['client_created'];
    $time = round(abs($to_time - $from_time) / 60,2);
    if($time > $config['autoregister']['time']) {
      $query->serverGroupAddClient($config['autoregister']['group'], $client['client_database_id']);
    }
  }
}

?>
