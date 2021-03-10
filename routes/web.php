<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

$router->get('/', function () {
    return 'Service ist über die POST Methode erreichbar. <br> Pfad: /(?tage={tage}); POST-Payload: { "datum": 123456789 [UNIX-Timestamp] }';
});

$router->post('/', function (\Illuminate\Http\Request $request) {
    $this->validate($request, [
        'tage' => ['numeric'],
        'datum' => ['required', 'numeric']
    ]);
    $message = '';
    $days = $request->get('tage');

    $timestamp = empty($days) ? time() : strtotime("+$days days", time());
    $givenTimestamp = (int) $request->get('datum');

    if ($givenTimestamp <= $timestamp) {
        $timestampString = gmdate("d.m.Y", $timestamp);
        $message = "Das eingegebene Datum muss nach dem $timestampString liegen";
    }


    return new JsonResponse(['nachricht' => $message]);
});
