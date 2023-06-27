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
    <div class="container">
        <h1 class="mt-5 text-center">고객등록화면</h1>
        <form id="create_customer_form" action="create_customer_process.php" method="post" enctype="multipart/form-data"
            class="mt-5">
            <div class="form-group row mb-3 align-items-center mb-3">
                <label for="customer_type" class="col-sm-3 col-form-label">*고객구분:</label>
                <div class="col-sm-9">
                    <div class="d-flex gap-3 my-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="customer_type" id="new" value="new">
                            <label class="form-check-label" for="new">신규</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="customer_type" id="transfer"
                                value="transfer">
                            <label class="form-check-label" for="transfer">전환</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 국문상호 -->
            <div class="form-group row mb-3">
                <label for="business_name_ko" class="col-sm-3 col-form-label">*국문상호:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="business_name_ko" name="business_name_ko" required>
                </div>
            </div>

            <!-- 영문상호 -->
            <div class="form-group row mb-3">
                <label for="business_name_en" class="col-sm-3 col-form-label">*영문상호:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="business_name_en" name="business_name_en"
                        placeholder="대소문자 구분, Co., Ltd. , Inc. 등 확인필요" required>
                </div>
            </div>

            <!-- 사업자등록번호 -->
            <div class="form-group row mb-3">
                <label for="business_registration_number" class="col-sm-3 col-form-label">*사업자등록번호:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="business_registration_number"
                        name="business_registration_number" placeholder="번호만 입력하세요" minlength="10" required>
                </div>
                <div class="col-sm-4 ">
                    <button type="button" class="btn btn-primary" id="check_business_registration_number">중복확인</button>
                </div>
                <input type="hidden" id="is_duplicated" name="is_duplicated" value="no">

            </div>

            <!-- 대표자명 -->
            <div class="form-group row mb-3">
                <label for="representative_name" class="col-sm-3 col-form-label">*대표자명:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="representative_name" name="representative_name"
                        required>
                </div>
            </div>
            <!-- 대표자 휴대번호 -->
            <div class="form-group row mb-3">
                <label for="representative_phone_number" class="col-sm-3 col-form-label">대표자 휴대번호:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="representative_phone_number"
                        name="representative_phone_number" required>
                </div>
            </div>
            <!--회사대표 이메일 -->
            <div class="form-group row mb-3">
                <label for="representative_email" class="col-sm-3 col-form-label">*대표 이메일:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="representative_email" name="representative_email"
                        required>
                </div>
            </div>
            <!--회사대표 전화번호 -->
            <div class="form-group row mb-3">
                <label for="representative_phone" class="col-sm-3 col-form-label">*대표전화번호:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="representative_phone" name="representative_phone"
                        required>
                </div>
            </div>
            <!-- 대표팩스번호 -->
            <div class="form-group row mb-3">
                <label for="representative_fax_number" class="col-sm-3 col-form-label">대표팩스번호:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="representative_fax_number"
                        name="representative_fax_number">
                </div>
            </div>
            <!-- 우편번호 -->
            <div class="form-group row mb-3">
                <label for="postcode" class="col-sm-3 col-form-label">*우편번호:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control bg-light" id="postcode" name="postcode" readonly>
                </div>
                <div class="col-sm-4">
                    <button type="button" class="btn btn-secondary" id="btn_postcode">우편번호검색</button>
                </div>
            </div>
            <!-- 국문주소 -->
            <div class="form-group row mb-3">
                <label for="address_ko" class="col-sm-3 col-form-label">*국문주소:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control bg-light" id="address_ko" name="address_ko" readonly>
                </div>
            </div>
            <!-- 국문상세주소 -->
            <div class="form-group row mb-3">
                <label for="address_detail_ko" class="col-sm-3 col-form-label">국문상세주소:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="address_detail_ko" name="address_detail_ko">
                </div>
            </div>
            <!-- 영문주소 -->
            <div class="form-group row mb-3">
                <label for="address_en" class="col-sm-3 col-form-label">*영문주소:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control bg-light" id="address_en" name="address_en" readonly>
                </div>
            </div>
            <!-- 영문상세주소 -->
            <div class="form-group row mb-3">
                <label for="address_detail_en" class="col-sm-3 col-form-label">영문상세주소:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="address_detail_en" name="address_detail_en">
                </div>
            </div>
            <!-- 담당자명/직위 -->
            <div class="form-group row mb-3">
                <label for="manager_name" class="col-sm-3 col-form-label">*담당자명/직위:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="manager_name" name="manager_name">
                </div>
            </div>
            <!-- 담당자 휴대번호 -->
            <div class="form-group row mb-3">
                <label for="manager_phone_number" class="col-sm-3 col-form-label">*담당자 휴대번호:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="manager_phone_number" name="manager_phone_number">
                </div>
            </div>
            <!-- 담당자 이메일 -->
            <div class="form-group row mb-3">
                <label for="manager_email" class="col-sm-3 col-form-label">*담당자 이메일:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="manager_email" name="manager_email">
                </div>
            </div>
            <!-- 홈페이지 -->
            <div class="form-group row mb-3">
                <label for="homepage" class="col-sm-3 col-form-label">홈페이지:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="homepage" name="homepage">
                </div>
            </div>
            <!-- 조직의 범위 -->
            <div class="form-group row mb-3">
                <label for="scope_of_organization" class="col-sm-3 col-form-label">*조직의 범위:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="scope_of_organization" name="scope_of_organization">
                </div>
            </div>
            <!-- 종업원 수 -->
            <div class="form-group row mb-3">
                <label for="number_of_employees" class="col-sm-3 col-form-label">*종업원 수:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="number_of_employees" name="number_of_employees">
                </div>
            </div>
            <!-- 설계/개발유무, 라디오버튼 타입, "있음" 또는 "없음" 중 선택하도록 작성 -->
            <div class="form-group row mb-3">
                <label for="customer_type" class="col-sm-3 col-form-label">*설계/개발 유무:</label>
                <div class="col-sm-9">
                    <div class="d-flex gap-3 my-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="design_dev" id="yes" value="yes">
                            <label class="form-check-label" for="yes">있음</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="design_dev" id="no" value="no">
                            <label class="form-check-label" for="no">없음</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- 설계/개발 인원수. number type -->
            <div class="form-group row mb-3" id="design_dev_people_group">
                <label for="number_of_designers" class="col-sm-3 col-form-label">설계/개발 인원수:</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="number_of_designers" name="number_of_designers">
                </div>
            </div>
            <!-- 국문인증범위, textarea type  -->
            <div class="form-group row mb-3">
                <label for="korean_certification_scope" class="col-sm-3 col-form-label">*국문인증범위:</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="korean_certification_scope" name="korean_certification_scope"
                        rows="3"></textarea>
                </div>
            </div>
            <!-- 영문인증범위, textarea type  -->
            <div class="form-group row mb-3">
                <label for="en_certification_scope" class="col-sm-3 col-form-label">*영문인증범위:</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="en_certification_scope" name="en_certification_scope"
                        rows="3"></textarea>
                </div>
            </div>
            <!-- 인증범위 활동, checkbox type  -->
            <div class="form-group row mb-3">
                <label for="activity_scope" class="col-sm-3 col-form-label">*인증범위 활동:</label>
                <div class="col-sm-9 d-flex gap-3">
                    <div class="form-check">
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
                    </div>
                </div>
            </div>
            <!-- iaf code -->

            <div class="form-group row mb-3">
                <label for="qms_codes_content" class="col-sm-3 col-form-label">*IAF Code:</label>
                <div class="col-sm-9 d-flex flex-wrap gap-3">
                    <?php 
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
                    <?php endfor; ?>
                </div>
            </div>
            <!-- 제품(서비스)명 및 공정 -->
            <div class="form-group row mb-3">
                <label for="product_service_name" class="col-sm-3 col-form-label">*제품(서비스)명 및 공정:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="product_service_name" name="product_service_name"
                        placeholder="제품(서비스)명 및 공정">
                </div>
            </div>
            <!-- 적용제외조항 유무 -->
            <div class="form-group row mb-3">
                <label for="exclusion" class="col-sm-3 col-form-label">*적용제외조항 유무:</label>
                <div class="col-sm-9 d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="exclusion_status_yes" name="exclusion"
                            value="있음">
                        <label class="form-check-label" for="exclusion_status_yes">있음</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="exclusion_status_no" name="exclusion"
                            value="없음">
                        <label class="form-check-label" for="exclusion_status_no">없음</label>
                    </div>
                </div>
            </div>
            <!-- 적용제외조항/근거 -->
            <div class="form-group row mb-3" id="exclusion_group">
                <label for="exclusion_basis" class="col-sm-3 col-form-label">적용제외조항/근거:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="exclusion_basis" name="exclusion_basis"
                        placeholder="적용제외조항/근거">
                </div>
            </div>
            <!-- 외주처리 유무 -->
            <div class="form-group row mb-3">
                <label for="outsourcing_status" class="col-sm-3 col-form-label">*외주처리 유무:</label>
                <div class="col-sm-9 d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="outsourcing_status_yes" name="outsourcing"
                            value="있음">
                        <label class="form-check-label" for="outsourcing_status_yes">있음</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="outsourcing_status_no" name="outsourcing"
                            value="없음">
                        <label class="form-check-label" for="outsourcing_status_no">없음</label>
                    </div>
                </div>
            </div>
            <!-- 외주처리 프로세스 -->
            <div class="form-group row mb-3" id="outsourcing_group">
                <label for="outsourcing_process" class="col-sm-3 col-form-label">*외주처리 프로세스:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="outsourcing_process" name="outsourcing_process">
                </div>
            </div>

            <!-- 건설면허보유 여부 -->
            <div class="form-group row mb-3">
                <label for="construction_license_status" class="col-sm-3 col-form-label">건설면허보유 여부:</label>
                <div class="col-sm-9 d-flex gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="construction_license_status_yes"
                            name="construction_permit" value="있음">
                        <label class="form-check-label" for="construction_license_status_yes">있음</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="construction_license_status_no"
                            name="construction_permit" value="없음">
                        <label class="form-check-label" for="construction_license_status_no">없음</label>
                    </div>
                </div>
            </div>
            <!-- 건설면허 내용 -->
            <div class="form-group row mb-3" id="construction_permit_group">
                <label for="construction_license_content" class="col-sm-3 col-form-label">*건설면허 내용:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="construction_license_content"
                        name="construction_license_content">
                </div>
            </div>



            <!-- 사업자등록증 첨부 -->
            <div class="form-group row mb-3">
                <label for="business_cert_image" class="col-sm-3 col-form-label">*사업자등록증 첨부:</label>
                <div class="col-sm-9">
                    <input type="file" class="form-control" id="business_cert_image" name="business_cert_image"
                        accept="image/*,.pdf">
                    <small class="form-text text-muted">😀 파일 형식은 이미지 또는 PDF만 가능합니다.</small>
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