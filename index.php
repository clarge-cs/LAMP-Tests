<?php

include 'functions.php';

//shellIntoTunnel();

$con=openMySQLConnection();
$query=file_get_contents("queries/tests/test_query.txt");
$result=mysqli_query($con,$query);

$destination= "file.csv";
convertArrayToCSV(convertMySQLtoArray($result),$destination);


mysqli_free_result($result);
mysqli_close($con);



?>