<?php

const HEALTH_FILE = '/tmp/healthy';

if (file_exists(HEALTH_FILE)) {
    unlink(HEALTH_FILE);
}


include('src/Exporter.php');

$manticoreHost = getenv('MANTICORE_HOST');
$manticorePort = getenv('MANTICORE_PORT');

try {
    $mysql = new mysqli($manticoreHost . ":" . $manticorePort);
} catch (Exception $exception) {
    echo "Can't connect to Manticore Search at $manticoreHost:$manticorePort\n\n";
    exit(1);
}


$exporter = new Exporter($mysql);
$exporter->drawMetrics();
