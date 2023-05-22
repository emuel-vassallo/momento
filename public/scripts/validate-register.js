import { checkExists } from "./ajax-request-utils.js";

document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#register-form");
  new window.JustValidate("#register-form", {
    validateBeforeSubmitting: true,
  })
    .addField("#email", [
      {
        rule: "required",
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
      // TODO: add custom regexp to only allow letters, numbers, periods and underscores
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
      {
        validator: (value) => () =>
          checkExists("username", value).then((exists) => !exists),
        errorMessage: "This username isn't available. Please try another.",
      },
    ])
    .addField("#password", [
      {
        rule: "required",
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
