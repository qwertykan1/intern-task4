<?php
require "vendor/autoload.php";
use App\Models\Database;
use App\Models\Continent;

$db = new Database();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Страны мира</title>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="css/tether.min.css" rel="stylesheet"></style>
    <link href="css/bootstrap.min.css" rel="stylesheet"></style>
    <link href="css/style.css" rel="stylesheet"></style>
  	<body>
	  	<div class="wrapper container">
	  		<div class="content">
		  		<header>
	  				<h1>Страны мира</h1>
	  			</header>
	  			<div id="menu-container">
					<h2>Меню</h2>
					<div class="row">
						<div class="col-sm-6 col-md-4 col-lg-3 col-xs-12 button-wrapper">
				    		<button type="button" id="show-btn" class="btn btn-primary">Просмотреть список стран</button>
				    	</div>
				    	<div class="col-sm-6 col-md-2 col-lg-3 col-xs-12">
				    		<button type="button" id="add-country-btn" class="btn btn-primary">Добавить страну</button>
						</div>
					</div>
				</div>
	  			<div id="add-country-form-container">
	  				<h2>Добавление страны</h2>
			  		<form id="addCountryForm" action="add-country.php" method="POST">
				        <div class="form-group">
				          	<label for="countryName">Название страны*</label>
				          	<input type="text" name="countryName" class="form-control" id="countryName" placeholder="Введите название страны" required>
				        </div>
				        <div class="form-group">
				          	<label for="countryPopulation">Населениие страны (единиц)</label>
				          	<input type="text" name="countryPopulation" class="form-control" id="countryPopulation" placeholder="Введите количество человек, проживающих в стране">
				        </div>
				          	<div class="form-group">
				          	<label for="countrySquare">Площадь страны (м<sup>2</sup>)</label>
				          	<input type="text" name="countrySquare" class="form-control" id="countrySquare" placeholder="Введите площадь страны">
				        </div>
				        <div class="form-group">
				          	<select name="countryContinent" class="form-control" required>
				          		<?
				          			$continents = Continent::all();
				          		?>
				          		<?foreach($continents as $continent):?>
				          			<option value="<?=$continent->id?>"><?=$continent->name?></option>
				          		<?endforeach;?>					       
					            <option disabled selected>Выберите материк*</option>
				          	</select>
				        </div>
				        <button type="submit" class="btn btn-primary">Добавить</button>
			    		<button type="button" id="show-btn-form" class="btn btn-light">Перейти к списку стран</button>
				    	
			     	</form>
		      	</div>
		      	<div id="table-container">
		      		<h2>Список стран</h2>
			      	<table id="table" class="table">
				        <thead>
				          	<tr>
					            <th scope="col">#</th>
					            <th scope="col">Название</th>
					            <th scope="col">Население (единиц)</th>
					            <th scope="col">Площадь (м<sup>2</sup>)</th>
					            <th scope="col">Материк</th>
				          	</tr>
				        </thead>
				        <tbody>
				          	
			        	</tbody>
			      	</table>
			      	<div class="col-sm-6 col-md-2 col-lg-3 col-xs-12">
			    		<button type="button" id="add-country-btn-table" class="btn btn-primary">Добавить страну</button>
					</div>
		      	</div>
		    </div>
		    <footer>
		    	<div class="container">
		    		<h3 class="footer-text">Добавление и просмотр стран</h3>
		    	</div>
		    </footer>
	    </div>
	    <script src="js/jquery.min.js"></script>
	    <script src="js/tether.min.js"></script>
	    <script src="js/bootstrap.min.js"></script>
	    <script src="js/script.js"></script>
  	</body>
</html>