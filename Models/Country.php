<?
namespace App\Models;
use \Illuminate\Database\Eloquent\Model;
use  App\Models\Continent;

class Country extends Model {
	public $timestamps = false;
	protected $fillable = ['name', 'population', 'square'];

	public function continent(){
    	return $this->belongsTo(Continent::class, 'continent_id');
	}

	public static function validate($data)
	{
		$errors=[];

		if (!(isset($data['countryName']) && $data['countryName'] !== '')) {
		    $errors[] = "Введите название страны";
		}

		if($data['countryPopulation']!=''&&!self::isPositiveInt($data['countryPopulation']))
		{
			$errors[] = "Популяция указана неккоректно";
		}

		if($data['countrySquare']!=''&&!self::isPositiveInt($data['countrySquare']))
		{
			$errors[] = "Площадь указана неккоректно";
		}

		if(!Continent::find($data['countryContinent']))
		{
			$errors[] = "Некорректно указан континент";
		}

		return $errors;
	}

	static function isPositiveInt($input)
		{
			$options = array(
			    'options' => array(
			        'min_range' => 0,
			    )
			);

			if(filter_var($input, FILTER_VALIDATE_INT, $options) === false)
				return false;

			return true;
		}
}