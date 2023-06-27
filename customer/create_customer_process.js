document.addEventListener('DOMContentLoaded', function () {
  // Initially hide the '설계/개발 인원수:' input field
  let designDevPeopleInput = document.querySelector('#design_dev_people_group');
  designDevPeopleInput.classList.add('d-none');

  // Add event listener to all '설계/개발 유무' radio buttons
  let designDevRadioButtons = document.querySelectorAll(
    'input[name="design_dev"]'
  );
  designDevRadioButtons.forEach(function (radioButton) {
    radioButton.addEventListener('change', function () {
      if (this.value === 'yes' && this.checked) {
        designDevPeopleInput.classList.remove('d-none');
      } else {
        designDevPeopleInput.classList.add('d-none');
      }
    });
  });

  // Initialize all input groups to be hidden
  let exclusionInput = document.querySelector('#exclusion_group');
  let outsourcingInput = document.querySelector('#outsourcing_group');
  let constructionPermitInput = document.querySelector(
    '#construction_permit_group'
  );

  exclusionInput.classList.add('d-none');
  outsourcingInput.classList.add('d-none');
  constructionPermitInput.classList.add('d-none');

  // Add event listeners to all '적용제외조항 유무' radio buttons
  let exclusionRadioButtons = document.querySelectorAll(
    'input[name="exclusion"]'
  );
  exclusionRadioButtons.forEach(function (radioButton) {
    radioButton.addEventListener('change', function () {
      if (this.value === '있음' && this.checked) {
        exclusionInput.classList.remove('d-none');
      } else {
        exclusionInput.classList.add('d-none');
      }
    });
  });

  // Add event listeners to all '외주처리 유무' radio buttons
  let outsourcingRadioButtons = document.querySelectorAll(
    'input[name="outsourcing"]'
  );
  outsourcingRadioButtons.forEach(function (radioButton) {
    radioButton.addEventListener('change', function () {
      if (this.value === '있음' && this.checked) {
        outsourcingInput.classList.remove('d-none');
      } else {
        outsourcingInput.classList.add('d-none');
      }
    });
  });

  // Add event listeners to all '건설면허보유 여부' radio buttons
  let constructionPermitRadioButtons = document.querySelectorAll(
    'input[name="construction_permit"]'
  );
  constructionPermitRadioButtons.forEach(function (radioButton) {
    radioButton.addEventListener('change', function () {
      if (this.value === '있음' && this.checked) {
        constructionPermitInput.classList.remove('d-none');
      } else {
        constructionPermitInput.classList.add('d-none');
      }
    });
  });

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
  // =============================================================
  // 입력항목 입력여부 확인
  const btn_submit = document.querySelector('#btn_submit');
  const form = document.querySelector('#create_customer_form');
  btn_submit.addEventListener('click', function (e) {
    e.preventDefault();
    // alert('1');
    // customer_type 라디오 버튼에 선택된 값이 없으면 alert
    const customer_type = document.querySelector(
      'input[name="customer_type"]:checked'
    );
    if (!customer_type) {
      alert('고객구분을 선택해주세요.');
      return false;
    }

    // business_name_ko 입력여부 확인
    const business_name_ko = document.querySelector('#business_name_ko');
    if (!business_name_ko.value) {
      alert('국문상호명을 입력해주세요.');
      business_name_ko.focus();
      return false;
    }
    // business_name_en 입력여부 확인

    const business_name_en = document.querySelector('#business_name_en');
    if (!business_name_en.value) {
      alert('영문상호명을 입력해주세요.');
      business_name_en.focus();
      return false;
    }

    // business_registration_number 입력여부 확인
    const business_registration_number = document.querySelector(
      '#business_registration_number'
    );
    if (!business_registration_number.value) {
      alert('사업자등록번호를 입력해주세요.');
      business_registration_number.focus();
      return false;
    }

    // 대표자명 입력여부 확인
    const representative_name = document.querySelector('#representative_name');
    if (!representative_name.value) {
      alert('대표자명을 입력해주세요.');
      representative_name.focus();
      return false;
    }
    // 대표 이메일 입력여부 확인
    const representative_email = document.querySelector(
      '#representative_email'
    );
    if (!representative_email.value) {
      alert('대표 이메일을 입력해주세요.');
      representative_email.focus();
      return false;
    }
    // 대표 전화번호 입력여부 확인
    const representative_phone = document.querySelector(
      '#representative_phone'
    );
    if (!representative_phone.value) {
      alert('대표 전화번호를 입력해주세요.');
      representative_phone.focus();
      return false;
    }
    // 우편번호 입력여부 확인
    const postcode = document.querySelector('#postcode');
    if (!postcode.value) {
      alert('우편번호를 입력해주세요.');
      postcode.focus();
      return false;
    }
    // 주소 입력여부 확인
    const address_ko = document.querySelector('#address_ko');
    if (!address_ko.value) {
      alert('주소를 입력해주세요.');
      address_ko.focus();
      return false;
    }
    // 영문주소 입력여부 확인
    const address_en = document.querySelector('#address_en');
    if (!address_en.value) {
      alert('영문주소를 입력해주세요.');
      address_en.focus();
      return false;
    }
    // manager_name 입력여부 확인
    const manager_name = document.querySelector('#manager_name');
    if (!manager_name.value) {
      alert('담당자명을 입력해주세요.');
      manager_name.focus();
      return false;
    }
    // manager_phone_number 입력여부 확인
    const manager_phone_number = document.querySelector(
      '#manager_phone_number'
    );
    if (!manager_phone_number.value) {
      alert('담당자 전화번호를 입력해주세요.');
      manager_phone_number.focus();
      return false;
    }
    // manager_email 입력여부 확인
    const manager_email = document.querySelector('#manager_email');
    if (!manager_email.value) {
      alert('담당자 이메일을 입력해주세요.');
      manager_email.focus();
      return false;
    }

    // scope_of_organization 입력여부 확인
    const scope_of_organization = document.querySelector(
      '#scope_of_organization'
    );
    if (!scope_of_organization.value) {
      alert('조직범위를 입력해주세요.');
      scope_of_organization.focus();
      return false;
    }
    // number_of_employees 입력여부 확인
    const number_of_employees = document.querySelector('#number_of_employees');
    if (!number_of_employees.value) {
      alert('종업원 수를 입력해주세요.');
      number_of_employees.focus();
      return false;
    }
    // design_dev_type 라디오 버튼에 선택된 값이 없으면 alert
    const design_dev = document.querySelector(
      'input[name="design_dev"]:checked'
    );
    if (!design_dev) {
      alert('설계/개발 유무를 선택해주세요.');
      return false;
    }

    // korean_certification_scope 입력여부 확인
    const korean_certification_scope = document.querySelector(
      '#korean_certification_scope'
    );
    if (!korean_certification_scope.value) {
      alert('한국어 인증범위를 입력해주세요.');
      korean_certification_scope.focus();
      return false;
    }
    // en_certification_scope 입력여부 확인
    const en_certification_scope = document.querySelector(
      '#en_certification_scope'
    );
    if (!en_certification_scope.value) {
      alert('영어 인증범위를 입력해주세요.');
      en_certification_scope.focus();
      return false;
    }
    // name=activity_scope인 체크박스 선택여부 확인
    const activity_scope = document.querySelectorAll(
      'input[name="activity_scope"]:checked'
    );
    if (activity_scope.length === 0) {
      alert('활동범위를 선택해주세요.');
      return false;
    }
    // name=iaf_code[]인 체크박스 선택여부 확인
    const iaf_code = document.querySelectorAll(
      'input[name="iaf_code[]"]:checked'
    );
    if (iaf_code.length === 0) {
      alert('인증범위를 선택해주세요.');
      return false;
    }
    // product_service_name 입력여부 확인
    const product_service_name = document.querySelector(
      '#product_service_name'
    );
    if (!product_service_name.value) {
      alert('제품/서비스명을 입력해주세요.');
      product_service_name.focus();
      return false;
    }
    // name=exclusion인 라디오 버튼에 선택된 값이 없으면 alert
    const exclusion = document.querySelector('input[name="exclusion"]:checked');
    if (!exclusion) {
      alert('적용제외여부를 선택해주세요.');
      return false;
    }
    // name=outsourcing인 라디오 버튼에 선택된 값이 없으면 alert
    const outsourcing = document.querySelector(
      'input[name="outsourcing"]:checked'
    );
    if (!outsourcing) {
      alert('외주여부를 선택해주세요.');
      return false;
    }
    // name=construction_permit인 라디오 버튼에 선택된 값이 없으면 alert
    const construction_permit = document.querySelector(
      'input[name="construction_permit"]:checked'
    );
    if (!construction_permit) {
      alert('건축허가여부를 선택해주세요.');
      return false;
    }
    // id=business_cer_image인 파일 업로드 입력여부 확인
    const business_cert_image = document.querySelector(
      '#business_cert_image'
    ).value;
    if (!business_cert_image) {
      alert('사업자등록증을 업로드해주세요.');
      return false;
    }
    // submit 처리
    const business_no_checked = document.getElementById('is_duplicated');
    if (business_no_checked.value === 'no') {
      alert('사업자등록번호 중복확인을 해주세요.');
      e.preventDefault();
    } else {
      document.getElementById('create_customer_form').submit();
    }
  }); // 입력항목 입력여부 확인 끝
  // ========================================================
  // 사업자등록번호 중복체크 기능구현
  document
    .getElementById('check_business_registration_number')
    .addEventListener('click', function (e) {
      e.preventDefault();
      let business_no = document.getElementById(
        'business_registration_number'
      ).value;

      // '-' 제거 사용자에게 보여줄때만 -기호가 필요하고 DB에는 -기호가 없어야함
      business_no = business_no.replace(/-/gi, '');

      if (business_no === '') {
        alert('사업자등록번호를 입력해주세요.');
        return false;
      }
      console.log(business_no);
      let xhr = new XMLHttpRequest();
      xhr.open('POST', 'check_biz_no.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.onload = function () {
        if (
          this.status === 200 &&
          this.responseText.trim() ===
            'The business registration number is not duplicated.'
        ) {
          alert('사용가능한 사업자등록번호입니다.');
          document.querySelector('#is_duplicated').value = 'yes'; // add this line
        } else {
          alert('이미 사용중인 사업자등록번호입니다.');
        }
      };
      xhr.send('biz_no=' + encodeURIComponent(business_no));
      // document.querySelector('#is_duplicated').value = 'yes';
    }); // 사업자등록증 중복체크 기능구현 끝

  // 사업자등록번호 자리수 표시 기능구현
  const business_number = document.querySelector(
    '#business_registration_number'
  );
  business_number.addEventListener('input', function () {
    let currentValue = this.value.replace(/-/g, '');

    // filter non-digit characters
    currentValue = currentValue.replace(/\D/g, '');

    // check the length of the input and add dashes at appropriate positions
    if (currentValue.length > 5) {
      this.value =
        currentValue.slice(0, 3) +
        '-' +
        currentValue.slice(3, 5) +
        '-' +
        currentValue.slice(5, 10);
    } else if (currentValue.length > 3) {
      this.value = currentValue.slice(0, 3) + '-' + currentValue.slice(3, 5);
    } else {
      this.value = currentValue;
    }
  }); // 사업자등록번호 자리수 표시 기능구현 끝

  // 대표자 휴대번호 자리수 표시 기능구현
  let representativePhoneNumberField = document.querySelector(
    '#representative_phone_number'
  );

  representativePhoneNumberField.addEventListener('input', function () {
    let currentValue = this.value.replace(/-/g, ''); // Remove existing dashes

    // Filter non-digits
    currentValue = currentValue.replace(/\D/g, '');

    // Check the length of the input and add dashes at appropriate positions
    if (currentValue.length > 8) {
      this.value =
        currentValue.slice(0, 3) +
        '-' +
        currentValue.slice(3, 7) +
        '-' +
        currentValue.slice(7, 11);
    } else if (currentValue.length > 3) {
      this.value =
        currentValue.slice(0, 3) +
        '-' +
        currentValue.slice(3, 7) +
        '-' +
        currentValue.slice(7, 11);
    } else {
      this.value = currentValue;
    }

    // Limit the length to 13 characters including dashes
    if (this.value.length > 13) {
      this.value = this.value.slice(0, 13);
    }
  }); // 대표자 휴대번호 자리수 표시 기능구현 끝

  // 담당자 휴대번호 자리수 표시 기능구현
  let managerPhoneNumberField = document.querySelector('#manager_phone_number');

  managerPhoneNumberField.addEventListener('input', function () {
    let currentValue = this.value.replace(/-/g, ''); // Remove existing dashes

    // Filter non-digits
    currentValue = currentValue.replace(/\D/g, '');

    // Check the length of the input and add dashes at appropriate positions
    if (currentValue.length > 8) {
      this.value =
        currentValue.slice(0, 3) +
        '-' +
        currentValue.slice(3, 7) +
        '-' +
        currentValue.slice(7, 11);
    } else if (currentValue.length > 3) {
      this.value =
        currentValue.slice(0, 3) +
        '-' +
        currentValue.slice(3, 7) +
        '-' +
        currentValue.slice(7, 11);
    } else {
      this.value = currentValue;
    }

    // Limit the length to 13 characters including dashes
    if (this.value.length > 13) {
      this.value = this.value.slice(0, 13);
    }
  }); // 담당자 휴대번호 자리수 표시 기능구현 끝

  // 대표 전화번호 자리수 표시 기능구현
  let representativePhoneField = document.querySelector(
    '#representative_phone'
  );

  representativePhoneField.addEventListener('input', function () {
    let currentValue = this.value.replace(/-/g, ''); // Remove existing dashes

    // Filter non-digits
    currentValue = currentValue.replace(/\D/g, '');

    // Check if the number starts with '02'
    if (currentValue.startsWith('02')) {
      // Check the length of the input and add dashes at appropriate positions
      if (currentValue.length > 6) {
        this.value =
          currentValue.slice(0, 2) +
          '-' +
          currentValue.slice(2, 6) +
          '-' +
          currentValue.slice(6);
      } else if (currentValue.length > 2) {
        this.value = currentValue.slice(0, 2) + '-' + currentValue.slice(2);
      } else {
        this.value = currentValue;
      }

      // Limit the length to 9 digits (excluding dashes)
      if (currentValue.length > 9) {
        this.value = this.value.slice(0, 12);
      }
    } else {
      // Check the length of the input and add dashes at appropriate positions
      if (currentValue.length > 7) {
        this.value =
          currentValue.slice(0, 3) +
          '-' +
          currentValue.slice(3, 7) +
          '-' +
          currentValue.slice(7);
      } else if (currentValue.length > 3) {
        this.value = currentValue.slice(0, 3) + '-' + currentValue.slice(3);
      } else {
        this.value = currentValue;
      }

      // Limit the length to 10 digits (excluding dashes)
      if (currentValue.length > 10) {
        this.value = this.value.slice(0, 13);
      }
    }
  }); // 대표 전화번호 자리수 표시 기능구현 끝

  // 대표 팩스번호 자리수 표시 기능구현
  let representativeFaxField = document.querySelector(
    '#representative_fax_number'
  );

  representativeFaxField.addEventListener('input', function () {
    let currentValue = this.value.replace(/-/g, ''); // Remove existing dashes

    // Filter non-digits
    currentValue = currentValue.replace(/\D/g, '');

    // Check if the number starts with '02'
    if (currentValue.startsWith('02')) {
      // Check the length of the input and add dashes at appropriate positions
      if (currentValue.length > 6) {
        this.value =
          currentValue.slice(0, 2) +
          '-' +
          currentValue.slice(2, 6) +
          '-' +
          currentValue.slice(6);
      } else if (currentValue.length > 2) {
        this.value = currentValue.slice(0, 2) + '-' + currentValue.slice(2);
      } else {
        this.value = currentValue;
      }

      // Limit the length to 9 digits (excluding dashes)
      if (currentValue.length > 9) {
        this.value = this.value.slice(0, 12);
      }
    } else {
      // Check the length of the input and add dashes at appropriate positions
      if (currentValue.length > 7) {
        this.value =
          currentValue.slice(0, 3) +
          '-' +
          currentValue.slice(3, 7) +
          '-' +
          currentValue.slice(7);
      } else if (currentValue.length > 3) {
        this.value = currentValue.slice(0, 3) + '-' + currentValue.slice(3);
      } else {
        this.value = currentValue;
      }

      // Limit the length to 10 digits (excluding dashes)
      if (currentValue.length > 10) {
        this.value = this.value.slice(0, 13);
      }
    }
  }); // 대표 팩스번호 자리수 표시 기능구현 끝
});
