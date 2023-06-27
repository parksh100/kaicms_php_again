<!-- update_user.php -->

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "kaicms";
$id = $_GET['id'];



$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM user WHERE id=".$id;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
} else {
  echo "No results";
  die();
}
?>


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
        <form method="post" action="update_user_post.php">
            <input type="hidden" name="id" value="<?php echo $row['id']?>">
            <div class="form-group mt-4">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name"
                    value="<?php echo $row['name']?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"
                    value="<?php echo $row['email']?>">
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Enter your password" value="<?php echo $row['password']?>">
            </div>
            <div class="form-group">
                <label>Role:</label><br>
                <?php
                $roles = ["심사원", "선임심사원", "검증심사원", "관리자"];
                foreach ($roles as $role): ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="role" id="role<?php echo $role; ?>"
                        value="<?php echo $role; ?>" <?php echo $row['role']==$role ? 'checked' : '' ?>>
                    <label class="form-check-label" for="role<?php echo $role; ?>"><?php echo $role; ?></label>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="form-group">
                <label>QMS Code:</label><br>
                <?php 
                $code = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10","12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22","23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35","36", "37", "38", "39"];
                $codes_content = ["01(농,수산업)", "02(광업 및 채석업)", "03(음식료 및 담배)", "04(섬유 및 섬유제품)",  "05(가죽 및 가죽제품)",  "06(목재 및 목재제품)",  "07(펄프, 종이, 종이제품)",  "08(출판업)",  "09(인쇄업)",  "10(코크스, 연탄 및 석유정제품 제조업)",  "12(화학물질, 화학제품 및 화학섬유 제조업)",  "13(의료용 물질 및 의약품 제조업)",  "14(고무제품 및 플라스틱제품 제조업)",  "15(비금속 광물제품 제조업)",  "16(콘크리트, 시멘트, 석회 및 플라스터 등 제조업)",  "17(1차 금속 및 금속가공제품 제조업 중 1차 금속 제조업)",  "18(기계 및 장비 제조업)",  "19(전기기기 및 광학기기 제조업)",  "20(조선업)",  "21(항공기 제조업)",  "22(기타 운송장비 제조업)",  "23(기타 제조업)",  "24(재생업)",  "25(전기공급업)",  "26(연료용 가스 공급업)",  "27(수도 및 증기 공급업)",  "28(건설업)",  "29(도소매업, 자동차 및 모터사이클 수리업, 개인 및 가정용품
            수리업)",  "30(숙박업, 음식점업 및 주점업)",  "31(운송업, 창고업 및 통신업)",  "32(금융업, 보험업, 부동산업 및 임대업)",  "33(정보기술업)",  "34(전문, 과학 및 기술서비스업)",  "35(기타 서비스업)",  "36(공공 행정)",  "37(교육 서비스업)",  "38(보건업 및 사회복지 서비스업)",  "39(기타 사회 서비스업)"];
                $qms_codes = explode(',', $row['qms_code']); 
                for ($i = 0; $i < count($codes_content) ; $i++): ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="qms_codes_content<?php echo $i+1; ?>"
                        name="qms_code[]" value="<?php echo $code[$i]; ?>"
                        <?php echo in_array($code[$i], $qms_codes) ? 'checked' : '' ?>>
                    <label class="form-check-label"
                        for="qms_codes_content<?php echo $i+1; ?>"><?php echo $codes_content[$i]; ?></label>
                </div>
                <?php endfor; ?>
            </div>
            <div class="form-group">
                <label>EMS Code:</label><br>
                <?php 
                $ems_codes = explode(',', $row['ems_code']); 
                for ($i = 0; $i < count($codes_content) ; $i++): ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="ems_codes_content<?php echo $i+1; ?>"
                        name="ems_code[]" value="<?php echo $code[$i]; ?>"
                        <?php echo in_array($code[$i], $ems_codes) ? 'checked' : '' ?>>
                    <label class="form-check-label"
                        for="ems_codes_content<?php echo $i+1; ?>"><?php echo $codes_content[$i]; ?>
                    </label>
                </div>
                <?php endfor; ?>
            </div>
            <div class="form-group">
                <label>OHSMS Code:</label><br>
                <?php 
                $ohsms_codes = explode(',', $row['ohsms_code']); 
                for ($i = 0; $i < count($codes_content) ; $i++): ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="ohsms_codes_content<?php echo $i+1; ?>"
                        name="ohsms_code[]" value="<?php echo $code[$i]; ?>"
                        <?php echo in_array($code[$i], $ohsms_codes) ? 'checked' : '' ?>>
                    <label class="form-check-label"
                        for="ohsms_codes_content<?php echo $i+1; ?>"><?php echo $codes_content[$i]; ?></label>
                </div>
                <?php endfor; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="list_user.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>