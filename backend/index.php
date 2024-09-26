<?php
/*
 * Name         : index.php
 * Project      : Simple Invest
 * Description  : Main entry point for handling API requests and routing them to specific scripts
 *
 * Author       : xbilko03
 */

/* Function to send a JSON response with a status and data */
function sendJsonResponse($status, $data)
{
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($data);
}

/* Function to route incoming requests to the selected PHP script */
function routeRequest($uri)
{
    /* Map of available routes to their corresponding PHP scripts */
    $routes = [
        '/invest/add.php',
        '/invest/delete.php',
        '/invest/authenticate.php',
        '/invest/download.php',
        '/invest/get.php',
        '/invest/update.php',
        '/invest/upload.php',
    ];

    /* Check if the requested URI is valid */
    if (in_array($uri, $routes)) {
        include $uri;
    } else {
        /* Error handle */
        sendJsonResponse(404, ["error" => "Resource not found."]);
    }
}

/* Fix URI */
$requestUri = htmlspecialchars($_SERVER['REQUEST_URI']);
$requestUri = strtok($requestUri, '?');

 /* Route the request based on the URI */
routeRequest($requestUri);
?>
