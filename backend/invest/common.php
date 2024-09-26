<?php
/*
 * Name         : common.php
 * Project      : Simple Invest
 * Description  : Common functionalities for the API scripts
 *
 * Author       : xbilko03
 */

require '../vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\ExpiredException;

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

/* Handle preflight requests */
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS')
{
    http_response_code(200);
    exit;
}

$jwtSecretKey = 'testKey';

/* Perform JWT check unless accessing authenticate.php */
if (basename($_SERVER['SCRIPT_NAME']) !== 'authenticate.php')
{
    $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

    if ($authHeader)
    {
        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches))
        {
            $token = $matches[1];
            try
            {
                $decoded = JWT::decode($token, $jwtSecretKey, ['HS256']);
            }
            catch (ExpiredException $e)
            {
                http_response_code(401);
                echo json_encode(['error' => 'Token has expired.']);
                exit;
            }
            catch (Exception $e)
            {
                http_response_code(401);
                echo json_encode(['error' => 'Unauthorized access.']);
                exit;
            }
        }
        else
        {
            http_response_code(401);
            echo json_encode(['error' => 'Invalid Authorization header format.']);
            exit;
        }
    }
    else
    {
        http_response_code(401);
        echo json_encode(['error' => 'Authorization header not found.']);
        exit;
    }
}
?>
