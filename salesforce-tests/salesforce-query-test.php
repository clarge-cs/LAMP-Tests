<?php
// SOAP_CLIENT_BASEDIR - folder that contains the PHP Toolkit and your WSDL
// $USERNAME - variable that contains your Salesforce.com username (must be in the form of an email)
// $PASSWORD - variable that contains your Salesforce.com password

define("SOAP_CLIENT_BASEDIR", "../Force.com-Toolkit-for-PHP/soapclient");
require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
require_once ('../Force.com-Toolkit-for-PHP/samples/userAuth.php');
try {
  $mySforceConnection = new SforceEnterpriseClient();
  $mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/CivicSolar.CSPartial.enterprise.wsdl.xml');
  $mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);
  
  $query = 'SELECT Id,Name from Account limit 5';
  $response = $mySforceConnection->query(($query));

  foreach ($response->records as $record) {
    print_r($record);
    print_r("<br>");
  }
} catch (Exception $e) {
  echo $e->faultstring;
}
?>

5