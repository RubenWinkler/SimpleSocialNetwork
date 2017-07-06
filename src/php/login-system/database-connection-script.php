<?php

$config = require __DIR__ . "/../../../config/app.php";

$driver = $config["database"]["driver"];
$host = $config["database"]["host"];
$dbname = $config["database"]["dbname"];
$charset = $config["database"]["charset"];
$db_username = $config["database"]["username"];
$db_password = $config["database"]["password"];

// Definition der nötigen Parameter zur Datenbankverbindung
$dsn = "{$driver}:host={$host};dbname={$dbname};charset={$charset}";

try {

  // Mit der Datenbank mit dem Benutzer "ruben" verbinden und das generierte Passwort verwenden
  $db = new PDO($dsn, $db_username, $db_password);

  // Seltene Fälle von SQL-Injection werden mit "charset=utf8" (oberhalb) und dem
  // "setAttribute"-Befehl (unterhalb) umgangen.
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  // Error-Mode auf Exception setzen
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Nachricht bei erfolgreicher Verbindung zur Database:
  // echo "<br /><br />Verbindung mit DIVISION Network Database erfolgreich!";

} catch (PDOException $ex) {

    // Nachricht bei fehlgeschlagener Verbindung zur Database
    echo "<br /><br />Verbindung mit DIVISION Network Database fehlgeschlagen!<br />Fehler: " . $ex->getMessage();
}

?>
