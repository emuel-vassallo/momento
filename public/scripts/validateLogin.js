const validator = new window.JustValidate('#login-form');

function validateForm() {
  validator
    .addField('#username', [
      {
        rule: 'required',
      },
    ])
    .addField('#password', [
      {
        rule: 'required',
      },
    ]);
}

document.addEventListener('DOMContentLoaded', (event) => {
  const form = document.getElementById('login-form');
  const loginError = document.getElementById('login-error');

  validateForm();

  form.addEventListener('submit', (event) => {
    event.preventDefault();

    if (validator.isValid) {
      const username = document.getElementById('username').value;
      const password = document.getElementById('password').value;

      const xhr = new XMLHttpRequest();

      xhr.open('POST', '../core/processLogin.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload = () => {
        if (xhr.status === 200) {
          const response = xhr.responseText;
          if (response === 'true') {
            window.location.href =
              'http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/index.php';
          } else {
            if (!loginError.classList.contains('visible')) {
              loginError.classList.add('visible');
            }
          }
        }
      };

      xhr.send(
        `username=${encodeURIComponent(username)}&password=${encodeURIComponent(
          password
        )}`
      );
    }
  });
});
