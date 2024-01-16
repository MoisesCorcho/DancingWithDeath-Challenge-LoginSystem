<?php

declare(strict_types=1);

require __DIR__ . "/vendor/autoload.php";

use src\libraries\RefreshTokenGateway;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$refresh_token_gateway = new RefreshTokenGateway($_ENV["SECRET_KEY"]);

echo $refresh_token_gateway->deleteExpired(), "\n";