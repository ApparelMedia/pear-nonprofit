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

$app->get('/test', function () use ($app) {
    $message = "✔️ Clean Url is working (because you see this message) <br>";

    if (!extension_loaded('zip')) {
        $message .= "❌ PHP Zip extension is not loaded <br>";
    } else {
        $message .= "✔️ PHP Zip extension is loaded <br>";
    }

    if( ! app('db')->connection()->getDatabaseName())
    {
        $message .= "❌ DB isn't connected <br>";
    } else {
        $message .= "✔️ DB name is " . app('db')->connection()->getDatabaseName() . ". <br>";
    }

    return view('basic', ['content' => $message]);
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
    $orgs = \App\Nonprofit::selectRaw('*, ' . $matchExp . ' as score')
        ->whereRaw($matchExp)
        ->orderBy('score', 'desc')
        ->limit(100)
        ->get();
    return json($getOrgsJson($orgs));
});

$app->get('api/nonprofits/validate/ein', function () use ($app) {
    $ein = $app->make('request')->query('q');
    $orgExists = \App\Nonprofit::query()->where('ein', $ein)->exists();
    return json(['data' => ['valid' => $orgExists]]);
});
