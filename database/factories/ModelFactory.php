<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Nonprofit::class, function ($faker) {
    return [
        'ein' => uniqid(),
        'name' => $faker->company,
        'city' => $faker->city,
        'state' => $faker->state,
        'country' => $faker->country,
        //https://www.irs.gov/Charities-%26-Non-Profits/Exempt-Organizations-Select-Check:-Deductibility-Status-Codes
        'deductibility_status_code' => $faker->randomElement(['PC', 'POF', 'PF', 'GROUP', 'LODGE', 'UNKWN', 'EO', 'FED', 'FORGN', 'SO', 'SONFI', 'SOUNK', 'EO,GROUP,LODGE', 'EO,GROUP']),
    ];
});
