<?php
/*
 * Name         : authenticate.php
 * Project      : Simple Invest
 * Description  : API script to handle the authentication of a user
 *
 * Author       : xbilko03
 */

require 'common.php';
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

/* Check to reject anything except POST */
if ($_SERVER['REQUEST_METHOD'] !== 'POST')
{
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

/* Read and decode the JSON data from the request */
$data = json_decode(file_get_contents('php://input'), true);
if (json_last_error() !== JSON_ERROR_NONE)
{
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

/* Get username and password */
$username = trim($data['username'] ?? '');
$password = trim($data['password'] ?? '');
$csvFile = '../private/users.csv';
$delimiter = ';';

/* Check to ensure users file is there */
if (!file_exists($csvFile) || !is_readable($csvFile))
{
    http_response_code(404);
    echo json_encode(['error' => 'File not found or not readable.']);
    exit;
}

/* Read the users file */
if (($handle = fopen($csvFile, 'r')) !== FALSE)
{
    $headers = fgetcsv($handle, 1000, $delimiter);

    if ($headers === FALSE)
    {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to read CSV headers.']);
        fclose($handle);
        exit;
    }

    /* Find the user */
    while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
    {
        if (empty(array_filter($row)))
        {
            continue;
        }
        $userData = array_combine($headers, $row);
        if ($userData === FALSE)
        {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to combine headers and row.']);
            fclose($handle);
            exit;
        }
        /* Generate JWT if credentials match */
        if (trim($userData['username']) === $username && trim($userData['password']) === $password)
        {
            $user = [
                'id' => $userData['id'],
                'username' => $userData['username'],
                'role' => $userData['role']
            ];
            $payload = [
                'iat' => time(),
                'exp' => time() + 3600,
                'data' => $user
            ];
            $jwt = JWT::encode($payload, $jwtSecretKey);
            echo json_encode(['success' => true, 'token' => $jwt]);
            fclose($handle);
            exit;
        }
    }
    fclose($handle);
}

/* If no matching user found */
http_response_code(401);
echo json_encode(['success' => false, 'error' => 'Invalid username or password.']);
?>
