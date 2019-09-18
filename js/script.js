//добавление страны
$("#addCountryForm").submit(function (event) {
	event.preventDefault();

	let countryName = $('#countryName').val();
	let countryPopulation = $('#countryPopulation').val();
	let countrySquare = $('#countrySquare').val();

	if(countryPopulation && !isInteger(countryPopulation))
	{
		alert("Население страны указано неккоректно");
		return;
	}

	if(countrySquare && !isInteger(countrySquare))
	{
		alert("Площадь страны указана неккоректно");
		return;
	}

	$.ajax({
         type: $(this).attr('method'),
         url: $(this).attr('action'),
         data: $("#addCountryForm").serialize(),
         success: function(data) {
         	let res = JSON.parse(data);
         	if(res['errors'])
         	{
     			errorAdding();
     			return;
         	}

            successAdding()
         },
         error: function(){
         	errorAdding();
         }
     });

    this.reset();
	showMenu();

	return false; 
});

let menu = $("#menu-container");
let form = $("#add-country-form-container");
let table = $("#table-container");
let showTableBtn = $("#show-btn");
let showFormBtn = $("#add-country-btn");
let showFormBtnTable = $("#add-country-btn-table");
let showTableBtnForm = $("#show-btn-form");

showTableBtn.click(showTable);
showFormBtn.click(showForm);
showFormBtnTable.click(showForm);
showTableBtnForm.click(showTable);

function isInteger(num) {
	if (num-Math.floor(num)==0 && num>0){
		return true;
	} else {
		return false;
	}
}

//замена болок страницы
function showMenu(){
	$("#menu-container").css('display', 'block');
	$("#add-country-form-container").css('display', 'none');
	$("#table-container").css('display', 'none');
}

function showForm(){
	$("#menu-container").css('display', 'none');
	$("#add-country-form-container").css('display', 'block');
	$("#table-container").css('display', 'none');
}

function showTable(){
	$("#menu-container").css('display', 'none');
	$("#add-country-form-container").css('display', 'none');
	$("#table-container").css('display', 'block');

	getCountries();
}
//вывод сообщение о добавлении страны
function successAdding(){
	$("#menu-container .alert").remove();
	$("#menu-container").prepend("<div class='alert alert-success' role='alert'>Страна добавлена</div>");
}

function errorAdding(){
	$("#menu-container .alert").remove();
	$("#menu-container").prepend("<div class='alert alert-danger' role='alert'>Ошибка! Страна не добавлена</div>");
}
//запрос на получение стран
function getCountries(){
	$.ajax({
         type: "get",
         url: "/get-countries.php",
         success: function(data) {
            console.log(data);
			showCountries(JSON.parse(data));
         },
         error: function(){
         	errorAdding();
         }
     });
}
//отображение стран
function showCountries(countries){
	let tableContent = $('#table tbody').empty();
	for(let i=0; i<countries.length; i++){
		let name = countries[i].name;
		let population = countries[i].population?parseInt(countries[i].population):"не указано"; 
		let square = countries[i].square?parseInt(countries[i].square):"не указано";
		let continent = countries[i].continent;
		tableContent.append(`<tr><th scope="row">${i+1}</th><td>${htmlDecode(name)}</td>
			<td>${population.toLocaleString('ru-RU')}</td><td>${square.toLocaleString('ru-RU')}</td><td>${continent.name}</td></tr>`);
	}
}

function htmlDecode(entity)
{
  	return $("<div/>").text(entity).html();  
}
