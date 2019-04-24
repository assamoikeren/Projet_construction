<?php 

    $dbHost = "localhost";
    $dbName = "avril";
    $dbUser ="root";
    $dbpassword = "";


    $bdd = new PDO("mysql:host=".$dbHost.";dbname=".$dbName,$dbUser,$dbpassword);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>