<?php

include "./db/dbconfig.php";

// get data from form
$email = $_POST['input_email'];
$password = $_POST['input_pwd'];

// query database for user
$sql = "SELECT * FROM user WHERE email = ?";
$stmt= $pdo->prepare($sql);
$stmt->execute([$email]);
$user = $stmt->fetch();

if ($user) {
    // verify password
    if (password_verify($password, $user["password"])) {

        // Password is correct, so start a new session
        session_start();
        
        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $user["id"];
        $_SESSION["email"] = $email;   
        $_SESSION["role"] = $user["role"];
        $_SESSION["name"] = $user["name"];   

        echo "<script>
        alert('로그인 되었습니다.');
        location.href='http://localhost:8888/kaicms_php/customer/list_customer.php';
        </script>";
    } else {
        echo "<script>
        alert('비밀번호가 일치하지 않습니다.');
        location.href='login.php';
        </script>";
    }
} else {
    echo "<script>
    alert('회원정보가 없습니다.');
    location.href='login.php';
    </script>";
}
?>