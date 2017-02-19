<?php

include(dirname(__FILE__)."/../../common_functions.php");
include(dirname(__FILE__)."/functions.php");
//may have to run command $php composer.phar install
include 'vendor/autoload.php';
date_default_timezone_set('America/Los_Angeles');

use Phpml\Regression\LeastSquares;
use Phpml\Dataset\CsvDataset;


updateModel();

$model =loadModel();

	if(!$model){
		echo "Model not found\n";
		$model=createModel();
	}
	else{
		//print_r($model);
	}



echo "\nFirst Prediction:\n".$model->predict([500]);


?>