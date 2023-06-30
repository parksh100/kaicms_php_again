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

    if (!isEmptyInput('business_name_ko')) {
      alert('국문상호를 입력하세요');
      return;
    }
    if (!isEmptyInput('business_name_en')) {
      alert('영문상호를 입력하세요');
      return;
    }
    if (!isEmptyInput('business_registration_number')) {
      alert('사업자번호를 입력하세요');
      return;
    }
    if (!isEmptyInput('representative_name')) {
      alert('대표자명을 입력하세요');
      return;
    }

    if (!isEmptyInput('representative_email')) {
      alert('이메일을 입력하세요');
      return;
    }

    if (!isEmptyInput('email_tax')) {
      alert('세금계산서 이메일을 입력하세요');
      return;
    }

    if (!isEmptyInput('representative_phone')) {
      alert('대표전화번호를 입력하세요');
      return;
    }

    // postcode
    if (!isEmptyInput('postcode')) {
      alert('우편번호를 입력하세요');
      return;
    }
    // address_ko
    if (!isEmptyInput('address_ko')) {
      alert('주소를 입력하세요');
      return;
    }

    // address_en
    if (!isEmptyInput('address_en')) {
      alert('주소를 입력하세요');
      return;
    }

    // manager_name
    if (!isEmptyInput('manager_name')) {
      alert('담당자명을 입력하세요');
      return;
    }

    // manager_phone_number
    if (!isEmptyInput('manager_phone_number')) {
      alert('담당자 휴대번호를 입력하세요');
      return;
    }

    // manager_email
    if (!isEmptyInput('manager_email')) {
      alert('담당자 이메일을 입력하세요');
      return;
    }

    // scope_of_organization
    if (!isEmptyInput('scope_of_organization')) {
      alert('조직의 범위를 입력하세요');
      return;
    }
    number_of_employees;
    if (!isEmptyInput('number_of_employees')) {
      alert('직원수를 입력하세요');
      return;
    }

    // design_dev radio button
    if (!isEmptyRadio('design_dev')) {
      alert('설계/개발여부를 선택하세요');
      return;
    }

    // korean_certification_scope
    if (!isEmptyInput('korean_certification_scope')) {
      alert('인증범위를 입력하세요');
      return;
    }

    // activity_scope[] checkbox
    if (!isEmptyCheckbox('activity_scope[]')) {
      alert('활동범위를 선택하세요');
      return;
    }

    // iaf_code[] checkbox
    if (!isEmptyCheckbox('iaf_code[]')) {
      alert('IAF CODE를 선택하세요');
      return;
    }

    // product_service_name
    if (!isEmptyInput('product_service_name')) {
      alert('제품/서비스명 및 공정을 입력하세요');
      return;
    }

    // exclusion radio button
    if (!isEmptyRadio('exclusion')) {
      alert('적용제외조항 유무를 선택하세요');
      return;
    }

    // outsourcing radio button
    if (!isEmptyRadio('outsourcing')) {
      alert('외주프로세스 유무를 선택하세요');
      return;
    }

    // construction_permit radio button
    if (!isEmptyRadio('construction_permit')) {
      alert('건설면허 유무를 선택하세요');
      return;
    }

    // business_cert_image
    if (!isEmptyInput('business_cert_image')) {
      alert('사업자등록증을 첨부하세요');
      return;
    }

    // submit
    const business_no_checked = document.getElementById('is_duplicated');
    if (business_no_checked.value === 'no') {
      alert('사업자등록번호 중복확인을 해주세요.');
      e.preventDefault();
      return;
    } else {
      document.getElementById('create_customer_form').submit();
    }
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

  // 사업자등록번호에 '-' 추가
  const biz_no = document.getElementById('business_registration_number');
  formatAndLimitBusinessNumber(biz_no);

  // 휴대전화번호가 11자리이고 -추가
  const phone = document.getElementById('representative_phone_number');
  formatAndLimitPhoneNumber(phone);
  // 담당자 휴대전화번호가 11자리이고 -추가
  const manager_phone = document.getElementById('manager_phone_number');
  formatAndLimitPhoneNumber(manager_phone);

  // 일반전화번호, 팩스번호에 -추가
  const phone2 = document.getElementById('representative_phone');
  formatAndLimitTelephoneNumber(phone2);
  const fax = document.getElementById('representative_fax_number');
  formatAndLimitTelephoneNumber(fax);

  // 이메일 형식 체크
  const email = document.getElementById('representative_email');
  validateEmail(email);
  const manager_email = document.getElementById('manager_email');
  validateEmail(manager_email);
  const email_tax = document.getElementById('email_tax');
  validateEmail(email_tax);
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

// 사업자등록번호가 10자리인지확인하고  -기호 자동 입력
function formatAndLimitBusinessNumber(field) {
  field.addEventListener('input', function () {
    let number = this.value.replace(/-/g, ''); // Remove existing dashes

    // Limit input to 10 characters
    if (number.length > 10) {
      number = number.slice(0, 10);
    }

    if (number.length > 3) {
      if (number.length < 6) {
        number = number.slice(0, 3) + '-' + number.slice(3);
      } else {
        number =
          number.slice(0, 3) + '-' + number.slice(3, 5) + '-' + number.slice(5);
      }
    }
    this.value = number;
  });

  // Check on blur event (when the field loses focus)
  field.addEventListener('blur', function () {
    // If not 10 digits (after removing dashes), show alert
    if (this.value.replace(/-/g, '').length !== 10) {
      alert('사업자등록번호는 10자리여야 합니다.');
    }
  });
}

