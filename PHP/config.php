<?php

$pdo = null;
/**
 * Функция соединения с базой данных
 */
function connection () {
    global $pdo;
    if (is_null($pdo)) {
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $dsn = getenv('DATABASE_URL');
        $database_connection = parse_url($dsn);

        $host = $database_connection['host'];
        $port = $database_connection['port'];
        $user = $database_connection['user'];
        $pass = $database_connection['pass'];
        $database = ltrim($database_connection['path'], '/');

        try {
            $pdo_dsn = 'pgsql:host='.$host.';port='.$port.';dbname='.$database;
            $pdo = new PDO($pdo_dsn, $user, $pass, $opt);
        } catch (PDOException $exception) {
            die('нету подключения к базе данных');
        }
    }
    return $pdo;
}