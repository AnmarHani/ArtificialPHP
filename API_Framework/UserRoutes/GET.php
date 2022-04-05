<?php

require_once('../App/App.php');

require_once('../Controllers/UserController.php');

$route = new Route();

$route->call(function($request, $response){getAllUsers($request, $response);});
