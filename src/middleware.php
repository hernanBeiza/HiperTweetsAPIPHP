<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);
/*
$app->add(new \Slim\Middleware\JwtAuthentication([
    "path" => "/api",
    "secret" => $container->get('secret'),
	"attribute" => "jwt",
    "secure" => false,
    "callback" => function ($request, $response, $arguments) use ($container) {
		//error_log("middleware callback");

		foreach ($request as $key => $value) {
			error_log($key." ".$value);
		}

		foreach ($response as $key => $value) {
			error_log($key." ".$value);
		}
    },
    "error" => function ($request, $response, $arguments) {
		error_log("middleware error");

		foreach ($arguments as $key => $value) {
			error_log($key." ".$value);
		}

		foreach ($request as $key => $value) {
			error_log($key." ".$value);
		}

		foreach ($response as $key => $value) {
			error_log($key." ".$value);
		}

	    //return new UnauthorizedResponse($arguments["message"], 401);
        $respuesta = array(
            "result"=>false,
            "errores"=>$arguments["message"]
        );

        return $response
	        ->withStatus(401)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($respuesta, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
	}
]));
*/
//https://github.com/tuupola/slim-jwt-auth/issues/25
//Si llega el "token" por parámetro GET o POST
/*
$app->add(function($request, $response, $next) {
    if(isset($request->getQueryParams()["token"])){
		$token = $request->getQueryParams()["token"];
		//error_log("middleware GET token ".$token);

    } else if (isset($request->getParsedBody()["token"])){
		$token = $request->getParsedBody()["token"];
		//error_log("middleware POST token ".$token);
    }

    if (false === empty($token)) {
        $request = $request->withHeader("Authorization", "Bearer {$token}");
    }

    return $next($request, $response);
});
*/