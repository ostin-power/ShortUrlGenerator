<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

/**
 * APIs for direct redirections
*/
$router->get('/{url}', 'ShorterController@redirection');

/**
 * APIs groups for shortened url
 *
 * @method GET      return all url generated
 * @method POST     return a created short url
 * @method DELETE   delete a url previously generated
 */
$router->group(['prefix' => 'api'], function() use ($router){
    $router->get('/shortened', 'ShorterController@index');
    $router->post('/shortened', 'ShorterController@create');
    $router->delete('/shortened', 'ShorterController@delete');
});

/**
 * APIs groups for counter redirections
 *
 * @method GET      all  : return all url redirections count
 * @method GET      $url : return a specific url redirection count
 */
$router->group(['prefix' => 'api/counter'], function() use ($router){
    $router->get('/all', 'ShorterController@allCount');
    $router->get('/{url}', 'ShorterController@singleCount');
});
