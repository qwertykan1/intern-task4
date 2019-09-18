<?php
require "vendor/autoload.php";
use App\Models\Database;
use App\Models\Country;
use App\Models\Continent;

$db = new Database();

echo Country::with('continent')->get();