<?php namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Nonprofit
 * @package App
 * @property $id
 * @property $ein
 * @property $name
 * @property $deductibility_status_code
 * @property $city
 * @property $state
 * @property $country
 */
class Nonprofit extends Model
{
    public $timestamps = false;
}
