<?php


function shellIntoTunnel(){
	$dbServerHost = 'cs-salesforce-slave.cfmneoauym6a.us-west-1.rds.amazonaws.com';
	shell_exec("ssh -i ~/.ssh/db_user -fNg -L 3307:$dbServerHost:3306 db_user@184.169.145.206");
}




function openMySQLConnection() {
	$con = mysqli_connect("127.0.0.1", "root", "P4n3l5123", "salesforce",3307);
		if (mysqli_connect_errno()) {
		    echo "Failed to connect to MySQL: (" . mysqli_connect_error();
		}
	return $con;
}


function convertMySQLtoArray($result) {
	$fieldinfo=mysqli_fetch_fields($result);

	$headers = array();
	foreach ($fieldinfo as $val)
	    {
	    array_push($headers,$val->name);
	    }

	$output=mysqli_fetch_all($result,MYSQLI_NUM);

	array_unshift($output,$headers);

	return $output;
}



function convertArrayToCSV($array,$destination) {

	$fp = fopen($destination, 'w');


	foreach ($array as $val) {
	    fputcsv($fp, $val);
	}

	fclose($fp);
}


?>