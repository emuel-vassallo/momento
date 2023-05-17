const validator = new window.JustValidate("#login-form");

function validateForm() {
  validator
    .addField("#username", [
      {
        rule: "required",
      },
      {
        rule: "minLength",
        value: 1,
      },
      {
        rule: "maxLength",
        value: 15,
      },
    ])
    .addField("#password", [
      {
        rule: "required",
      },
    ]);
}

document.addEventListener("DOMContentLoaded", (event) => {
  const form = document.getElementById("login-form");
  const errorSpan = document.getElementById("login-error");

  validateForm();

  form.addEventListener("submit", (event) => {
    event.preventDefault();

    if (validator.isValid) {
      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;

      const xhr = new XMLHttpRequest();

      xhr.open("POST", "processLogin.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      xhr.onload = () => {
        if (xhr.status === 200) {
          const response = xhr.responseText;
          if (response === "true") {
            window.location.href =
              "http://localhost/Emuel_Vassallo_4.2D/instagram-clone/index.php";
          } else {
            errorSpan.textContent =
              "Sorry, your password was incorrect. Please double-check your password.";
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
