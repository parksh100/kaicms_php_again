<?php
    $host = 'localhost';
    $db   = 'kaicms';
    $user = 'root';
    $pass = 'root';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    // $pdo = new PDO($dsn, $user, $pass, $opt); 

    // 개발용 디버깅이나 테스트용으로 사용할 때는 아래 코드를 사용한다.
    try {
        $pdo = new PDO($dsn, $user, $pass, $opt);
        echo "Database connection successful!";
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
    }
    ?>