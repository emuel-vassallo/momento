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
          errorMessage: "Please select an image.",
        },
        {
          rule: "maxFilesCount",
          value: 1,
        },
        {
          rule: "files",
          value: {
            files: {
              extensions: ["jpeg", "jpg", "png", "bmp"],
              maxSize: 5000000,
              minSize: 10000,
              types: ["image/jpeg", "image/jpg", "image/png", "image/bmp"],
            },
          },
          errorMessage:
            "Invalid image: Max file size 5MB (JPEG, JPG, PNG, BMP).",
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
    });
};

export { setupValidation };
