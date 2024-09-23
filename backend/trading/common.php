<?php
/*
* Name         : common.php
* Project      : Simple Invest
* Description  : Common functionalities for the API scripts
*
* Author       : xbilko03
*/

/* CORS settings */
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, X-API-KEY, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

/* Security */
$expectedApiKey = 'security-key-69420';

/* Get HTTP headers */
$rawHeaders = apache_request_headers();

/* Change to lowercase */
$headers = array_change_key_case($rawHeaders, CASE_LOWER);

/* Security key check in headers */
$apiKey = $headers['x-api-key'] ?? '';

/* Error handle */
if ($apiKey !== $expectedApiKey) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized access']);
    exit;
}
?>
