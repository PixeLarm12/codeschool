<?php
require 'env.php';

try {
    $database = new PDO($DB_DATABASE . ":host=" . $DB_HOST . ";dbname=" . $DB_NAME . ";port=" . $DB_PORT, $DB_USERNAME, $DB_PASSWORD);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $database;
} catch (PDOException $e) {
    echo $e->getMessage();
}
