document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("create-post-form");
  new window.JustValidate("#create-post-form")
    .addField(
      "#post-image",
      [
        {
          rule: "required",
        },
        {
          rule: "minFilesCount",
          value: 1,
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
        errorsContainer: "#errors-container_custom-create-post-picture",
      }
    )
    .addField("#post-caption", [
      {
        rule: "maxLength",
        value: 2200,
      },
    ])
    .onSuccess((event) => {
      event.preventDefault();
      HTMLFormElement.prototype.submit.call(form);
    });
});
