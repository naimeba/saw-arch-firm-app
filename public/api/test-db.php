<?php

header('Content-Type: text/plain');

try {
    $pdo = new PDO(
        "mysql:host=mysql;dbname=nbaarch;charset=utf8mb4",
        "nbaarch",
        "ang00riaP3raM3la!",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    echo "Connessione DB OK\n";

    $stmt = $pdo->query("SHOW TABLES");
    print_r($stmt->fetchAll(PDO::FETCH_COLUMN));

} catch (Throwable $e) {
    echo "Errore: " . $e->getMessage();
}