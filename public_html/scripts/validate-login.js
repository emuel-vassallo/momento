import { validateCredentials } from "./request-utils.js";

document.addEventListener("DOMContentLoaded", (event) => {
  const form = document.getElementById("login-form");
  const loginError = document.getElementById("login-error");
  new window.JustValidate("#login-form")
    .addField("#username", [
      {
        rule: "required",
        errorMessage:
          "Please enter your phone number, username or email address",
      },
    ])
    .addField("#password", [
      {
        rule: "required",
        errorMessage: "Please enter your password",
      },
    ])
    .onSuccess((event) => {
      event.preventDefault();

      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;

      validateCredentials(username, password)
        .then((valid) => {
          if (!valid && !loginError.classList.contains("visible")) {
            loginError.classList.add("visible");
          } else {
            HTMLFormElement.prototype.submit.call(form);
          }
        })
        .catch((error) => {
          console.error(error);
        });
    });
});
