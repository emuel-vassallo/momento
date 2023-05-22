import { checkExists } from "./ajax-request-utils.js";

document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#register-form");
  new window.JustValidate("#register-form", {
    validateBeforeSubmitting: true,
  })
    .addField("#email", [
      {
        rule: "required",
        errorMessage: "Email is required.",
      },
      {
        rule: "email",
      },
      {
        validator: (value) => () =>
          checkExists("email", value).then((exists) => !exists),
        errorMessage: "Another account is using the same email address.",
      },
    ])
    .addField("#phone-number", [
      {
        rule: "required",
        errorMessage: "Phone number is required.",
      },
      {
        rule: "minLength",
        value: 3,
      },
      {
        rule: "maxLength",
        value: 15,
      },
      {
        rule: "number",
      },
      {
        validator: (value) => () =>
          checkExists("phone_number", value).then((exists) => !exists),
        errorMessage: "Another account is using the same phone number.",
      },
    ])
    .addField("#full-name", [
      {
        rule: "required",
        errorMessage: "Full name is required.",
      },
      {
        rule: "minLength",
        value: 3,
      },
      {
        rule: "maxLength",
        value: 15,
      },
    ])
    .addField("#username", [
      {
        rule: "required",
        errorMessage: "Username is required.",
      },
      {
        rule: "customRegexp",
        value: /^[a-zA-Z0-9._]+$/,
      },
      {
        rule: "minLength",
        value: 1,
      },
      {
        rule: "maxLength",
        value: 15,
      },
      {
        validator: (value) => () =>
          checkExists("username", value).then((exists) => !exists),
        errorMessage: "This username isn't available. Please try another.",
      },
    ])
    .addField("#password", [
      {
        rule: "required",
        errorMessage: "Password is required.",
      },
      {
        rule: "minLength",
        value: 3,
      },
      {
        rule: "password",
      },
    ])
    .onSuccess((event) => {
      event.preventDefault();
      HTMLFormElement.prototype.submit.call(form);
    });
});
