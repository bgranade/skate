<?php
$latitude = $_GET['lat'];
$long = $_GET['long'];

$cURLConnection = curl_init();
//echo 'http://api.openweathermap.org/data/2.5/weather?lat='.$latitude.'&lon='.$long.'&appid=a7b25f00bb8352436832cc124a15b790&units=imperial';
//exit();
curl_setopt($cURLConnection, CURLOPT_URL, 'http://api.openweathermap.org/data/2.5/weather?lat='.$latitude.'&lon='.$long.'&appid=2391fdf00185b4c3762883233b1539ee&units=imperial');
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$phoneList = curl_exec($cURLConnection);
curl_close($cURLConnection);

$jsonArrayResponse = json_decode($phoneList,true);
$ResponseArray = array("temp" => $jsonArrayResponse['main']['temp']);
//echo json_encode($ResponseArray);
//echo "<pre>";
//echo $jsonArrayResponse;
/*$jsonArrayResponse['main']['temp'];
$jsonArrayResponse['main']['pressure'];
$jsonArrayResponse['main']['humidity'];
$jsonArrayResponse['main']['temp_min'];
$jsonArrayResponse['main']['temp_max'];

$jsonArrayResponse['sys']['sunrise'];
$jsonArrayResponse['sys']['sunset'];
echo "hello";*/
/**/
echo "
		<h2>Temperature Data</h2>
		<table border='1'>
		<tr>
			<td>Temperature</td><td>".$jsonArrayResponse['main']['temp']."</td>
			
		</tr>
		<tr>
			
			<td>Pressure</td><td>".$jsonArrayResponse['main']['pressure']."</td>
		</tr>
		<tr>
			<td>Humidity</td><td>".$jsonArrayResponse['main']['humidity']."</td>
			
		</tr>
		<tr>
			<td>Temperature Min</td><td>".$jsonArrayResponse['main']['temp_min']."</td>
			
		</tr>
		<tr>
			<td>Temperature Max</td><td>".$jsonArrayResponse['main']['temp_max']."</td>
			
		</tr>
	</table>";
//echo "<pre>";
//print_r($jsonArrayResponse);
?>
