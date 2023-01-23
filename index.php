<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key = getenv("COMMUNITY_JWT_KEY");

function generate_key($email, $name)
{
	global $key;

	// 86400 is 1 day in seconds
	$payload = [
		'email' => $email,
		'name' => $name,
		'iat' => floor(microtime(true)),
		'exp' => floor(microtime(true) + 86400)
	];

	return JWT::encode($payload, $key, 'HS256');
}

function decode_key($jwt)
{
	global $key;

	$decoded = JWT::decode($jwt, new Key($key, 'HS256'));
	return (array) $decoded;
}
