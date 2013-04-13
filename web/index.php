<?php

require_once __DIR__.'/../vendor/autoload.php';
include('apiTp.php');

$app = new Silex\Application();

/*    TOUTES LES ROUTES    */


// La toute première route
$app->get('/apiStats/texts', function() {
    return "Add /Your_IP";
});

$app->get('/apiStats/texts/{ip}', function() {
    return "Add /Your_port";
});

$app->get('/apiStats/texts/{ip}/{port}', function() {
    return "Add /Your_padId";
});

$app->get('/apiStats/texts/{ip}/{port}/{padId}', function() {
    return "Add /The_secret_key_of_your_padId";
});

$app->get('/apiStats/texts/{ip}/{port}/{padId}/{secretKey}', function() {
    return "Add /stats";
});

//le resultat est un fichier json qui listes les fonctions disponibles
$app->get('/apiStats/texts/{ip}/{port}/{padId}/{secretKey}/stats', function() {
    
    $listMethods = "Liste des methodes disponibles :";
    $listMethods .= "<br>/count/chars --> Compte le nombre de caractères que contient le pad";
    $listMethods .= "<br>/count/words --> Compte le nombre de mots que contient le pad";
    $listMethods .= "<br>/longest --> Affiche le mot le plus long du pad et son nombre de caractères";
    $listMethods .= "<br>/mostRepeated --> Affiche pour chaque mot, le nombre de fois qu’il a été répété dans l’eterpad. Les mots sont triés du plus répété au moins répété.";

    return $listMethods;
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
