<?php
require "vendor/autoload.php";
use App\Models\Database;
use App\Models\Country;
use App\Models\Continent;

$db = new Database();

if(!($errors = Country::validate($_POST)))
{
	$country = new Country();
	$country->name = $_POST['countryName'];
	$country->population = $_POST['countryPopulation'];
	$country->square = $_POST['countrySquare'];
	$country->continent_id = $_POST['countryContinent'];
	$country->save();
	echo json_encode(array('message' => "Cтрана добавлена"));
}
else
	echo json_encode(array('errors' => $errors));

