<?php

require ('ext/Slim/Slim.php');
require ('ApiModel.php');
error_reporting(-1);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app -> post('/getTotalCategories', function() {
    ApiModel::getInstance() -> getTotalCategories();
});

/****************************** Comics *******************************************/
$app -> post('/getComics', function() {
    ApiModel::getInstance() -> getComics();
});

/****************************** Episodes *******************************************/
$app -> post('/getEpisodes', function() {
    ApiModel::getInstance() -> getEpisodes();
});

/****************************** Panels *******************************************/
$app -> post('/getPanels', function() {
    ApiModel::getInstance() -> getPanels();
});

/****************************** Like/Unlike *******************************************/
$app -> post('/Like_unlike', function() {
    ApiModel::getInstance() -> Like_unlike();
});

/****************************** Save Information *******************************************/
$app -> post('/saveInfo', function() {
    ApiModel::getInstance() -> saveInfo();
});

/****************************** Subscribers *******************************************/
$app -> post('/subscribe', function() {
    ApiModel::getInstance() -> subscribe();
});

$app -> run();