<?php
function channel_group() {
  global $query;
  global $config;

  $array = $config['channel_group']['channels'];

  $clients = $query->getElement('data', $query->clientList());
  foreach($clients as $client) {
    foreach($config['channel_group']['channels'] as $key => $value) {
      if($client['cid'] == $key) {
        $clientinfo = $query->getElement('data', $query->clientInfo($client['clid']));
        foreach((array)$clientinfo['client_servergroups'] as $groups) {
          $query->serverGroupAddClient($value, $clientinfo['client_database_id']);
          $query->sendMessage(1, $client['clid'], 'Otrzemałeś/aś rangę!');
          $query->clientKick($client['clid'], 'channel');
        }
      }
    }
  }
}

?>