// 휴대전화번호가 11자리인지확인하고  -기호 자동 입력
function formatAndLimitPhoneNumber(field) {
  field.addEventListener('input', function () {
    let number = this.value.replace(/-/g, ''); // Remove existing dashes

    // Limit input to 11 characters
    if (number.length > 11) {
      number = number.slice(0, 11);
    }

    if (number.length > 3) {
      if (number.length < 7) {
        number = number.slice(0, 3) + '-' + number.slice(3);
      } else {
        number =
          number.slice(0, 3) + '-' + number.slice(3, 7) + '-' + number.slice(7);
      }
    }
    this.value = number;
  });

  // Check on blur event (when the field loses focus)
  field.addEventListener('blur', function () {
    // If not 11 digits (after removing dashes), show alert
    if (this.value.replace(/-/g, '').length !== 11) {
      alert('휴대전화번호는 11자리여야 합니다.');
      // setTimeout(() => this.focus(), 0); // 수정: setTimeout을 사용하여 focus() 호출을 지연시킵니다.
    }
  });
}

// 일반전화번호 -기호 자동 입력/ 02로 시작하면 2-3-4 또는 2-4-4 구조이고,
// 그외에 0으로시작하면 3-4-4 구조가 될거야.
// 또한 0으로 시작하지 않으면 4-4 구조 또는 4-4-4구조가 될거야.
function formatAndLimitTelephoneNumber(field) {
  field.addEventListener('input', function () {
    let number = this.value.replace(/-/g, ''); // Remove existing dashes

    if (number.startsWith('02')) {
      // Seoul area code
      if (number.length > 10) {
        number = number.slice(0, 10);
      }

      if (number.length > 2) {
        if (number.length <= 5) {
          number = number.slice(0, 2) + '-' + number.slice(2);
        } else if (number.length <= 9) {
          number =
            number.slice(0, 2) +
            '-' +
            number.slice(2, 5) +
            '-' +
            number.slice(5);
        } else {
          number =
            number.slice(0, 2) +
            '-' +
            number.slice(2, 6) +
            '-' +
            number.slice(6);
        }
      }
    } else if (number.startsWith('0')) {
      // Other area codes
      if (number.length > 11) {
        number = number.slice(0, 11);
      }

      if (number.length > 3) {
        if (number.length <= 7) {
          number = number.slice(0, 3) + '-' + number.slice(3);
        } else if (number.length <= 10) {
          number =
            number.slice(0, 3) +
            '-' +
            number.slice(3, 6) +
            '-' +
            number.slice(6);
        } else {
          number =
            number.slice(0, 3) +
            '-' +
            number.slice(3, 7) +
            '-' +
            number.slice(7);
        }
      }
    } else {
      // No area code
      if (number.length > 12) {
        number = number.slice(0, 12);
      }

      if (number.length > 4) {
        if (number.length <= 8) {
          number = number.slice(0, 4) + '-' + number.slice(4);
        } else {
          number =
            number.slice(0, 4) +
            '-' +
            number.slice(4, 8) +
            '-' +
            number.slice(8);
        }
      }
    }
    this.value = number;
  });

  // Check on blur event (when the field loses focus)
  field.addEventListener('blur', function () {
    let digits = this.value.replace(/-/g, '').length;

    if (this.value.startsWith('02')) {
      if (digits !== 9 && digits !== 10) {
        alert('올바른 전화번호를 입력해주세요.');
        // setTimeout(() => this.focus(), 0);
      }
    } else if (this.value.startsWith('0')) {
      if (digits !== 10 && digits !== 11) {
        alert('올바른 전화번호를 입력해주세요.');
        // setTimeout(() => this.focus(), 0);
      }
    } else {
      if (digits !== 8 && digits !== 12) {
        alert('올바른 전화번호를 입력해주세요.');
        // setTimeout(() => this.focus(), 0);
      }
    }
  });
}

// 이메일 형식이 맞는지 확인
function validateEmail(field) {
  field.addEventListener('blur', function () {
    let email = this.value;
    // Check if the email is valid using a regular expression
    let regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!regex.test(email)) {
      alert('유효한 이메일 주소를 입력해주세요.');
      // setTimeout(() => this.focus(), 0);
    }
  });
}

// 우편번호 찾기
// 우편번호 검색기능. 다음 API 사용
let btn_postcode = document.querySelector('#btn_postcode');
btn_postcode.addEventListener('click', function () {
  new daum.Postcode({
    oncomplete: function (data) {
      // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분입니다.
      // 예제를 참고하여 다양한 활용법을 확인해 보세요.
      console.log(data);
      let addr = ''; // 주소 변수
      let extra_addr = ''; // 참고항목 변수

      if (data.userSelectedType === 'R') {
        addr = data.roadAddress;
        console.log(addr);
      } else if (data.userSelectedType === 'J') {
        addr = data.jibunAddress;
        console.log(addr);
      }

      if (data.bname != '') {
        extra_addr = data.bname;
      }

      if (data.buildingName != '') {
        if (extra_addr === '') {
          extra_addr = data.buildingName;
        } else {
          extra_addr += ', ' + data.buildingName;
        }
      }

      if (extra_addr !== '') {
        extra_addr = ' (' + extra_addr + ')';
      }

      const address_ko = document.querySelector('#address_ko');
      address_ko.value = addr + extra_addr;

      const postcode = document.querySelector('#postcode');
      postcode.value = data.zonecode;

      const address_detail_ko = document.querySelector('#address_detail_ko');
      address_detail_ko.focus();

      // 영문주소 입력
      const address_en = document.querySelector('#address_en');
      address_en.value = data.roadAddressEnglish;

      const address_detail_en = document.querySelector('#address_detail_en');
    },
  }).open();
});
