<?php

 function insertData($db_table,$db_value,$db_inconnue,$data_value,$bdd)
 {

 	$req = $bdd->prepare("INSERT INTO ". $db_table ."( ". $db_value . ") VALUES(". $db_inconnue .")");
    $result = $req->execute($data_value);
    return $result;
 }


 
 
?>