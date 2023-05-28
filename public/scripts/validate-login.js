import { validateCredentials } from "./request-utils.js";

document.addEventListener("DOMContentLoaded", (event) => {
  const form = document.getElementById("login-form");
  const loginError = document.getElementById("login-error");
  new window.JustValidate("#login-form")
    .addField("#username", [
      {
        rule: "required",
      },
    ])
    .addField("#password", [
      {
        rule: "required",
      },
    ])
    .onSuccess((event) => {
      event.preventDefault();

      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;

      validateCredentials(username, password)
        .then((valid) => {
          if (!valid) {
            if (loginError.classList.contains("visible")) {
              return;
            }

            loginError.classList.add("visible");
            return;
          }

          HTMLFormElement.prototype.submit.call(form);
        })
        .catch((error) => {
          console.error(error);
        });
    });
});
