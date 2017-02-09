<?php
date_default_timezone_set('Europe/Warsaw');
ini_set('default_charset', 'UTF-8');
setlocale(LC_ALL, 'UTF-8');

define('VERSION', '0.1');

include_once('include/ts3admin.class.php');
include_once('config/conf.php');
include_once('include/functions.php');

foreach (glob("functions/*.php") as $filename) {
    include_once $filename;
}
$config['bot']['data'] = '1970-01-01 00:00:00';
$how_on = 0;
$name_on = ' funkcji: '. PHP_EOL;
system('clear');
for($i = 0; $i < count($config['bot']['functions']); $i++) {
 if($config[$config['bot']['functions'][$i]]['enabled']) {
   $how_on++;
   $name_on .= " - " . $config['bot']['functions'][$i] . PHP_EOL;
 }
}
/*
$query = new ts3admin($config['teamspeak']['address'], $config['teamspeak']['query_port']);
if($query->getElement('success', $query->connect())) {
  $query->login($config['teamspeak']['login'], $config['teamspeak']['password']);
  $query->selectServer($config['teamspeak']['port']);
  $query->setName($config['bot']['name']);
  $core = $query->getElement('data', $query->whoAmI());
  $query->clientMove($core['client_id'], $config['bot']['default_channel']);

  echo 'MeBoT wersja '.VERSION.''.PHP_EOL;
  echo 'Instalacja "'.$config['bot']['name'].'" uruchomiony pomyślnie.'. PHP_EOL;
  echo 'Autor bota: Kacper "MTKK97" Kochmański' .PHP_EOL. PHP_EOL;
  echo 'Zaladowano '. $how_on . $name_on;
  echo PHP_EOL . 'Konsola:'. PHP_EOL;
	while(true) {
    if($config[$config['bot']['functions'][0]]['enabled']) {
      getchannel();
    }
    if($config[$config['bot']['functions'][1]]['enabled']) {
      channelchecker();
    }
    if($config[$config['bot']['functions'][2]]['enabled']) {
      autoregister();
    }
    if($config[$config['bot']['functions'][3]]['enabled']) {
      channel_group();
    }
		$datapetli = date('Y-m-d G:i:s');
    // for($i = 4; $i < count($config['bot']['functions']); $i++) {
  	// 	if($config[$config['bot']['functions'][$i]]['enabled']) {
		// 		if(can_do($datapetli, '1970-01-01 00:00:00', interval($config[$config['bot']['functions'][$i]]['interval']))) {
    //       $funkcja = $config['bot']['functions'][$i];
    //       echo $funkcja.PHP_EOL;
		// 			$funkcja();
		// 			$datapetli = '1970-01-01 00:00:00';
    //       break;
		// 		}
    //   }
		// }

    for($i=4; $i<count($config['bot']['functions']); $i++) {
  		if($config[$config['bot']['functions'][$i]]['enabled']) {
  			if(can_do($datapetli, $config['bot']['data'], convertinterval($config[$config['bot']['functions'][$i]]['interval']))) {
  				$funkcja = $config['bot']['functions'][$i];
  				$funkcja();
  				$config['bot']['data'] = $datapetli;
  				break;
  			}
  		}
  	}
	}
} */
$query = new ts3admin($config['teamspeak']['address'], $config['teamspeak']['query_port']);
if($query->getElement('success', $query->connect())) {
  $query->login($config['teamspeak']['login'], $config['teamspeak']['password']);
  $query->selectServer($config['teamspeak']['port']);
  $tsAdminSocket = $query->runtime['socket'];
  $query->setName($config['bot']['name']);

  echo 'MeBoT wersja '.VERSION.''.PHP_EOL;
  echo 'Instalacja "'.$config['bot']['name'].'" uruchomiony pomyślnie.'. PHP_EOL;
  echo 'Autor bota: Kacper "MTKK97" Kochmański' .PHP_EOL. PHP_EOL;
  echo 'Zaladowano '. $how_on . $name_on;
  echo PHP_EOL . 'Konsola:'. PHP_EOL;
  while (true) {
    $datapetli = date('Y-m-d G:i:s');
    $core = $query->getElement('data',$query->whoAmI());
    $query->clientMove($core['client_id'],$config['bot']['default_channel']);
    if($config[$config['bot']['functions'][0]]['enabled']) {
      getchannel();
    }
    if($config[$config['bot']['functions'][1]]['enabled']) {
      channelchecker();
    }
    if($config[$config['bot']['functions'][2]]['enabled']) {
      autoregister();
    }
    if($config[$config['bot']['functions'][3]]['enabled']) {
      channel_group();
    }
    for($i=4; $i<count($config['bot']['functions']); $i++) {
      if($config[$config['bot']['functions'][$i]]['enabled']) {
        if(can_do($datapetli, $config[$config['bot']['functions'][$i]]['data'], convertinterval($config[$config['bot']['functions'][$i]]['interval']))) {
          $funkcja = $config['bot']['functions'][$i];
          $funkcja();
          $config[$config['bot']['functions'][$i]]['data'] = $datapetli;
          break;
        }
      }
    }
  }
}

?>
