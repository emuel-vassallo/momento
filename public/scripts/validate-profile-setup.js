document.addEventListener("DOMContentLoaded", () => {
  const form =
    document.getElementById("setup-profile-form") ||
    document.getElementById("edit-profile-form");

  const profilePictureImage = document.getElementById(
    "profile-picture-picker-image"
  );

  new window.JustValidate(`#${form.id}`, {
    errorsContainer: "#errors-container_custom-container",
    validateBeforeSubmitting: true,
  })
    .addField(
      "#profile-picture-picker",
      [
        {
          rule: "required",
        },
        {
          rule: "minFilesCount",
          value: form.id === "edit-profile-form" ? 0 : 1,
          errorMessage: "Profile picture is required.",
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
        errorsContainer: "#errors-container_custom-profile-picture",
      }
    )
    .addField(
      "#edit-profile-display-name",
      [
        {
          rule: "required",
        },
      ],
      {
        errorsContainer: "#errors-container_custom-display-name",
      }
    )
    .addField(
      "#bio",
      [
        {
          rule: "required",
        },
        {
          rule: "maxLength",
          value: 150,
        },
      ],
      {
        errorsContainer: "#errors-container_custom-bio",
      }
    )
    .onSuccess((event) => {
      const hasProfilePicture =
        profilePictureImage.src !=
        "http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/images/default-pfp.jpg";

      if (hasProfilePicture) {
        HTMLFormElement.prototype.submit.call(form);
      }
    });

  document
    .getElementById("profile-picture-picker")
    .addEventListener("change", (event) => {
      const file = event.target.files[0];
      const reader = new FileReader();

      reader.addEventListener("load", (event) => {
        document.querySelector(".profile-picture-picker-image").src =
          event.target.result;
      });

      if (file) {
        reader.readAsDataURL(file);
      }
    });
});
