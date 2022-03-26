<?php

use Project\Pdo\Infraestructure\Conn;
use Project\Pdo\Model\FileReader;

require_once __DIR__ . '/vendor/autoload.php';

$connection = new Conn();

$connection->startConnection();

$file = new FileReader();

$file->readFile();