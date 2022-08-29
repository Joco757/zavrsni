<?php
$servername = "mysql.skole.hr";
$username = "user1464204";
$password = "sWL5NA5x";
$basename = "test-marko-muhvic-zg";
$charset = 'utf8mb4';

$dsn = "mysql:host=$servername;dbname=$basename;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($dsn, $username, $password, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>