<?php
define('APPLICATION_KEY',  '8c4bbe83730d8abac3fc2f6b789030c4');



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
 $classify_unsupervised = find_recipes();
 echo $classify_unsupervised->{'title'} . "\n Ingredients: \n";
foreach($classify_unsupervised->{'ingredients'} as $c) 
{
 // printf("%s: %f", $c->l, $c->score);
  echo $c . "\n";
}

echo "link to recipe: " . $classify_unsupervised->{'source_url'};  
//echo $classify_unsupervised;

function find_recipes() {

  $wordArray = explode(" ", $_REQUEST['q']);
  $newstring = implode("%20", $wordArray);

  $ch = curl_init('http://food2fork.com/api/search?key=8c4bbe83730d8abac3fc2f6b789030c4&q=' . $newstring);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    // 'X-AYLIEN-TextAPI-Application-Key: ' . APPLICATION_KEY,
    // 'X-AYLIEN-TextAPI-Application-ID: '. APPLICATION_ID
  ));
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
  $response = curl_exec($ch);
 
  return  get_recipe(json_decode($response)->{'recipes'}[0]->{'recipe_id'});
}

function get_recipe($id) {
	 $ch = curl_init('http://food2fork.com/api/get?key=8c4bbe83730d8abac3fc2f6b789030c4&rId=' . $id);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Accept: application/json',
    // 'X-AYLIEN-TextAPI-Application-Key: ' . APPLICATION_KEY,
    // 'X-AYLIEN-TextAPI-Application-ID: '. APPLICATION_ID
  ));
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
  $response = curl_exec($ch);

  return json_decode($response)->{'recipe'};
}

?>