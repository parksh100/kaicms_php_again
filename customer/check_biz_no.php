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
    $pdo = new PDO($dsn, $user, $pass, $opt);

    $biz_no = $_POST['biz_no'];


    // prepare SQL statement and bind parameters
    $stmt = $pdo->prepare("SELECT * FROM customer WHERE biz_no = :biz_no");
    $stmt->execute(['biz_no' => $biz_no]);
  
    // Check if business registration number is duplicated
    if ($stmt->rowCount() > 0) {
        // 409 Conflict - The request could not be completed due to a conflict with the current state of the resource.
        http_response_code(409);
        echo 'The business registration number is duplicated.';
    } else {
        // 200 OK - The request has succeeded.
        http_response_code(200);
        echo 'The business registration number is not duplicated.';
    }
?>