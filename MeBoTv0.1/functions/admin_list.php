<?php

require_once 'config/conf.php';
require_once 'include/ts3admin.class.php';

function admin_list() {
  global $query;
  global $config;

  $adminsgroups = $config['admin_list']['groups'];

  $desc = $config['admin_list']['header_desc'];
  $desc .= '[center]';
  foreach($adminsgroups as $group) {
    $group_name = getgroupname($group);
		$groupsclients = $query->getElement('data', $query->serverGroupClientList($group, $names = true));
		$clients = $query->getElement('data', $query->clientList("-uid -groups -times"));
		$desc.= '[size=13][b]' . $group_name . '[/b][/size]\n\n';
    if (array_key_exists('client_nickname', $groupsclients[0])) {
      foreach($groupsclients as $groupclient) {
        foreach($clients as $client) {
          if ($client['client_unique_identifier'] == $groupclient['client_unique_identifier']) {
            $online = true;
						break;
          } else {
            $online = false;
          }
        }
        if ($online) {
          $desc.= '[size=10]• [/size][url=client://' . $client['clid'] . '/' . $groupclient['client_unique_identifier'] . '][b][size=11]' . $groupclient['client_nickname'] . '[/b][/url][size=11] jest aktualnie [color=green][b]ONLINE[/b][/color][/size]\n';
        } else {
          $info = $query->getElement('data', $query->clientDbInfo($groupclient['cldbid']));
          $seconds = time() - $info['client_lastconnected'];

          $days    = floor($seconds / 86400);
          $hours   = floor(($seconds - ($days * 86400)) / 3600);
          $minutes = floor(($seconds - ($days * 86400) - ($hours * 3600))/60);
          $seconds = floor(($seconds - ($days * 86400) - ($hours * 3600) - ($minutes*60)));

          $desc.= '[size=10]• [/size][url=client://' . $client['clid'] . '/' . $groupclient['client_unique_identifier'] . '][b][size=11]' . $groupclient['client_nickname'] . '[/b][/url][size=11] jest aktualnie [color=red][b]OFFLINE[/b][/color] od '.$days.' dni, '.$hours.' godzin i '.$minutes.' minut[/size]\n';
        }
      }
      $desc.= '\n\n\n';
    }
  }
  $desc .= '[/center][hr]';
	$desc .= $config['admin_list']['footer_desc'];
	$channel = $query->channelInfo($config['admin_list']['channel']);
  if (strcmp($channel['data']['channel_description'], $desc) != 0) {
    $query->channelEdit($config['admin_list']['channel'], array('channel_description' => $desc ));
  }
  global $query;
  global $config;
}

function getgroupname($grupa) {
	global $query;
  
	$groups = $query->getElement('data', $query->serverGroupList());
	$groupname = '';
	foreach($groups as $group) {
		if ($group['sgid'] == $grupa) {
			$groupname = $group['name'];
		}
	}
	return $groupname;
  global $query;
}

?>
