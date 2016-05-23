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

$app->get('/test', function () {
    return 'here!!!';
});

$app->get('/api/dispatch', function () use ($app) {
    dispatch(new \App\Jobs\LoadNonprofitTableJob(config('data.filePath')));
});

$app->get('/api/upload', function () use ($app) {
    $csv = new \App\Processors\FileProcessor(config('data.filePath'), 0, 100);
    $csv->importToDatabase();
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
//    $orgs = $app->make('db')->select('SELECT * FROM nonprofits WHERE document_text @@ to_tsquery(\'' . $query . '\')'); // or to_tsvector(city) @@ to_tsquery(\'' . $query . ':*\') ');
//    return var_dump($orgs);
    return json($getOrgsJson($orgs));
});

