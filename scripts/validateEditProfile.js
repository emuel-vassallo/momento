const validator = new window.JustValidate('#edit-profile-form', {
  errorsContainer: '#errors-container_custom-container',
});

function validateForm() {
  validator
    .addField(
      '#profile-picture-picker',
      [
        {
          rule: 'required',
        },
        {
          rule: 'minFilesCount',
          value: 1,
        },
        {
          rule: 'maxFilesCount',
          value: 1,
        },
        {
          rule: 'files',
          value: {
            files: {
              types: ['image/jpeg', 'image/jpg', 'image/png'],
            },
          },
        },
      ],
      {
        errorsContainer: '#errors-container_custom-profile-picture',
      }
    )
    .addField('#edit-profile-display-name', [
      {
        rule: 'required',
      },
    ],
      {
        errorsContainer: '#errors-container_custom-display-name',
      }
    )
    .addField('#bio', [
      {
        rule: 'required',
      },
    ],
      {
        errorsContainer: '#errors-container_custom-bio',
      }
    );
}

document.addEventListener('DOMContentLoaded', (event) => {
  const form = document.getElementById('edit-profile-form');

  validateForm();

  form.addEventListener("submit", (event) => {
    event.preventDefault();

    if (validator.isValid) {
      form.submit();
    }
  });

  const profilePicturePicker = document.getElementById(
    'profile-picture-picker'
  );
  const profilePictureImage = document.querySelector(
    '.profile-picture-picker-image'
  );

  profilePicturePicker.addEventListener('change', (event) => {
    const file = event.target.files[0];
    const reader = new FileReader();

    reader.addEventListener('load', (event) => {
      profilePictureImage.src = event.target.result;
    });

    if (file) {
      reader.readAsDataURL(file);
    }
  });
});
