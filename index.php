<?php

include 'functions.php';

//shellIntoTunnel();

$query="SELECT Id as 'Super Dump',Name, concat('Hug ',Name) as 'whatever' FROM CS_Manufacturer__c limit 10;";
$destination= "file.csv";

$con=openMySQLConnection();
$result=mysqli_query($con,$query);
convertArrayToCSV(convertMySQLtoArray($result),$destination);


mysqli_free_result($result);
mysqli_close($con);



?>