import { checkExists } from "./request-utils.js";

document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#register-form");
  new window.JustValidate("#register-form", {
    validateBeforeSubmitting: true,
    tooltip: {
      position: "top",
    },
  })
    .addField("#email", [
      {
        rule: "required",
        errorMessage: "Email is required",
      },
      {
        rule: "email",
      },
      {
        validator: (value) => () =>
          checkExists("email", value).then((exists) => exists),
        errorMessage: "Email address unavailable",
      },
    ])
    .addField("#phone-number", [
      {
        rule: "required",
        errorMessage: "Phone number is required",
      },
      {
        rule: "minLength",
        value: 3,
        errorMessage: "Minimum 3 characters required",
      },
      {
        rule: "maxLength",
        value: 15,
          errorMessage: "Maximum 15 characters allowed",
      },
      {
        rule: "number",
      },
      {
        validator: (value) => () =>
          checkExists("phone_number", value).then((exists) => exists),
        errorMessage: "Phone number unavailable",
      },
    ])
    .addField(
      "#full-name",
      [
        {
          rule: "required",
          errorMessage: "Full name is required",
        },
        {
          rule: "minLength",
          value: 3,
          errorMessage: "Minimum 3 characters required",
        },
        {
          rule: "maxLength",
          value: 15,
          errorMessage: "Maximum 15 characters allowed",
        },
      ],
      {
        tooltip: {
          position: "right",
        },
      }
    )
    .addField(
      "#username",
      [
        // TODO: fix error message for regex;
        {
          rule: "required",
          errorMessage: "Username is required",
        },
        {
          rule: "customRegexp",
          value: /^[a-zA-Z0-9._]+$/,
        },
        {
          rule: "minLength",
          value: 1,
          errorMessage: "Minimum 1 character required",
        },
        {
          rule: "maxLength",
          value: 15,
          errorMessage: "Maximum 15 characters allowed",
        },
        {
          validator: (value) => () =>
            checkExists("username", value).then((exists) => exists),
          errorMessage: "Username unavailable. Try another.",
        },
      ],
      {
        tooltip: {
          position: "right",
        },
      }
    )
    .addField(
      "#password",
      [
        {
          rule: "required",
          errorMessage: "Password is required",
        },
        {
          rule: "minLength",
          value: 3,
          errorMessage: "Minimum 3 characters required",
        },
        {
          rule: "password",
          errorMessage: "Minimum 8 characters, 1 letter, 1 number"
        },
      ],
      {
        tooltip: {
          position: "right",
        },
      }
    )
    .onSuccess((event) => {
      event.preventDefault();
      HTMLFormElement.prototype.submit.call(form);
    });
});
