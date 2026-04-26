<?php

require_once __DIR__ . '/helper.php';

$mysql_host = envValue('DB_HOST', 'mysql');

// TODO: use your credentials here
$mysql_user = envValue('DB_USER', 'myapp_user');
$mysql_pass = envValue('DB_PASS', '');
$mysql_db = envValue('DB_NAME', 'myapp');

