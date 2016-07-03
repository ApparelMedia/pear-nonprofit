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
    $query = str_replace(' ', ' & ', $query);
    $tsQuery = 'to_tsquery(\'' . $query . '\')';

    $orgs = \App\Nonprofit::whereRaw('nonprofit_vector @@ ' . $tsQuery)->orderByRaw('ts_rank_cd( nonprofit_vector,' . $tsQuery . ') desc')->limit(100)->get();
    return json($getOrgsJson($orgs));
});

