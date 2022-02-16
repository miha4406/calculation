<?php
declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

   

    $app->post('/squared', function (Request $request, Response $response) {
        $link = mysqli_connect('localhost', 'root', '', 'network');
        if(!$link){ die("Can't connect!" . mysqli_error);}
        
        $params = $request->getQueryParams();
        $num = $params['number'];       
        $n = mysqli_prepare($link, "INSERT INTO results(name,result) VALUES (?,?)");
        $name = "squared";
        $res = $num*$num;
        mysqli_stmt_bind_param($n, "sd", $name, $res);
        mysqli_stmt_execute($n);

        $response->getBody()->write('Number square is ' . $res);
        return $response;
    });

    $app->post('/cube', function (Request $request, Response $response) {
        $link = mysqli_connect('localhost', 'root', '', 'network');
        if(!$link){ die("Can't connect!" . mysqli_error);}
        
        $params = $request->getQueryParams();
        $num = $params['number'];
        $n = mysqli_prepare($link, "INSERT INTO results(name,result) VALUES (?,?)");
        $name = "cube";
        $res = $num*$num*$num;
        mysqli_stmt_bind_param($n, "sd", $name, $res);
        mysqli_stmt_execute($n);

        $response->getBody()->write('Number cube is ' . $res);
        return $response;
    });

    $app->post('/area_circle', function (Request $request, Response $response) {
        $link = mysqli_connect('localhost', 'root', '', 'network');
        if(!$link){ die("Can't connect!" . mysqli_error);}
        
        $params = $request->getQueryParams();
        $num = $params['number'];
        $n = mysqli_prepare($link, "INSERT INTO results(name,result) VALUES (?,?)");
        $name = "area_circle";
        $res = $num*$num*3.14;
        mysqli_stmt_bind_param($n, "sd", $name, $res);
        mysqli_stmt_execute($n);

        $response->getBody()->write('Number-radius circle area is ' . $res);
        return $response;
    });











};
