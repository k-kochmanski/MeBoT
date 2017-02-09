<?php

  # KONFIGURACJA MeBoT'a

$config['teamspeak']['address'] = 'localhost';  //Adres serwera TeamSpeak3
$config['teamspeak']['port'] = '9987';  //Port na jakim znajduje się serwer TeamSpeak3
$config['teamspeak']['query_port'] = '10011'; //Port query
$config['teamspeak']['login'] = 'serveradmin'; //Login do UserQuery
$config['teamspeak']['password'] = ''; //Haslo do UserQuery

$config['bot']['functions'] = array('getchannel', 'channelchecker', 'autoregister', 'channel_group', 'multifunction', 'top10', 'admin_list', 'reklama1', 'reklama2'); //Funkcje MeBoT'a
$config['bot']['name'] = 'MeBoTv0.1 @ Aktywny'; //Nazwa MeBot'a
$config['bot']['default_channel'] = 2490; //Domyslny kanal MeBoT'a

# NADANIE KANALU PRYWATNEGO PO WEJSCU NA KANAL

$config['getchannel']['enabled'] = true; //On => true/Off => false
$config['getchannel']['cid'] = 2500; //Id kanalu, na ktorym po wejsciu uzytkownik dostanie kanal
$config['getchannel']['groups'] = array(30, 31); //Rangi które musisz posiadac, aby dostac kanal
$config['getchannel']['channel_group'] = 5; //Id glowniej rangi kanalowej na kanale prywatnym
$config['getchannel']['sub_channels'] = 2; //Ilosc podkanalow
$config['getchannel']['footer_desc'] = '[hr]'; //Stopka opisu kanalu prywatnego

$config['channelchecker']['enabled'] = true; //On => true/Off => false
$config['channelchecker']['pid'] = 82; //Strefa kanalow prywatnych
$config['channelchecker']['time'] = 7; //Po ilu dniach kanal prywatyn zostaje usuniety

  # AUTO REJESTRACJA

$config['autoregister']['enabled'] = true; //On => true/Off => false
$config['autoregister']['time'] = 45; // Po jakim czasie uzytkownik ma zostac zarejestrowany ( w minutach )
$config['autoregister']['group'] = 191; // ID grupy ktora ma otrzymac uzytkownik

  # AUTOMATYCZNA RANGA PO WEJSCIU NA kanalow

$config['channel_group']['enabled'] = true; //Wlaczyc czy wylaczyc
$config['channel_group']['channels'] = array(2498 => 30, 2499 => 31); //id kanału => id grupy

  # MULTI FUNCTIONS

$config['multifunction']['enabled'] = true; //On => true/Off => false

$config['multifunction']['hour_cid'] = 2501; //Kanal na ktorym na znajdowac sie czas
$config['multifunction']['hour_channelname'] = '[cspacer][hour]'; //Sposob wyswietlania [hour]

$config['multifunction']['date_cid'] = 2502; //Kanal na ktorym na znajdowac sie daty
$config['multifunction']['date_channelname'] = '[cspacer][date]'; //Sposob wyswietlania [date]

$config['multifunction']['online_cid'] = 2492; //Kanal na ktorym na znajdowac sie ilosc uzytkownikow online
$config['multifunction']['online_channelname'] = 'Aktualnie online: [online]'; //Sposob wyswietlania [online]

$config['multifunction']['onlinerecord'] = 2493; //Kanal na ktorym na znajdowac sie rekord uzytkownikow online
$config['multifunction']['onlinerecord_channelname'] = 'Aktualny rekord online: [record]'; //Sposob wyswietlania [rekord]

$config['multifunction']['channels'] = 2495; //Kanal na ktorym na znajdowac sie ilosc kanalow na serwerze
$config['multifunction']['channels_channelname'] = 'Wszystkich kanałów: [channels]'; //Sposob wyswietlania [channels]

$config['multifunction']['interval'] = array('days' => 0,'hours' => 0,'minutes' => 0,'seconds' => 10); // Czas odswierzania
$config['multifunction']['data'] = '1970-01-01 00:00:00';

  # TOP 10

$config['top10']['enabled'] = true; //On => true/Off => false
$config['top10']['db']['address'] = 'localhost';
$config['top10']['db']['user'] = 'root';
$config['top10']['db']['password'] = 'ef2saUx9oyRu';
$config['top10']['db']['database'] = 'ts3_stat_bot';

  # TOP 10 ILOSCI POLACZEN NA SERWER
    $config['top10']['connections']['cid'] = 2496;
    $config['top10']['connections']['header_desc'] = '[hr][center][img]http://pywnica.pl/pywnica/header/top10-IP.png[/img][/center][hr]\n\n'; //Naglowek
    $config['top10']['connections']['footer_desc'] = '[hr]'; //Stopka
  # TOP 10 DLUGOSCI polaczen
    $config['top10']['connections_time']['cid'] = 2497;
    $config['top10']['connections_time']['header_desc'] = '[hr][center][img]http://pywnica.pl/pywnica/header/top10-NP.png[/img][/center][hr]\n\n'; //Naglowek
    $config['top10']['connections_time']['footer_desc'] = '[hr]'; //Stopka

$config['top10']['interval'] = array('days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0);
$config['top10']['data'] = '1970-01-01 00:00:00';

# LISTA ADMINISTACJI ONLINE

$config['admin_list']['enabled'] = true; //On => true/Off => false
$config['admin_list']['channel'] = 311;
$config['admin_list']['groups'] = array(20,139,124,149,34,35,298);
$config['admin_list']['header_desc'] = '[hr][center][img]http://pywnica.pl/pywnica/header/admin-list.png[/img][/center][hr]\n\n';
$config['admin_list']['footer_desc'] = '[hr]';
$config['admin_list']['interval'] = array('days' => 0,'hours' => 0,'minutes' => 5,'seconds' => 0);
$config['admin_list']['data'] = '1970-01-01 00:00:00';

  # REKLAMA

  $config['reklama1']['enabled'] = false; //Wlaczyc czy wylaczyc
  $config['reklama1']['msg_path'] = "config/messages/reklama1.txt";
  $config['reklama1']['interval'] = array('days' => 0,'hours' => 0,'minutes' => 0,'seconds' => 10);
  $config['reklama1']['data'] = '1970-01-01 00:00:00';

  $config['reklama2']['enabled'] = true; //Wlaczyc czy wylaczyc
  $config['reklama2']['msg_path'] = "config/messages/reklama2.txt";
  $config['reklama2']['interval'] = array('days' => 0,'hours' => 1,'minutes' => 30,'seconds' => 0);
  $config['reklama2']['data'] = '1970-01-01 00:00:00';


?>
