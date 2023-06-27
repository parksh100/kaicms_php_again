<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "kaicms";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // $id = $_GET["id"];

    $id = $_POST["id"];
    echo $id;
    
    $result = $conn->query("SELECT * FROM user WHERE id=" . $id);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $name = htmlspecialchars($row["name"]);
        $email = htmlspecialchars($row["email"]);
        $role = htmlspecialchars($row["role"]);
        $qms_code = htmlspecialchars($row["qms_code"]);
        $ems_code = htmlspecialchars($row["ems_code"]);
        $ohsms_code = htmlspecialchars($row["ohsms_code"]);
    } else {
        echo "No user found";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $user_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $role = htmlspecialchars($_POST["role"]);
        $qms_code_str = htmlspecialchars(implode(",", $_POST["qms_code"]));
        $ems_code_str = htmlspecialchars(implode(",", $_POST["ems_code"]));
        $ohsms_code_str = htmlspecialchars(implode(",", $_POST["ohsms_code"]));

        $stmt = $conn->prepare("UPDATE user SET name=?, email=?, password=?, role=?, qms_code=?, ems_code=?, ohsms_code=? WHERE id=?");
        $stmt->bind_param("sssssssi", $name, $email, $user_password, $role, $qms_code_str, $ems_code_str, $ohsms_code_str, $id);

        if ($stmt->execute()) {
            header("Location: list_user.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
?>