<?php

// Configuración para CORS y sesiones
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $this->logger->info("add / ");

    //Obtener desde las settings el origin con permiso para consultar
    $origin = $this->get('settings')['origin'];
    $this->logger->info($origin);

    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', $origin)
            ->withHeader('Access-Control-Allow-Credentials', 'true')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

// Rutas
$app->get('/', function ($request, $response, $args) {
    $this->logger->info("get / ");
    $respuesta = $this->IndexController->saludar($request);
    $response->getBody()->write($respuesta);
    return $response;
});
$app->get('/token', function ($request, $response, $args) {
    $this->logger->info("get /token ");
    $respuesta = $this->TweetController->obtenerToken($request);
    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->withJson($respuesta);
});
$app->get('/tweets', function ($request, $response, $args) {
    $this->logger->info("get /tweets ");
    $respuesta = $this->TweetController->obtenerTweets($request);
    return $response->withStatus(200)
        ->withHeader('Content-Type', 'application/json')
        ->withJson($respuesta);
});
//http://docs.slimframework.com/request/body/slim-3-how-to-get-all-get-put-post-variables
//http://stackoverflow.com/questions/32668186/