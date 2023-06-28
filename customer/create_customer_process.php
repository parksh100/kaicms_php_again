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

    

    // gather all input data
    $customer_type = $_POST['customer_type'];
    $business_name_ko = $_POST['business_name_ko'];
    $business_name_en = $_POST['business_name_en'];
    $business_registration_number = $_POST['business_registration_number'];
    $representative_name = $_POST['representative_name'];
    $representative_phone_number = $_POST['representative_phone_number'];
    $representative_email = $_POST['representative_email'];
    $representative_phone = $_POST['representative_phone'];
    $representative_fax_number = $_POST['representative_fax_number'];
    $postcode = $_POST['postcode'];
    $address_ko = $_POST['address_ko'];
    $address_detail_ko = $_POST['address_detail_ko'];
    $address_en = $_POST['address_en'];
    $address_detail_en = $_POST['address_detail_en'];
    $manager_name = $_POST['manager_name'];
    $manager_phone_number = $_POST['manager_phone_number'];
    $manager_email = $_POST['manager_email'];
    $homepage = $_POST['homepage'];
    $scope_of_organization = $_POST['scope_of_organization'];
    $number_of_employees = $_POST['number_of_employees'];
    // $number_of_designers = $_POST['number_of_designers'];
    $number_of_designers = $_POST['number_of_designers'] != '' ? $_POST['number_of_designers'] : 0;
    $korean_certification_scope = $_POST['korean_certification_scope'];
    $en_certification_scope = $_POST['en_certification_scope'];
    $product_service_name = $_POST['product_service_name'];
    $exclusion_basis = $_POST['exclusion_basis'];
    $outsourcing_process = $_POST['outsourcing_process'];
    $construction_license_content = $_POST['construction_license_content'];

    // gather all radio button data
    $design_dev = $_POST['design_dev'];
    $exclusion = $_POST['exclusion'];
    $outsourcing = $_POST['outsourcing'];
    $construction_permit = $_POST['construction_permit'];

    // gather all checkbox data
    $activity_scope = isset($_POST['activity_scope']) ? (array)$_POST['activity_scope'] : [];
    $iaf_code = isset($_POST['iaf_code']) ? (array)$_POST['iaf_code'] : [];
        
    
  // Convert checkbox arrays to string
    $activity_scope_str = implode(",", $activity_scope);
    $iaf_code_str = implode(",", $iaf_code);

     // gather all file data
     $business_cert_image = $_FILES['business_cert_image'];
     $target_dir = "../uploads/";
     $upload_time = date('YmdHis');
     $original_file_name = basename($business_cert_image['name']);
     $new_file_name = $upload_time . $original_file_name;
     $target_file = $target_dir . $new_file_name;
 
     if (move_uploaded_file($business_cert_image['tmp_name'], $target_file)) {
         echo "The file ". basename($business_cert_image['name']). " has been uploaded.";
         $biz_license = $new_file_name;
         $biz_license_original = $original_file_name;
     } else {
         echo "Sorry, there was an error uploading your file.";
     }
 

    // prepare SQL statement and bind parameters
    $stmt = $pdo->prepare("INSERT INTO customer (customer_type, name_ko, name_en, biz_no, ceo_name, ceo_mobile, email, phone, fax, postcode, addr_ko, addr_ko_detail, addr_en, addr_en_detail, manager, manager_mobile, manager_email, homepage, organize_scope, employee_number, dev, dev_employee, scope_ko, scope_en, activity, iaf_code, process, exclusion, exclusion_content, outsourcing, outsourcing_content, construction, construction_content, biz_license, biz_license_original) VALUES (:customer_type, :name_ko, :name_en, :biz_no, :ceo_name, :ceo_mobile, :email, :phone, :fax, :postcode, :addr_ko, :addr_ko_detail, :addr_en, :addr_en_detail, :manager, :manager_mobile, :manager_email, :homepage, :organize_scope, :employee_number, :dev, :dev_employee, :scope_ko, :scope_en, :activity, :iaf_code, :process, :exclusion, :exclusion_content, :outsourcing, :outsourcing_content, :construction, :construction_content, :biz_license, :biz_license_original)");
    
    
    try {
        // Execute the query with the bound parameters
        $executed = $stmt->execute([
            'customer_type' => $customer_type,
            'name_ko' => $business_name_ko,
            'name_en' => $business_name_en,
            'biz_no' => $business_registration_number,
            'ceo_name' => $representative_name,
            'ceo_mobile' => $representative_phone_number,
            'email' => $representative_email,
            'phone' => $representative_phone,
            'fax' => $representative_fax_number,
            'postcode' => $postcode,
            'addr_ko' => $address_ko,
            'addr_ko_detail' => $address_detail_ko,
            'addr_en' => $address_en,
            'addr_en_detail' => $address_detail_en,
            'manager' => $manager_name,
            'manager_mobile' => $manager_phone_number,
            'manager_email' => $manager_email,
            'homepage' => $homepage,
            'organize_scope' => $scope_of_organization,
            'employee_number' => $number_of_employees,
            'dev' => $design_dev,
            'dev_employee' => $number_of_designers,
            'scope_ko' => $korean_certification_scope,
            'scope_en' => $en_certification_scope,
            'activity' => implode(',', $activity_scope),
            'iaf_code' => implode(',', $iaf_code),
            'process' => $product_service_name,
            'exclusion' => $exclusion,
            'exclusion_content' => $exclusion_basis,
            'outsourcing' => $outsourcing,
            'outsourcing_content' => $outsourcing_process,
            'construction' => $construction_permit,
            'construction_content' => $construction_license_content,
            'biz_license' => $biz_license,
            'biz_license_original' => $biz_license_original,
            // 'biz_license_ext' => $business_cert_image_type
        ]);
    
        if($executed) {
            // Redirection to another page
            header('Location: http://localhost:8888/kaicms_php/customer/list_customer.php');
            exit();} else {
            echo "<script>alert('고객등록과정에서 문제가 발생했습니다. 다시 시도해주세요'); window.location.href='http://localhost:8888/kaicms_php/customer/create_customer_form.php';</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: ".$e->getMessage()."'); window.location.href='http://localhost:8888/kaicms_php/customer/create_customer_form.php';</script>";
    }
    

?>