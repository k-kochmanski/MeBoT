<?php

date_default_timezone_set('Europe/Warsaw');

require_once 'config/conf.php';
require_once 'include/ts3admin.class.php';

function multifunction() {
  global $query;
  global $config;
  global $rekord;

  $serverinfo = $query->getElement('data', $query->serverInfo());
  $bots = $serverinfo['virtualserver_queryclientsonline'];
	$users = $serverinfo['virtualserver_clientsonline'];
  $online = $users - $bots;

  $data = array();
  $data['channel_name'] = str_replace('[online]', $online, $config['multifunction']['online_channelname']);
  $query->channelEdit($config['multifunction']['online_cid'], $data);

  $godzina = array();
  $godzina['channel_name'] = str_replace('[hour]', date('H:i'), $config['multifunction']['hour_channelname']);
	$query->channelEdit($config['multifunction']['hour_cid'], $godzina);

  $day = date('d');
	$momth = date('n');
	$year = date('Y');
	$miesiac = array(1 => 'stycznia', 2 => 'lutego', 3 => 'marca', 4 => 'kwietnia', 5 => 'maja', 6 => 'czerwca', 7 => 'lipca', 8 => 'sierpnia', 9 => 'września', 10=> 'października', 11 => 'listopada', 12 => 'grudnia');
	$new_date = $day." ".$miesiac[$momth]." ".$year;

  $date = array();
  $date['channel_name'] = str_replace('[date]', $new_date, $config['multifunction']['date_channelname']);
  $query->channelEdit($config['multifunction']['date_cid'], $date);

  $kanaly = array();
	$kanaly['channel_name'] = str_replace('[channels]', $serverinfo['virtualserver_channelsonline'], $config['multifunction']['channels_channelname']);
	$query->channelEdit($config['multifunction']['channels'], $kanaly);

  $fp = fopen("config/messages/online_rekord.txt", "r");
  $tekst = fread($fp, 4);
	$record = (int)$tekst;
	fclose($fp);
  if($rekord < $online) {
    $fp = fopen("config/messages/online_rekord.txt", "w");
    fputs($fp, $online);
    fclose($fp);
  }
  $data = array();
	$data['channel_name'] = str_replace('[record]', $record, $config['multifunction']['onlinerecord_channelname']);
	$query->channelEdit($config['multifunction']['onlinerecord'], $data);

  unset($query);
  unset($config);
}

?>
