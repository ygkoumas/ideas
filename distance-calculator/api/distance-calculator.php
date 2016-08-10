<?php
// calculate the distance from point a to point b
// using google maps api
$api_key = '<google_map_api_key>';
$api_url = 'https://maps.googleapis.com/maps/api/distancematrix/json';

$origins = $_POST['origins'];
$destinations = $_POST['destinations'];
$mode = $_POST['mode'];
if (empty($origins) || empty($destinations) || empty($mode)) {
    exit('Please fill all the fields.');
}

$api_data = array(
	'origins' => $origins,
	'destinations' => $destinations,
	'mode' => $mode,
	'key' => $api_key
);

function call_distance_api($api_url, $api_data){
    $curl = curl_init();

    $url = sprintf("%s?%s", $api_url, http_build_query($api_data));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);

    return $result;
}
$distance= call_distance_api($api_url, $api_data);
echo json_decode($distance)->{'rows'}[0]->{'elements'}[0]->{'distance'}->{'text'};
?>