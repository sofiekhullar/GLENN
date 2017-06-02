<?php

	$weatherRequest = file_get_contents("https://query.yahooapis.com/v1/public/yql?q=select%20item.condition%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20text%3D%22" . $_REQUEST['q'] . "%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys");
	$weatherArray = json_decode($weatherRequest);
    $tempCelsius = round(($weatherArray->{"query"}->{"results"}->{"channel"}->{"item"}->{"condition"}->{"temp"} - 32) / 1.8);
	echo "The weather in " . $_REQUEST['q'] . " is " . $weatherArray->{"query"}->{"results"}->{"channel"}->{"item"}->{"condition"}->{"text"};
	echo " and the temperature is " . $tempCelsius . " degrees.";
?>

