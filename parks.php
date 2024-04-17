<?php

function getAllbystate(){
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://developer.nps.gov/api/v1/thingstodo?&stateCode=ca&api_key=bmrMc3IA6vsXAnDhpqCprYHQU1L2HdKRiZa3SDQl");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

  $headers = array();
  $headers[] = 'Accept: application/json';
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  return $result = curl_exec($ch);
  if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
  }
  curl_close($ch);

}

function getAllInState($totalThings){
  $ch = curl_init();
  $start = rand(0, (int)$totalThings);
  curl_setopt($ch, CURLOPT_URL, "https://developer.nps.gov/api/v1/thingstodo?api_key=bmrMc3IA6vsXAnDhpqCprYHQU1L2HdKRiZa3SDQl&start=$start&limit=1");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

  $headers = array();
  $headers[] = 'Accept: application/json';
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  return $result = curl_exec($ch);
  if (curl_errno($ch)) {
      echo 'Error:' . curl_error($ch);
  }
  curl_close($ch);

}

$data1 = getAllbystate();
$totalThingsJson = json_decode( $data1, true );
$totalThings = $totalThingsJson['total'];

$data2 = getAllInState($totalThings);
$toDoJson = json_decode( $data2, true );
//var_dump($toDoJson);
$parkName = $toDoJson['data'][0]['title'];
$parkDesc = $toDoJson['data'][0]['shortDescription'];
$parkLink = $toDoJson['data'][0]['url'];
$parkImg = $toDoJson['data'][0]['images'][0]['url'];
$parkReserve = $toDoJson['data'][0]['isReservationRequired'];
if ($parkReserve === true) {
  $parkReserve = 'Yes';
}else {
  $parkReserve = 'No';
}
$parkSeasonDesc = $toDoJson['data'][0]['seasonDescription'];
$parkPetDesc = $toDoJson['data'][0]['petsDescription'];
$parkTime = $toDoJson['data'][0]['timeOfDayDescription'];
$parkFee = $toDoJson['data'][0]['feeDescription'];
$parkLocation = $toDoJson['data'][0]['locationDescription'];
$parkLongDesc = $toDoJson['data'][0]['longDescription'];
$parkDuration = $toDoJson['data'][0]['duration'];

/*
echo "Park Name: $parkName <br>";
echo "Duration: $parkDuration <br>";
echo "Park Description: $parkDesc <br>";
echo "Park Details: $parkLongDesc <br>";
echo "Season Description: $parkSeasonDesc <br>";
echo "Park Link: $parkLink <br>";
echo "Park Image: $parkImg <br>";
echo "Reservation: $parkReserve <br>";
echo "Are pets allowed? $parkPetDesc <br>";
echo "Park Hours: $parkTime <br>";
echo "Park Fee: $parkFee <br>";
echo "Park Location: $parkLocation <br>";
*/
