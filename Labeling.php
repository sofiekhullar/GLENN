<?php
define('APPLICATION_ID',    '78232f4a');
define('APPLICATION_KEY',  '384edd3cbd4539be88186218a67e7582');


/*function call_api($endpoint, $parameters) {
  $ch = curl_init('https://api.aylien.com/api/v1/' . $endpoint);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'X-AYLIEN-TextAPI-Application-Key: ' . APPLICATION_KEY,
    'X-AYLIEN-TextAPI-Application-ID: '. APPLICATION_ID
  ));
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
  $response = curl_exec($ch);
  return json_decode($response);
}*/
 $classify_unsupervised = call_api_semantic_classifier();

$tmp = 0;
$label ="no label";

foreach($classify_unsupervised->classes as $c) 
{
  //printf("%s: %f", $c->label, $c->score);
  if($c->score > $tmp){
    $tmp = $c->score;
    $label = $c->label;
  }
}
echo $label;

function call_api_semantic_classifier() {

  $wordArray = explode(" ", $_REQUEST['q']);
  $newstring = implode("%20", $wordArray);

  $ch = curl_init('https://api.aylien.com/api/v1/classify/unsupervised?text='.$newstring.'&class[]=music&class[]=weather&class[]=food');

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    'X-AYLIEN-TextAPI-Application-Key: ' . APPLICATION_KEY,
    'X-AYLIEN-TextAPI-Application-ID: '. APPLICATION_ID
  ));
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
  $response = curl_exec($ch);
  var_dump($response);
  return json_decode($response);
}

/*

$endpoints = array("language", "classify/unsupervised");
$url = "http://www.bbc.com/news/science-environment-27688511";

foreach($endpoints as $endpoint)
  {
    switch($endpoint){
      case "language":
      {
        $params = array('text' => 'What language is this sentence written in?');
        $language = call_api('language', $params);

        //echo sprintf("Language: %s (%F)", $language->lang, $language->confidence);
        break;
      }
      case "classify/unsupervised":
      {
        $classify_unsupervised = call_api_semantic_classifier();

        foreach($classify_unsupervised->classes as $c) 
        {
          //printf("%s: %f", $c->label, $c->score);
          echo($c->label);
          echo(" ");
          echo($c->score);
        }

        /*$class = array('technology', 'sports');
        $params = array('url' => $url, 'class' => $class);
        $classify_unsuper = call_api('classify/unsupervised', $params);
        var_dump($classify_unsuper);
        //foreach($classify_unsuper->classes as $c) {
        // echo sprintf("%s: %f\n", $c->label, $c->score);
        //}
       

        break;
      }
  } 
}*/
?>