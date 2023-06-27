<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "kaicms";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // $name = $_POST["name"];
    // $email = $_POST["email"];
    // $user_password = $_POST["password"];
    // $role = $_POST["role"];
    // $qms_code = $_POST["qms_code"];
    // $ems_code = $_POST["ems_code"];
    // $ohsms_code = $_POST["ohsms_code"];

    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $user_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $role = mysqli_real_escape_string($conn, $_POST["role"]);
    $qms_code = $_POST["qms_code"];
    $ems_code = $_POST["ems_code"];
    $ohsms_code = $_POST["ohsms_code"];

    echo "Name: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Password: " . $user_password . "<br>";
    echo "Role: " . $role . "<br>";
    print_r($qms_code);
    print_r($ems_code);
    print_r($ohsms_code);

    // $qms_code_str = implode(",", $qms_code);
    // $ems_code_str = implode(",", $ems_code);
    // $ohsms_code_str = implode(",", $ohsms_code);

    $qms_code_str = mysqli_real_escape_string($conn, implode(",", $qms_code));
    $ems_code_str = mysqli_real_escape_string($conn, implode(",", $ems_code));
    $ohsms_code_str = mysqli_real_escape_string($conn, implode(",", $ohsms_code));


    $sql = "INSERT INTO user (name, email, password, role, qms_code, ems_code, ohsms_code) VALUES ('".$name."', '".$email."', '".$user_password."', '".$role."', '".$qms_code_str."', '".$ems_code_str."', '".$ohsms_code_str."')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
        alert('심사원 등록이 완료되었습니다.');
        self.location.href='index.php';
        </script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }

    $conn->close();
?>