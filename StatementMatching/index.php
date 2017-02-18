<?php

include(dirname(__FILE__)."/../common_functions.php");
include(dirname(__FILE__)."/functions.php");
date_default_timezone_set('America/Los_Angeles');

//shellIntoTunnel();
$con=openMySQLConnection();




$query_ven=file_get_contents(dirname(__FILE__)."/Queries/Vendors.txt");
$result_ven=mysqli_query($con,$query_ven);

$filename=CreateFileName("VEND","SYSID");
$destination_ven= dirname(__FILE__)."/FilesToSend/".$filename;
convertArrayToTSV(convertMySQLtoArray($result_ven),$destination_ven);

UploadToStatementMatching($filename);




mysqli_free_result($result_ven);
mysqli_close($con);

?>