// submit 버튼을 클릭하면 폼의 내용을 검사하고, 검사 결과에 따라 submit 여부를 결정한다.
document.addEventListener('DOMContentLoaded', function () {
  // submit 버튼 클릭 시
  document.getElementById('btn_submit').addEventListener('click', function (e) {
    e.preventDefault();
    console.log('submit 버튼 클릭');

    // // customer_type radio button
    if (!isEmptyRadio('customer_type')) {
      alert('고객구분을 선택하세요');
      return;
    }

    // if (!isEmptyInput('business_name_ko')) {
    //   alert('국문상호를 입력하세요');
    //   return;
    // }
    // if (!isEmptyInput('business_name_en')) {
    //   alert('영문상호를 입력하세요');
    //   return;
    // }
    // if (!isEmptyInput('business_registration_number')) {
    //   alert('사업자번호를 입력하세요');
    //   return;
    // }
    // if (!isEmptyInput('representative_name')) {
    //   alert('대표자명을 입력하세요');
    //   return;
    // }

    // if (!isEmptyInput('representative_email')) {
    //   alert('이메일을 입력하세요');
    //   return;
    // }
    // if (!isEmptyInput('representative_phone_number')) {
    //   alert('대표전화번호를 입력하세요');
    //   return;
    // }

    // // postcode
    // if (!isEmptyInput('postcode')) {
    //   alert('우편번호를 입력하세요');
    //   return;
    // }
    // // address_ko
    // if (!isEmptyInput('address_ko')) {
    //   alert('주소를 입력하세요');
    //   return;
    // }

    // // address_en
    // if (!isEmptyInput('address_en')) {
    //   alert('주소를 입력하세요');
    //   return;
    // }

    // // manager_name
    // if (!isEmptyInput('manager_name')) {
    //   alert('담당자명을 입력하세요');
    //   return;
    // }

    // // manager_phone_number
    // if (!isEmptyInput('manager_phone_number')) {
    //   alert('담당자 휴대번호를 입력하세요');
    //   return;
    // }

    // // manager_email
    // if (!isEmptyInput('manager_email')) {
    //   alert('담당자 이메일을 입력하세요');
    //   return;
    // }

    // // scope_of_organization
    // if (!isEmptyInput('scope_of_organization')) {
    //   alert('조직의 범위를 입력하세요');
    //   return;
    // }
    // number_of_employees
    // if (!isEmptyInput('number_of_employees')) {
    //   alert('직원수를 입력하세요');
    //   return;
    // }

    // // design_dev radio button
    // if (!isEmptyRadio('design_dev')) {
    //   alert('설계/개발여부를 선택하세요');
    //   return;
    // }

    // // korean_certification_scope
    // if (!isEmptyInput('korean_certification_scope')) {
    //   alert('인증범위를 입력하세요');
    //   return;
    // }

    // // activity_scope[] checkbox
    // if (!isEmptyCheckbox('activity_scope[]')) {
    //   alert('활동범위를 선택하세요');
    //   return;
    // }

    // // iaf_code[] checkbox
    // if (!isEmptyCheckbox('iaf_code[]')) {
    //   alert('IAF CODE를 선택하세요');
    //   return;
    // }

    // // product_service_name
    // if (!isEmptyInput('product_service_name')) {
    //   alert('제품/서비스명 및 공정을 입력하세요');
    //   return;
    // }

    // // exclusion radio button
    // if (!isEmptyRadio('exclusion')) {
    //   alert('적용제외조항 유무를 선택하세요');
    //   return;
    // }

    // // outsourcing radio button
    // if (!isEmptyRadio('outsourcing')) {
    //   alert('외주프로세스 유무를 선택하세요');
    //   return;
    // }

    // // construction_permit radio button
    // if (!isEmptyRadio('construction_permit')) {
    //   alert('건설면허 유무를 선택하세요');
    //   return;
    // }

    // // business_cert_image
    // if (!isEmptyInput('business_cert_image')) {
    //   alert('사업자등록증을 첨부하세요');
    //   return;
    // }
  }); // submit 버튼 클릭 시 끝

  // 라디오 버튼 클릭 시 입력창 보이기/숨기기
  hideOrShowInputGroup('design_dev', 'design_dev_people_group');
  hideOrShowInputGroup('exclusion', 'exclusion_group');
  hideOrShowInputGroup('outsourcing', 'outsourcing_group');
  hideOrShowInputGroup('construction_permit', 'construction_permit_group');

  // type=text이지만 숫자만 입력 가능하도록
  allowOnlyNumbers('business_registration_number');
  allowOnlyNumbers('representative_phone_number');
  allowOnlyNumbers('representative_phone');
  allowOnlyNumbers('manager_phone_number');
  allowOnlyNumbers('number_of_employees');
  allowOnlyNumbers('representative_fax_number');

  // 사업자등록번호 체크
  document
    .getElementById('check_business_registration_number')
    .addEventListener('click', function (e) {
      e.preventDefault();
      let business_no = document.getElementById(
        'business_registration_number'
      ).value;

      // '-' 제거
      business_no = business_no.replace(/-/gi, '');

      if (business_no === '') {
        alert('사업자등록번호를 입력해주세요.');
        return false;
      }

      checkBusinessRegNumber(business_no);
    });
}); // DOMContentLoaded 끝

// =========함수 정의========================================================================
// input태그 empty check function
function isEmptyInput(id) {
  var element = document.getElementById(id);
  if (element.value.trim() === '') {
    element.focus();
    return false;
  } else {
    return true;
  }
}

// radio button check function
function isEmptyRadio(name) {
  var elements = document.getElementsByName(name);
  for (var i = 0; i < elements.length; i++) {
    if (elements[i].checked) {
      return true;
    }
  }
  elements[0].focus();
  return false;
}

// checkbox check function
function isEmptyCheckbox(name) {
  var elements = document.getElementsByName(name);
  for (var i = 0; i < elements.length; i++) {
    if (elements[i].checked) {
      return true;
    }
  }
  elements[0].focus();
  return false;
}

// 라디오버튼 선택에 따라 hidden 처리
function hideOrShowInputGroup(radioButtonName, inputGroupId) {
  // Initially hide the input field
  let inputGroup = document.querySelector(`#${inputGroupId}`);
  inputGroup.classList.add('d-none');

  // Add event listener to all radio buttons
  let radioButtons = document.querySelectorAll(
    `input[name="${radioButtonName}"]`
  );
  radioButtons.forEach(function (radioButton) {
    radioButton.addEventListener('change', function () {
      if (this.value === '있음' && this.checked) {
        inputGroup.classList.remove('d-none');
      } else {
        inputGroup.classList.add('d-none');
      }
    });
  });
}

// 번호만 입력 가능하도록. id를 입력하면 숫자만 입력받는 함수.
function allowOnlyNumbers(inputElementId) {
  var inputElement = document.getElementById(inputElementId);
  inputElement.addEventListener('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
  });
}

// 사업자등록번호 체크
function checkBusinessRegNumber(businessRegNumber) {
  // 서버 주소 및 경로를 확인하여 변경해주세요.
  let url = 'check_biz_no.php';

  // AJAX 요청 생성
  let xhr = new XMLHttpRequest();
  xhr.open('POST', url, true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function () {
    if (
      this.status === 200 &&
      this.responseText.trim() ===
        'The business registration number is not duplicated.'
    ) {
      alert('사용가능한 사업자등록번호입니다.');
      document.querySelector('#is_duplicated').value = 'yes';
    } else {
      alert('이미 사용중인 사업자등록번호입니다.');
    }
  };
  xhr.send('biz_no=' + encodeURIComponent(businessRegNumber));
}
