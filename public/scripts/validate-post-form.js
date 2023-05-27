let validator;

const setupValidation = (mode) => {
  const form = document.getElementById("post-modal-form");

  if (validator) {
    validator.destroy();
  }

  validator = new window.JustValidate("#post-modal-form")
    .addField(
      "#post-modal-image-picker",
      [
        {
          rule: "required",
        },
        {
          rule: "minFilesCount",
          value: mode === "edit" ? 0 : 1,
          errorMessage: "Please select an image",
        },
        {
          rule: "maxFilesCount",
          value: 1,
        },
        {
          rule: "files",
          value: {
            files: {
              types: ["image/jpeg", "image/jpg", "image/png", "image/bmp"],
            },
          },
        },
      ],
      {
        errorsContainer: "#errors-container_custom-post-modal-picture",
      }
    )
    .addField("#post-modal-caption", [
      {
        rule: "maxLength",
        value: 2200,
      },
    ])
    .onSuccess((event) => {
      event.preventDefault();
      HTMLFormElement.prototype.submit.call(form);
      console.log("success");
    });
};

export { setupValidation };
