<?php
session_start();


include '../db/dbconfig.php';

// Get id from URL
$id = $_GET['id'];
echo $id;

// Get customer details from database
$sql = "SELECT * FROM customer WHERE customer_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$customer = $stmt->fetch();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Customer Info</title>
    <!-- Import Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Import jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

</head>

<body>
    <div class="container">
        <h1 class="mt-5 text-center">고객상세화면</h1>
        <form id="create_customer_form" action="create_customer_process.php" method="post" enctype="multipart/form-data"
            class="mt-5">
            <div class="form-group row mb-3 align-items-center mb-3">
                <label for="customer_type" class="col-sm-3 col-form-label">*고객구분:</label>
                <div class="col-sm-9">
                    <div class="d-flex gap-3 my-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="customer_type" id="new" value="신규"
                                <?php echo ($customer['customer_type']=='신규')?'checked':'' ?> disabled>

                            <label class="form-check-label" for="new">신규</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="customer_type" id="전환" value="전환"
                                <?php echo ($customer['customer_type']=='전환')?'checked':'' ?> disabled>

                            <label class="form-check-label" for="transfer">전환</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 국문상호 -->
            <div class="form-group row mb-3">
                <label for="business_name_ko" class="col-sm-3 col-form-label">*국문상호:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="business_name_ko" name="business_name_ko" required
                        disabled value="<?= $customer['name_ko'] ?>">
                </div>
            </div>

            <!-- 영문상호 -->
            <div class="form-group row mb-3">
                <label for="business_name_en" class="col-sm-3 col-form-label">*영문상호:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="business_name_en" name="business_name_en"
                        placeholder="대소문자 구분, Co., Ltd. , Inc. 등 확인필요" required value="<?= $customer['name_en'] ?>"
                        disabled>
                </div>
            </div>

            <!-- 사업자등록번호 -->
            <div class="form-group row mb-3">
                <label for="business_registration_number" class="col-sm-3 col-form-label">*사업자등록번호:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="business_registration_number"
                        name="business_registration_number" placeholder="번호만 입력하세요" minlength="10" required
                        value="<?= $customer['biz_no'] ?>" disabled>
                </div>
                <div class="col-sm-4 ">
                    <button type="button" class="btn btn-primary" id="check_business_registration_number"
                        disabled>중복확인</button>
                </div>
                <input type="hidden" id="is_duplicated" name="is_duplicated" value="no" disabled>

            </div>

            <!-- 대표자명 -->
            <div class="form-group row mb-3">
                <label for="representative_name" class="col-sm-3 col-form-label">*대표자명:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="representative_name" name="representative_name"
                        value="<?= $customer['ceo_name'] ?>" disabled required>
                </div>
            </div>
            <!-- 대표자 휴대번호 -->
            <div class="form-group row mb-3">
                <label for="representative_phone_number" class="col-sm-3 col-form-label">대표자 휴대번호:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="representative_phone_number"
                        name="representative_phone_number" placeholder="번호만 입력" required
                        value="<?= $customer['ceo_mobile'] ?>" disabled>
                </div>
            </div>
            <!--회사대표 이메일 -->
            <div class="form-group row mb-3">
                <label for="representative_email" class="col-sm-3 col-form-label">*대표 이메일:</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="representative_email" name="representative_email"
                        required value="<?= $customer['email'] ?>" disabled>
                </div>
            </div>
            <!--회사대표 전화번호 -->
            <div class="form-group row mb-3">
                <label for="representative_phone" class="col-sm-3 col-form-label">*대표전화번호:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="representative_phone" name="representative_phone"
                        placeholder="번호만 입력" required value="<?= $customer['phone'] ?>" disabled>
                </div>
            </div>
            <!-- 대표팩스번호 -->
            <div class="form-group row mb-3">
                <label for="representative_fax_number" class="col-sm-3 col-form-label">대표팩스번호:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="representative_fax_number"
                        name="representative_fax_number" placeholder="번호만 입력" value="<?= $customer['fax'] ?>" disabled>
                </div>
            </div>
            <!-- 우편번호 -->
            <div class="form-group row mb-3">
                <label for="postcode" class="col-sm-3 col-form-label">*우편번호:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control bg-light" id="postcode" name="postcode" readonly
                        value="<?= $customer['postcode'] ?>" disabled>
                </div>
                <div class="col-sm-4">
                    <button type="button" class="btn btn-secondary" id="btn_postcode" disabled>우편번호검색</button>
                </div>
            </div>
            <!-- 국문주소 -->
            <div class="form-group row mb-3">
                <label for="address_ko" class="col-sm-3 col-form-label">*국문주소:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control bg-light" id="address_ko" name="address_ko" readonly
                        value="<?= $customer['addr_ko'] ?>" disabled>
                </div>
            </div>
            <!-- 국문상세주소 -->
            <div class="form-group row mb-3">
                <label for="address_detail_ko" class="col-sm-3 col-form-label">국문상세주소:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="address_detail_ko" name="address_detail_ko"
                        value="<?= $customer['addr_ko_detail'] ?>" disabled>
                </div>
            </div>
            <!-- 영문주소 -->
            <div class="form-group row mb-3">
                <label for="address_en" class="col-sm-3 col-form-label">*영문주소:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control bg-light" id="address_en" name="address_en" readonly
                        value="<?= $customer['addr_en'] ?>" disabled>
                </div>
            </div>
            <!-- 영문상세주소 -->
            <div class="form-group row mb-3">
                <label for="address_detail_en" class="col-sm-3 col-form-label">영문상세주소:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="address_detail_en" name="address_detail_en"
                        value="<?= $customer['addr_en_detail'] ?>" disabled>
                </div>
            </div>
            <!-- 담당자명/직위 -->
            <div class="form-group row mb-3">
                <label for="manager_name" class="col-sm-3 col-form-label">*담당자명/직위:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="manager_name" name="manager_name"
                        value="<?= $customer['manager'] ?>" disabled>
                </div>
            </div>
            <!-- 담당자 휴대번호 -->
            <div class="form-group row mb-3">
                <label for="manager_phone_number" class="col-sm-3 col-form-label">*담당자 휴대번호:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="manager_phone_number" name="manager_phone_number"
                        value="<?= $customer['manager_mobile'] ?>" disabled placeholder="번호만 입력" required>
                </div>
            </div>
            <!-- 담당자 이메일 -->
            <div class="form-group row mb-3">
                <label for="manager_email" class="col-sm-3 col-form-label">*담당자 이메일:</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="manager_email" name="manager_email"
                        value="<?= $customer['manager_email'] ?>" disabled>
                </div>
            </div>
            <!-- 홈페이지 -->
            <div class="form-group row mb-3">
                <label for="homepage" class="col-sm-3 col-form-label">홈페이지:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="homepage" name="homepage"
                        value="<?= $customer['homepage'] ?>" disabled>
                </div>
            </div>
            <!-- 조직의 범위 -->
            <div class="form-group row mb-3">
                <label for="scope_of_organization" class="col-sm-3 col-form-label">*조직의 범위:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="scope_of_organization" name="scope_of_organization"
                        value="<?= $customer['organize_scope'] ?>" disabled>
                </div>
            </div>
            <!-- 종업원 수 -->
            <div class="form-group row mb-3">
                <label for="number_of_employees" class="col-sm-3 col-form-label">*종업원 수:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="number_of_employees" name="number_of_employees"
                        value="<?= $customer['employee_number'] ?>" disabled>
                </div>
            </div>
            <!-- 설계/개발유무, 라디오버튼 타입, "있음" 또는 "없음" 중 선택하도록 작성 -->
            <div class="form-group row mb-3">
                <label for="customer_type" class="col-sm-3 col-form-label">*설계/개발 유무:</label>
                <div class="col-sm-9">
                    <div class="d-flex gap-3 my-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="design_dev" id="yes" value="있음"
                                <?php echo ($customer['dev']=='있음')?'checked':'' ?> disabled>
                            <label class="form-check-label" for="yes">있음</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="design_dev" id="no" value="없음"
                                <?php echo ($customer['dev']=='없음')?'checked':'' ?> disabled>
                            <label class="form-check-label" for="no">없음</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 설계/개발 인원수. number type -->
            <div class="form-group row mb-3" id="design_dev_people_group">
                <label for="number_of_designers" class="col-sm-3 col-form-label">설계/개발 인원수:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="number_of_designers" name="number_of_designers"
                        value="<?= $customer['dev_employee'] ?>" disabled>
                </div>
            </div>
            <!-- 국문인증범위, textarea type  -->
            <div class="form-group row mb-3">
                <label for="korean_certification_scope" class="col-sm-3 col-form-label">*국문인증범위:</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="korean_certification_scope" name="korean_certification_scope"
                        value="<?= $customer['scope_ko'] ?>" disabled rows="3"></textarea>
                </div>
            </div>
            <!-- 영문인증범위, textarea type  -->
            <div class="form-group row mb-3">
                <label for="en_certification_scope" class="col-sm-3 col-form-label"><a
                        href="https://translate.google.co.kr/?hl=ko" target="_blank">*영문인증범위:</a></label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="en_certification_scope" name="en_certification_scope"
                        value="<?= $customer['scope_en'] ?>" disabled rows="3"></textarea>
                </div>
            </div>
            <!-- 인증범위 활동, checkbox type  -->
            <div class="form-group row mb-3">
                <label for="activity_scope" class="col-sm-3 col-form-label">*인증범위 활동:</label>
                <div class="col-sm-9 d-flex gap-3">
                    <!-- <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_scope[]" id="design_development"
                            value="설계/개발">
                        <label class="form-check-label" for="design_development">설계/개발</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_scope[]"
                            id="manufacture_production" value="제조/생산">
                        <label class="form-check-label" for="manufacture_production">제조/생산</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_scope[]"
                            id="installation_construction" value="설치/시공">
                        <label class="form-check-label" for="installation_construction">설치/시공</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_scope[]" id="sales_service"
                            value="판매/서비스">
                        <label class="form-check-label" for="sales_service">판매/서비스</label>
                    </div> -->
                    <?php $activity_scope = explode(", ", $customer['activity']); // 데이터베이스에서 받은 문자열을 배열로 변환 ?>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_scope[]" id="design_development"
                            value="설계/개발" <?php echo (in_array('설계/개발', $activity_scope)) ? 'checked' : '' ?> disabled>
                        <label class="form-check-label" for="design_development">설계/개발</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_scope[]"
                            id="manufacture_production" value="제조/생산"
                            <?php echo (in_array('제조/생산', $activity_scope)) ? 'checked' : '' ?> disabled>
                        <label class="form-check-label" for="manufacture_production">제조/생산</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_scope[]"
                            id="installation_construction" value="설치/시공"
                            <?php echo (in_array('설치/시공', $activity_scope)) ? 'checked' : '' ?> disabled>
                        <label class="form-check-label" for="installation_construction">설치/시공</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="activity_scope[]" id="sales_service"
                            value="판매/서비스" <?php echo (in_array('판매/서비스', $activity_scope)) ? 'checked' : '' ?>
                            disabled>
                        <label class="form-check-label" for="sales_service">판매/서비스</label>
                    </div>

                </div>
            </div>
            <!-- iaf code -->

            <div class="form-group row mb-3">
                <label for="qms_codes_content" class="col-sm-3 col-form-label">*IAF Code:</label>
                <div class="col-sm-9 d-flex flex-wrap gap-3">
                    <!-- <?php 
                        $code = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10","12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22","23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35","36", "37", "38", "39"];
                        $codes_content = ["01(농,수산업)", "02(광업 및 채석업)", "03(음식료 및 담배)", "04(섬유 및 섬유제품)",  "05(가죽 및 가죽제품)",  "06(목재 및 목재제품)",  "07(펄프, 종이, 종이제품)",  "08(출판업)",  "09(인쇄업)",  "10(코크스, 연탄 및 석유정제품 제조업)",  "12(화학물질, 화학제품 및 화학섬유 제조업)",  "13(의료용 물질 및 의약품 제조업)",  "14(고무제품 및 플라스틱제품 제조업)",  "15(비금속 광물제품 제조업)",  "16(콘크리트, 시멘트, 석회 및 플라스터 등 제조업)",  "17(1차 금속 및 금속가공제품 제조업 중 1차 금속 제조업)",  "18(기계 및 장비 제조업)",  "19(전기기기 및 광학기기 제조업)",  "20(조선업)",  "21(항공기 제조업)",  "22(기타 운송장비 제조업)",  "23(기타 제조업)",  "24(재생업)",  "25(전기공급업)",  "26(연료용 가스 공급업)",  "27(수도 및 증기 공급업)",  "28(건설업)",  "29(도소매업, 자동차 및 모터사이클 수리업, 개인 및 가정용품
                        수리업)",  "30(숙박업, 음식점업 및 주점업)",  "31(운송업, 창고업 및 통신업)",  "32(금융업, 보험업, 부동산업 및 임대업)",  "33(정보기술업)",  "34(전문, 과학 및 기술서비스업)",  "35(기타 서비스업)",  "36(공공 행정)",  "37(교육 서비스업)",  "38(보건업 및 사회복지 서비스업)",  "39(기타 사회 서비스업)"];
                        for ($i = 0; $i < count($codes_content) ; $i++): ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="iaf_codes_content<?php echo $i+1; ?>"
                            name="iaf_code[]" value="<?php echo $code[$i]; ?>">
                        <label class="form-check-label"
                            for="iaf_codes_content<?php echo $i+1; ?>"><?php echo $codes_content[$i]; ?></label>
                    </div>
                    <?php endfor; ?> -->
                    <!-- <div>
                        {{ customer.iaf_code }}
                        <small class="text-primary">* 인증원의 계약검토를 통해 확정됩니다.</small>
                    </div> -->

                    <?php $iaf_code_db = explode(", ", $customer['iaf_code']); // 데이터베이스에서 받은 문자열을 배열로 변환 ?>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_35" value="01"
                            <?php echo (in_array('01', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_35">01-Q(농,수산업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_36" value="02"
                            <?php echo (in_array('02', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_36">02-Q(광업 및 채석업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_1" value="03"
                            <?php echo (in_array('03', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_1">03-QE(음식료 및 담배)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_2" value="04"
                            <?php echo (in_array('04', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_2">04-Q(섬유 및 섬유제품)</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_3" value="05"
                            <?php echo (in_array('05', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_3">05Q(가죽 및 가죽제품)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_4" value="06"
                            <?php echo (in_array('06', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_4">06-QE(목재 및 목재제품)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_5" value="07"
                            <?php echo (in_array('07', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_5">07-Q(펄프, 종이, 종이제품)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_6" value="08"
                            <?php echo (in_array('08', $iaf_code_db)) ? 'checked' : '' ?> disabled disabled />
                        <label class="form-check-label" for="code_6">08(출판업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_7" value="09"
                            <?php echo (in_array('09', $iaf_code_db)) ? 'checked' : '' ?> disabled disabled />
                        <label class="form-check-label" for="code_7">09(인쇄업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_8" value="10"
                            <?php echo (in_array('10', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_8">10-Q(코크스, 연탄 및 석유정제품 제조업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_9" value="12"
                            <?php echo (in_array('12', $iaf_code_db)) ? 'checked' : '' ?> disabled
                            <?php echo (in_array('12', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_9">12-QE(화학물질, 화학제품 및 화학섬유 제조업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_10" value="13"
                            <?php echo (in_array('13', $iaf_code_db)) ? 'checked' : '' ?> disabled disabled />
                        <label class="form-check-label" for="code_10">13(의료용 물질 및 의약품 제조업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_11" value="14"
                            <?php echo (in_array('14', $iaf_code_db)) ? 'checked' : '' ?> disabled
                            <?php echo (in_array('14', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_11">14-QE(고무제품 및 플라스틱제품 제조업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_12" value="15"
                            <?php echo (in_array('15', $iaf_code_db)) ? 'checked' : '' ?> disabled
                            <?php echo (in_array('15', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_12">15-QE(비금속 광물제품 제조업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_13" value="16"
                            <?php echo (in_array('16', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_13">16-QE(콘크리트, 시멘트, 석회 및 플라스터 등 제조업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_14" value="17"
                            <?php echo (in_array('17', $iaf_code_db)) ? 'checked' : '' ?> disabled
                            <?php echo (in_array('17', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_14">17-QEO(1차 금속 및 금속가공제품 제조업 중 1차 금속 제조업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="code_15" value="18" name="iaf_code[]"
                            <?php echo (in_array('18', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_15">18-QEO(기계 및 장비 제조업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_16" value="19"
                            <?php echo (in_array('19', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_16">19-QEO(전기기기 및 광학기기 제조업)</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_17" value="20"
                            <?php echo (in_array('20', $iaf_code_db)) ? 'checked' : '' ?> disabled disabled />
                        <label class="form-check-label" for="code_17">20(조선업)</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_18" value="21"
                            <?php echo (in_array('21', $iaf_code_db)) ? 'checked' : '' ?> disabled disabled />
                        <label class="form-check-label" for="code_18">21(항공기 제조업)</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_19" value="22"
                            <?php echo (in_array('22', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_19">22-EO(기타 운송장비 제조업)</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_20" value="23"
                            <?php echo (in_array('23', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_20">23-QE(기타 제조업)</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_40" value="24"
                            <?php echo (in_array('24', $iaf_code_db)) ? 'checked' : '' ?> disabled disabled />
                        <label class="form-check-label" for="code_40">24(재생업)</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_21" value="25"
                            <?php echo (in_array('25', $iaf_code_db)) ? 'checked' : '' ?> disabled disabled />
                        <label class="form-check-label" for="code_21">25(전기공급업)</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_22" value="26"
                            <?php echo (in_array('26', $iaf_code_db)) ? 'checked' : '' ?> disabled disabled />
                        <label class="form-check-label" for="code_22">26(연료용 가스 공급업)</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_23" value="27"
                            <?php echo (in_array('27', $iaf_code_db)) ? 'checked' : '' ?> disabled disabled />
                        <label class="form-check-label" for="code_23">27(수도 및 증기 공급업)</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_24" value="28"
                            <?php echo (in_array('28', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_24">28-QEO(건설업)</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_25" value="29"
                            <?php echo (in_array('29', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_25">29-QEO(도소매업, 자동차 및 모터사이클 수리업, 개인 및 가정용품
                            수리업)</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_26" value="30"
                            <?php echo (in_array('30', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_26">30-QE(숙박업, 음식점업 및 주점업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_27" value="31"
                            <?php echo (in_array('31', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_27">31-QE(운송업, 창고업 및 통신업)</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_28" value="32"
                            <?php echo (in_array('32', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_28">32-QEO(금융업, 보험업, 부동산업 및 임대업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_29" value="33"
                            <?php echo (in_array('33', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_29">33-QEO(정보기술업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_41" value="34"
                            <?php echo (in_array('34', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_41">34-QEO(전문, 과학 및 기술서비스업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_30" value="35"
                            <?php echo (in_array('35', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_30">35-QEO(기타 서비스업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_31" value="36"
                            <?php echo (in_array('36', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_31">36-QEO(공공 행정)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_32" value="37"
                            <?php echo (in_array('37', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_32">37-QEO(교육 서비스업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_33" value="38"
                            <?php echo (in_array('38', $iaf_code_db)) ? 'checked' : '' ?> disabled disabled />
                        <label class="form-check-label" for="code_33">38(보건업 및 사회복지 서비스업)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="iaf_code[]" id="code_34" value="39"
                            <?php echo (in_array('39', $iaf_code_db)) ? 'checked' : '' ?> disabled />
                        <label class="form-check-label" for="code_34">39-Q(기타 사회 서비스업)</label>
                    </div>
                </div>
            </div>
            <!-- 제품(서비스)명 및 공정 -->
            <div class="form-group row mb-3">
                <label for="product_service_name" class="col-sm-3 col-form-label">*제품(서비스)명 및 공정:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="product_service_name" name="product_service_name"
                        placeholder="제품(서비스)명 및 공정" value="<?= $customer['name_ko'] ?>" disabled>
                </div>
            </div>
            <!-- 적용제외조항 유무 -->
            <div class="form-group row mb-3">
                <label for="exclusion" class="col-sm-3 col-form-label">*적용제외조항 유무:</label>
                <div class="col-sm-9 d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="exclusion_status_yes" name="exclusion"
                            <?php echo ($customer['customer_type']=='있음')?'checked':'' ?> disabled value="있음">
                        <label class="form-check-label" for="exclusion_status_yes">있음</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="exclusion_status_no" name="exclusion"
                            <?php echo ($customer['customer_type']=='없음')?'checked':'' ?> disabled value="없음">
                        <label class="form-check-label" for="exclusion_status_no">없음</label>
                    </div>
                </div>
            </div>
            <!-- 적용제외조항/근거 -->
            <div class="form-group row mb-3" id="exclusion_group">
                <label for="exclusion_basis" class="col-sm-3 col-form-label">적용제외조항/근거:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="exclusion_basis" name="exclusion_basis"
                        placeholder="적용제외조항/근거" value="<?= $customer['name_ko'] ?>" disabled>
                </div>
            </div>
            <!-- 외주처리 유무 -->
            <div class="form-group row mb-3">
                <label for="outsourcing_status" class="col-sm-3 col-form-label">*외주처리 유무:</label>
                <div class="col-sm-9 d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="outsourcing_status_yes" name="outsourcing"
                            <?php echo ($customer['customer_type']=='있음')?'checked':'' ?> disabled value="있음">
                        <label class="form-check-label" for="outsourcing_status_yes">있음</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="outsourcing_status_no" name="outsourcing"
                            <?php echo ($customer['customer_type']=='없음')?'checked':'' ?> disabled value="없음">
                        <label class="form-check-label" for="outsourcing_status_no">없음</label>
                    </div>
                </div>
            </div>
            <!-- 외주처리 프로세스 -->
            <div class="form-group row mb-3" id="outsourcing_group">
                <label for="outsourcing_process" class="col-sm-3 col-form-label">*외주처리 프로세스:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="outsourcing_process" name="outsourcing_process"
                        value="<?= $customer['name_ko'] ?>" disabled>
                </div>
            </div>

            <!-- 건설면허보유 여부 -->
            <div class="form-group row mb-3">
                <label for="construction_license_status" class="col-sm-3 col-form-label">*건설면허보유 여부:</label>
                <div class="col-sm-9 d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="construction_license_status_yes"
                            <?php echo ($customer['customer_type']=='있음')?'checked':'' ?> disabled
                            name="construction_permit" value="있음">
                        <label class="form-check-label" for="construction_license_status_yes">있음</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="construction_license_status_no"
                            <?php echo ($customer['customer_type']=='없음')?'checked':'' ?> disabled
                            name="construction_permit" value="없음">
                        <label class="form-check-label" for="construction_license_status_no">없음</label>
                    </div>
                </div>
            </div>
            <!-- 건설면허 내용 -->
            <div class="form-group row mb-3" id="construction_permit_group">
                <label for="construction_license_content" class="col-sm-3 col-form-label">건설면허 내용:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="construction_license_content"
                        name="construction_license_content" value="<?= $customer['name_ko'] ?>" disabled>
                </div>
            </div>

            <!-- 고객상태 -->
            <div class="form-group row mb-3" id="exclusion_group">
                <label for="status" class="col-sm-3 col-form-label">고객상태:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="status" name="status" placeholder=""
                        value="<?= $customer['status'] ?>" disabled>
                </div>
            </div>



            <!-- 사업자등록증 첨부 -->
            <div class="form-group row mb-3">
                <label for="business_cert_image" class="col-sm-3 col-form-label">*사업자등록증 첨부:</label>
                <div class="col-sm-9">
                    <!-- <input type="file" class="form-control" id="business_cert_image" name="business_cert_image"
                        accept="image/*,.pdf" value="<?= $customer['biz_license_original'] ?>" disabled> -->
                    <input type="text" class="form-control" id="business_cert_image" name="business_cert_image"
                        accept="image/*,.pdf" value="<?= $customer['biz_license_original'] ?>" disabled>
                    <small class="form-text text-muted">😀 파일 형식은 image 또는 PDF만 가능합니다.</small>
                </div>
            </div>

            <!-- 목록, 저장 버튼 -->
            <div class="form-group row mb-3">
                <div class="col-sm-3"></div>
                <div class="col-sm-9 d-flex align-items-center justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary"
                        onclick="location.href='list_customer.php'">목록</button>
                    <button type="button" class="btn btn-primary ml-3" id="btn_submit">저장</button>
                </div>
            </div>

        </form>
    </div>
    <script src="create_customer_process.js"></script>


</body>

</html>