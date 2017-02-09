<?php
require_once 'config/conf.php';
require_once 'include/ts3admin.class.php';

function reklama1() {
	global $query;
	global $config;

	$fp1 = fopen($config['reklama1']['msg_path'], "r");
  $reklama1 = fread(fopen($config['reklama1']['msg_path'], "r"), filesize($config['reklama1']['msg_path']));

	//Automatyczna wiadomosc
	$query->sendMessage(3, 1, $reklama1);

	unset($query);
	unset($config);
}

?>
