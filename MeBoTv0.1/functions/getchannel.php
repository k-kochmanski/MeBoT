<?php
date_default_timezone_set('Europe/Warsaw');

require_once 'config/conf.php';
require_once 'include/ts3admin.class.php';
require_once 'include/functions.php';

function getchannel() {
  global $query;
  global $config;
  global $canget;

  $clients = $query->getElement('data', $query->clientList('-groups'));
  foreach ($clients as $client) {
    $channel = $query -> getElement('data', $query->channelList('-topic -limits'));
    foreach ($channel as $channels) {
      if($client['cid'] == $config['getchannel']['cid']) {
        $groups = explode(",", $client['client_servergroups']);
        if(isInGroup($groups, $config['getchannel']['groups'])) {
          $cglist = $query->getElement('data', $query->channelGroupClientList());
          foreach((array)$cglist as $cg) {
            if($cg['cldbid'] == $client['client_database_id'] && $canget) {
              if($cg['cgid'] == $config['getchannel']['channel_group']) {
                $query->sendMessage(1, $client['clid'], 'Posiadasz już u nas kanał prywatny! Zostałeś na niego przeniesiony');
                $query->clientMove($client['clid'], $cg['cid']);
                $canget = false;
                break 3;
              } else {
                $canget = true;
              }
            } else {
              $canget = true;
            }
            if($channels['channel_topic'] == 'wolny' && $canget) {
              $query->sendMessage(1, $client['clid'], 'Zostałeś przeniesiony na Twój nowy kanał. Zmień hasło oraz nazwe kanału. Zostały stworzone [b]2[/b] podkanały');
              $query->clientMove($client['clid'], $channels['cid']);
              $query->setClientChannelGroup($config['getchannel']['channel_group'], $channels['cid'], $client['client_database_id']);
              $number = (integer)$channels['channel_name'];
              $desc = '[center][size=15]Kanał prywatny numer [b]'.$number.'[/b]\n\n Wlasciciel: '.$client['client_nickname'].' \n Stworzony: '.date("d.m.y", time()).' \n';
              $desc .= $config['getchannel']['footer_desc'];
              $query->channelEdit($channels['cid'], array('channel_name' => ''.$number.'. Kanal '.$client['client_nickname'].''));
              $time = date("d.m.Y");
              $query->channelEdit($channels['cid'], array('channel_description' => $desc, 'channel_flag_maxclients_unlimited'=>1, 'channel_flag_maxfamilyclients_unlimited'=>1, 'channel_flag_maxfamilyclients_inherited'=>0, 'channel_topic'=>''.$time.''));
              for($i=0; $i<$config['getchannel']['sub_channels']; $i++) {
                $numer = $i;
                $numer++;
                $query->channelCreate(array('channel_flag_permanent' => 1, 'cpid' => $channels['cid'], 'channel_name' => ''.$numer.'. Podkanal', 'channel_flag_maxclients_unlimited'=>1, 'channel_flag_maxfamilyclients_unlimited'=>1));
              }
              break 3;
            }
          }
        } else {
          $query->sendMessage(1, $client['clid'], 'Nie posiadasz rang wymaganych do założenia kanału prywatnego!');
          $query->clientKick($client['clid'], 'channel');
          break;
        }
      }
    }
  }
  unset($query);
  unset($config);
}
?>
