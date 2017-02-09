 <?php
// function interval($interval) {
// 	$sec = 1;
// 	$min = 60;
// 	$hour = 3600;
// 	$day = 86400;
// 	$time = $day * $interval['days'] + $hour * $interval['hours'] + $min * $interval['minutes'] + $sec * $interval['seconds'] ;
// 	return($time);
// }
// function convertinterval($interval) {
//
// 		$interval['hours'] = $interval['hours'] + $interval['days']*24;
// 		$interval['minutes'] = $interval['minutes'] + $interval['hours']*60;
// 		$interval['seconds'] = $interval['seconds'] + $interval['minutes']*60;
//
// 		return $interval['seconds'];
// }
// function can_do($date1, $date2, $interval) {
//
// 		$time2 = strtotime($date2);
// 		$time1 = strtotime($date1);
// 		$sum = $time1 - $time2;
//
// 		if($sum >= $interval) {
// 				$cando = true;
// 		} else {
// 				$cando  = false;
// 		}
//
// 		return $cando;
// }
// function isInGroup($usergroups,$group) {
//     $diff = count(array_diff($usergroups, $group));
//
//     if ($diff < count($usergroups)) {
//         return true;
//     } else {
//         return false;
//     }
// }

require_once 'config/conf.php';
require_once 'include/ts3admin.class.php';

function convertinterval($interval) {

		$interval['hours'] = $interval['hours'] + $interval['days']*24;
		$interval['minutes'] = $interval['minutes'] + $interval['hours']*60;
		$interval['seconds'] = $interval['seconds'] + $interval['minutes']*60;

		return $interval['seconds'];
}

function can_do($date1, $date2, $interval) {

		$time2 = strtotime($date2);
		$time1 = strtotime($date1);
		$sum = $time1 - $time2;

		if($sum >= $interval) {
				$cando = true;
		} else {
				$cando  = false;
		}

		return $cando;
}

function isInGroup($usergroups,$group) {
    $diff = count(array_diff($usergroups, $group));

    if ($diff < count($usergroups)) {
        return true;
    }
    else {
        return false;
    }
}


?>
