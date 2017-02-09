<?php

require_once 'config/conf.php';
require_once 'include/ts3admin.class.php';

function channelchecker() {
  global $query;
  global $config;
  global $main_channel;
  global $main_clients;
  global $main_topic;
  global $now_date;
  global $free_name;
  global $order_channel;
  
  $now_date = date("d.m.Y");

  $channel = $query->getElement('data', $query->channelList('-topic -limits'));

  foreach ($channel as $channels) {
    if($channels['channel_topic'] != 'wolny') {
      if($channels['pid'] == $config['channelchecker']['pid']) {
        $main_channel = $channels['cid'];
        $main_clients = $channels['total_clients'];
        $main_topic = $channels['channel_topic'];
        $main_channelname = $channels['channel_name'];

        if($channels['total_clients'] != 0) {
          if ($channels['channel_topic'] != $now_date) {
            $data = array();
            $data['channel_topic'] = $now_date;

            $query->channelEdit($channels['cid'], $data);
          }
        }
        $date_topic = $main_topic;

        $data1 = explode(".", $date_topic);
        $data2 = explode(".", $now_date);

        $how_day = (int)((mktime(0,0,0,$data1[1],$data1[0],$data1[2]) - mktime(0,0,0,$data2[1],$data2[0],$data2[2]))/86400);
        $todaydate = abs($how_day);
        //echo $todaydate.PHP_EOL;
        if($todaydate >= $config['channelchecker']['time'] && $main_topic != "") {
          $free_name[] = (int)($channels['channel_name']);
          $order_channel[] = $channels['channel_order'];

          $query->channelDelete($channels['cid']);

        }
        if(count($free_name) != 0) {
          for ($i=0; $i < count($free_name); $i++) {
            $query->channelCreate(array('channel_flag_permanent' => 1, 'cpid' => $config['channelchecker']['pid'], 'channel_order' => $order_channel[$i], 'channel_name' => ''.$free_name[$i].'. Kanał prywatny', 'channel_maxclients' => 0, 'channel_maxfamilyclients' => 0, 'channel_topic' => 'wolny'));
          }
        }
      }
      if($channels['pid'] == $main_channel && $main_topic != $now_date) {
        if ($channels['total_clients'] != 0) {
          $data = array();
          $data['channel_topic'] = $now_date;

          $query->channelEdit($main_channel, $data);
        }
      }
    }
  }
  unset($query);
  unset($config);
  unset($main_channel);
  unset($main_clients);
  unset($main_topic);
  unset($now_date);
  unset($free_name);
}

?>
