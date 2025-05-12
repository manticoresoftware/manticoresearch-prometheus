<?php

const HEALTH_FILE = '/tmp/healthy';

if (file_exists(HEALTH_FILE)) {
    unlink(HEALTH_FILE);
}


include('src/Exporter.php');
header('Content-Type: text/plain');

$manticoreHost = getenv('MANTICORE_HOST');
$manticorePort = getenv('MANTICORE_PORT');

try {
    $mysql = new mysqli($manticoreHost . ":" . $manticorePort);
} catch (Exception $exception) {
    throw new RuntimeException("Can't connect to Manticore Search at $manticoreHost:$manticorePort");
}


$exporter = new Exporter($mysql);
$exporter->drawMetrics();
