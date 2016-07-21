<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$getOrgsJson = function ($orgs) {
    $fractal = new \League\Fractal\Manager();
    $resource = new \League\Fractal\Resource\Collection($orgs, new \App\Transformers\NonprofitTransformer());
    return $fractal->createData($resource)->toJson();
};

$app->get('/', function () use ($app) {
    return view('home');
});

$app->get('/api/nonprofits', function () use ($app, $getOrgsJson) {
    $orgs = \App\Nonprofit::all();
    return json($getOrgsJson($orgs));
});

$app->get('/api/nonprofits/search', function () use ($app, $getOrgsJson) {
    $query = $app->make('request')->query('q');
    $queries = explode(' ', $query);
    
    $processedQuery = implode(' ', array_map(function ($query) {
        $query = strtolower($query);
        if (in_array($query,\Axisofstevil\StopWords\Words::$basic_words)) {
            return $query;
        }
        return '+' . $query;
    }, $queries));

    $matchExp = 'MATCH(name,city,ein) AGAINST(\'' . $processedQuery . '\' IN BOOLEAN MODE)';
    app('log')->info($matchExp);
    $orgs = \App\Nonprofit::selectRaw('*, ' . $matchExp . ' as score')
        ->whereRaw($matchExp)
        ->orderBy('score', 'desc')
        ->limit(100)
        ->get();
    return json($getOrgsJson($orgs));
});

