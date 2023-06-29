<?php
// database connection settings
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "kaicms";

// create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// get data from form
$email = $_POST['input_email'];
$password = $_POST['input_pwd'];

echo $email. "<br>";
echo $password. "<br>";

// protect against SQL injection
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

// query database for user
$sql = "SELECT * FROM user WHERE email = '$email'";
echo $sql. "<br>";
$result = $conn->query($sql);
print_r($result);
echo "<br>";

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    // verify password
    echo "db에 저장된 비밀번호:". $row["password"]. "<br>";
    echo gettype($row["password"]). "<br>"; // string 12345
    echo "입력한 비밀번호:". $password. "<br>";
    echo gettype($password). "<br>"; // string 12345
    // if (password_verify($password, $row["user_pwd"])) {
    if ($password == $row["password"]) {
        
      // Password is correct, so start a new session
      session_start();
      
      // Store data in session variables
      $_SESSION["loggedin"] = true;
      $_SESSION["id"] = $row["id"];
      $_SESSION["email"] = $email;   
      $_SESSION["role"] = $row["role"];
      $_SESSION["name"] = $row["name"];   
      
     
      echo "<script>
      alert('로그인 되었습니다.');
      location.href='list_user.php';
      </script>";
      // Redirect user to welcome page
    //   header("location: list_user.php");
    } else {
      // Display an error message if password is not valid
      $password_err = "The password you entered was not valid.";
        echo "<script>
        alert('비밀번호가 일치하지 않습니다.');
        location.href='login.php';
        </script>";
    }
  }
} else {
  echo "<script>
    alert('회원정보가 없습니다.');
    location.href='login.php';
    </script>";
}
$conn->close();
?>