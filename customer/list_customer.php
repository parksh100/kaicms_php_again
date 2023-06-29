<?php
session_start();


include '../db/dbconfig.php';

// get all customers from database
$sql = "SELECT * FROM customer";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Create Customer Form</title>
    <!-- Import Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Import jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

</head>

<body>

    <h1 class="text-center mb-5 mt-5">고객리스트</h1>
    <table class="table table-striped container">
        <thead>
            <tr>
                <th>회사명</th>
                <th>고객유형</th>
                <th>종업원수</th>
                <th>인증범위</th>
                <th>심사원명</th>
                <th>고객상태</th>
                <th>등록일</th>
                <th>심사신청</th>
                <th>비고</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($customers as $customer_item): ?>
            <tr>
                <td><a
                        href="http://localhost:8888/kaicms_php/customer/detail_customer.php?id=<?= $customer_item['customer_id'] ?>"><?= $customer_item['name_ko'] ?></a>
                </td>
                <td><?= $customer_item['customer_type'] ?></td>
                <td><?= $customer_item['employee_number'] ?></td>
                <td><?= $customer_item['scope_ko'] ?></td>
                <td><?= isset($_SESSION['name']) ? $_SESSION['name'] : '' ?></td>
                <td><?= $customer_item['status'] ?></td>
                <td><?= $customer_item['created_at'] ?></td>
                <td><a href="http://localhost:8888/kaicms_php/audit/application_form.php?id=<?= $customer_item['customer_id'] ?>"
                        class="text-decoration-none">심사신청</a>
                <td><?= $customer_item['memo'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>







    </table>




</body>

</html>