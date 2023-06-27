document.addEventListener('DOMContentLoaded', function () {
  let form = document.getElementById('create_form');
  let btn = document.getElementById('btn_submit');

  function isEmpty(str) {
    return !str || str.length === 0;
  }

  btn.onclick = function () {
    let name = document.getElementById('name');
    let email = document.getElementById('email');
    let password = document.getElementById('password');
    let roles = document.getElementsByName('role');
    let role_selected = false;

    for (let i = 0; i < roles.length; i++) {
      if (roles[i].checked) {
        role_selected = true;
        break;
      }
    }

    if (isEmpty(name.value)) {
      alert('이름을 입력하세요.');
      name.focus();
      return false;
    }
    if (isEmpty(email.value)) {
      alert('이메일을 입력하세요.');
      email.focus();
      return false;
    }
    if (isEmpty(password.value)) {
      alert('비밀번호를 입력하세요.');
      password.focus();
      return false;
    }
    if (!role_selected) {
      alert('역할을 선택하세요.');
      roles[0].focus();
      return false;
    }

    form.submit();
  };
});
