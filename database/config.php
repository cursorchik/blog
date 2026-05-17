<?php

use BridgeSQL\BridgeSQL;

$dbConfig = [
	'driver'   => 'mysql',
	'host'     => 'mysql',
	'dbname'   => 'blog',
	'username' => 'root',
	'password' => 'root',
	'charset'  => 'utf8mb4'
];

return new BridgeSQL($dbConfig);