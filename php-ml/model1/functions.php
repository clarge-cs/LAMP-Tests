<?php

use Phpml\Regression\LeastSquares;
use Phpml\Dataset\CsvDataset;

function createModel(){
	$model = new LeastSquares();
	$model = trainModel($model);
	saveModel($model);
	return $model;
}

function trainModel($model){
	$dataset = new CsvDataset(dirname(__FILE__)."/data/LeastSquares_Data.csv", 1);
	$model->train($dataset->getSamples(), $dataset->getTargets());
	return $model;
}

function loadModel(){
	if (file_exists(dirname(__FILE__)."/model.txt")) {
		$model=unserialize(file_get_contents(dirname(__FILE__)."/model.txt"));
	    return $model;
	}
	else return false;
}

function saveModel($model){
	file_put_contents(dirname(__FILE__)."/model.txt", serialize($model));
}


function updateModel(){
	$con=openMySQLConnection();

	$query=file_get_contents(dirname(__FILE__)."/queries/model_query.txt");
	$result=mysqli_query($con,$query);
	$destination= dirname(__FILE__)."/data/LeastSquares_Data.csv";
	convertArrayToCSV(convertMySQLtoArray($result),$destination,false);

	$dataset = new CsvDataset($destination, 1,true);

	$model =loadModel();

	if(!$model){
		echo "Model not found\n";
		$model=createModel();
	}

	trainModel($model);
	saveModel($model);


	mysqli_free_result($result);
	mysqli_close($con);
}




?>