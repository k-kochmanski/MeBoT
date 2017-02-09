<?php

date_default_timezone_set('Europe/Warsaw');

require_once 'config/conf.php';
require_once 'include/ts3admin.class.php';

function top10() {
  global $query;
  global $config;

  $conn = mysqli_connect($config['top10']['db']['address'], $config['top10']['db']['user'], $config['top10']['db']['password'], $config['top10']['db']['database']);
  if (!$conn) {
    die('Could not connect: ' . mysql_error());
  }
  $users = $query->getElement('data',$query->clientList('-groups -voice -away -times -uid'));
  foreach($users as $user) {
    $client = $query->getElement('data',$query->clientInfo($user['clid']));
    $sql = "SELECT * FROM top10connections WHERE uid = '".$user['client_unique_identifier']."' ";
    $sql2 = "SELECT * FROM top10connectiontime WHERE uid = '".$user['client_unique_identifier']."' ";
    $result = mysqli_query($conn, $sql);
    $u_data = mysqli_fetch_assoc($result);

    $result2 = mysqli_query($conn,$sql2);
    $u_data2 = mysqli_fetch_assoc($result2);

    if($u_data['id'] == null && $user['client_type'] != 1) {
      $zapytanie = "INSERT INTO top10connections (`uid`, `connections`, `nick`, `clid`) VALUES ('".$user['client_unique_identifier']."', '".$client['client_totalconnections']."', '".$user['client_nickname']."', '".$user['clid']."')";
      mysqli_query($conn, $zapytanie);
    } else {
      if($client['client_totalconnections'] > $u_data['connections']) {
        $zapytanie = "UPDATE top10connections SET connections='".$client['client_totalconnections']."' WHERE uid='".$user['client_unique_identifier']."'";
        mysqli_query($conn, $zapytanie);
      }
    }

    if($u_data2['id'] == null && $user['client_type'] != 1) {
      $zapytanie2 = "INSERT INTO top10connectiontime (`uid`, `connectiontime`, `nick`, `clid`) VALUES ('".$user['client_unique_identifier']."', '".$client['connection_connected_time']."', '".$user['client_nickname']."', '".$user['clid']."')";
      mysqli_query($conn, $zapytanie2);
    } else {
      if($client['connection_connected_time'] > $u_data2['connectiontime']) {
        $zapytanie2 = "UPDATE top10connectiontime SET connectiontime='".$client['connection_connected_time']."' WHERE uid='".$user['client_unique_identifier']."'";
        mysqli_query($conn, $zapytanie2);
      }
    }
  }
  $desc = $config['top10']['connections']['header_desc'];
  $desc .= '[center]';

  $sql = "SELECT * FROM top10connections ORDER BY connections DESC LIMIT 10";
  $result = mysqli_query($conn,$sql);
  $number = 1;
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $desc .= ''.$number.'. [URL=client://0/'.$row['uid'].']'.$row['nick'].'[/URL] polaczyl sie z serwerem [b]'.$row['connections'].'[/b] razy \n\n';
    $number++;
  }
  $desc .= '[/center][hr]';
  $desc .= $config['top10']['connections']['footer_desc'];
  $query->channelEdit($config['top10']['connections']['cid'], array( 'channel_description' => $desc ));

  // TOP 10 DLUGOSCI POLACZENI NA SERWERZE
  $desc2 = $config['top10']['connections_time']['header_desc'];
  $desc2 .= '[center]';
  $sql2 = "SELECT * FROM top10connectiontime ORDER BY connectiontime DESC LIMIT 10";
  $result2 = mysqli_query($conn,$sql2);
  $number2 = 1;
  while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
    $init = $row2['connectiontime']/1000;
    $seconds = $init;
    $days = floor($seconds / (3600*24));
    $seconds = $seconds % (3600*24);
    $hours = floor($seconds/3600);
    $seconds = $seconds % 3600;
    $minutes = floor($seconds/60);
    $seconds = $seconds % 60;
    $desc2 .= ''.$number2.'. [URL=client://0/'.$row2['uid'].']'.$row2['nick'].'[/URL] - [b]'.$days.' dni '.$hours.' godzin '.$minutes.' minut i '.$seconds.' sekund[/b] \n\n';
    $number2++;
  }
  $desc2 .= '[/center][hr]';
  $desc2 .= $config['top10']['connections_time']['footer_desc'];
  $query->channelEdit($config['top10']['connections_time']['cid'], array( 'channel_description' => $desc2 ));

  unset($query);
  unset($config);
}

?>
