<?php


function CreateFileName($type,$sysid){
	$date = date('Ymd');
	return $sysid."_".$date."_".$type.".txt";
}


function convertArrayToTSV($array,$destination) {

	$fp = fopen($destination, 'w');
	foreach ($array as $val) {
	    fputcsv($fp, $val,"\t");
	}
	fclose($fp);
}

function UploadToStatementMatching($filename){
	$strServer = "statementmatching.exavault.com";
	$strServerPort = "22";
	$strServerUsername = "civicsolar";
	$strServerPassword = "9CJw226z9xw9Etp";


	// set up basic connection
	$conn_id = ftp_connect($strServer,$strServerPort) or die("Couldn't connect to $ftp_server");

	// login with username and password
	$login_result = ftp_login($conn_id, $strServerUsername, $strServerPassword);

	if ($login_result) {
	 echo "Successfully logged into to FTP\n";
	 	// upload a file
		 if (ftp_put($conn_id, $filename, dirname(__FILE__)."/FilesToSend/".$filename, FTP_ASCII)) {
		 echo "successfully uploaded ".$filename."\n";
		} else {
		 echo "There was a problem while uploading ".$filename."\n";
		}
	} else {
	 echo "There was a problem while logging into FTP\n";
	}

	

	// close the connection
	ftp_close($conn_id);
}



?>