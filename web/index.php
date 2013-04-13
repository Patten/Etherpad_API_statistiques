<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

include('apiTp.php');
$app->get('/hello/{q}', function($q) {
    return 'Hello!'.$q;
});

$app->get('/apiStats/stats', function() {
	$api = new ApiTp();

    return $api->nbWords();
});

//Exemple de chemin : http://localhost/api/api_stats/silex/web/index.php/texts/10.40.75.119/9001/boby/JrtaylTYVpCLvxagurJaQT5JUNZE09Hf/stats/count/words
$app->get('/apiStats/texts/{ip}/{port}/{padId}/{secretKey}/stats/count/words', function($ip, $port, $padId, $secretKey) {
	$api = new ApiTp($ip, $port, $padId, $secretKey);

    return $api->nbWords();
});

//Exemple de chemin : http://localhost/api/api_stats/silex/web/index.php/texts/10.40.75.119/9001/boby/JrtaylTYVpCLvxagurJaQT5JUNZE09Hf/stats/count/chars
$app->get('/apiStats/texts/{ip}/{port}/{padId}/{secretKey}/stats/count/chars', function($ip, $port, $padId, $secretKey) {
	$api = new ApiTp($ip, $port, $padId, $secretKey);

    return $api->nBChars();
});

//Exemple de chemin : http://localhost/api/api_stats/silex/web/index.php/texts/10.40.75.119/9001/boby/JrtaylTYVpCLvxagurJaQT5JUNZE09Hf/stats/longest
$app->get('/apiStats/texts/{ip}/{port}/{padId}/{secretKey}/stats/longest', function($ip, $port, $padId, $secretKey) {
	$api = new ApiTp($ip, $port, $padId, $secretKey);

    return $api->longuestWord();
});

//Exemple de chemin : http://localhost/api/api_stats/silex/web/index.php/texts/10.40.75.119/9001/boby/JrtaylTYVpCLvxagurJaQT5JUNZE09Hf/stats/mostRepeated
$app->get('/apiStats/texts/{ip}/{port}/{padId}/{secretKey}/stats/mostRepeated', function($ip, $port, $padId, $secretKey) {
	$api = new ApiTp($ip, $port, $padId, $secretKey);

    return $api->getRepeatedWord($api->getAllTextByPad());
});



$app->run();
