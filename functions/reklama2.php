<?php
require_once 'config/conf.php';
require_once 'include/ts3admin.class.php';

function reklama2() {
	global $query;
	global $config;

	$fp1 = fopen($config['reklama2']['msg_path'], "r");
  $reklama2 = fread(fopen($config['reklama2']['msg_path'], "r"), filesize($config['reklama2']['msg_path']));

	//Automatyczna wiadomosc
	$query->sendMessage(3, 1, $reklama2);

	unset($query);
	unset($config);
}

?>
