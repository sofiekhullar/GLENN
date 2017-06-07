<?php
    
    $wordArray = explode(" ", $_REQUEST['q']);

    //echo $_POST['word'] . "<br><br>";

    foreach ($wordArray as $word ) {

      $wordType = file_get_contents("http://www.dictionaryapi.com/api/v1/references/collegiate/xml/" . $word . "?key=496cb26a-f82d-4773-abe1-f3fa5936a00d");
      $xml = simplexml_load_string($wordType);
      	if($xml->entry->fl == "noun" && $word != "recipe")
      		echo $word . " ";
    }
?>