<!-- list_user.php -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>User Information</title>
</head>

<body>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">QMS Code</th>
                    <th scope="col">EMS Code</th>
                    <th scope="col">OHSMS Code</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "root";
                    $dbname = "kaicms";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $stmt = $conn->prepare("SELECT * FROM user");
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                      while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . htmlspecialchars($row["id"]). "</th>";
                        echo "<td><a href='update_user.php?id=".htmlspecialchars($row["id"])."'>" . htmlspecialchars($row["name"]). "</a></td>";
                        echo "<td>" . htmlspecialchars($row["email"]). "</td>";
                        echo "<td>" . htmlspecialchars($row["role"]). "</td>";
                        echo "<td>" . htmlspecialchars($row["qms_code"]). "</td>";
                        echo "<td>" . htmlspecialchars($row["ems_code"]). "</td>";
                        echo "<td>" . htmlspecialchars($row["ohsms_code"]). "</td>";
                        echo "</tr>";
                      }
                    } else {
                      echo "0 results";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>