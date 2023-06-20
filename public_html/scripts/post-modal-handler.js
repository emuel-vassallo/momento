import { addTransformationParameters } from "./utility-functions.js";
import { setupValidation } from "./validate-post-form.js";
import { getPost } from "./request-utils.js";

const showModal = (mode, postId = null) => {
  const modal = new bootstrap.Modal(document.getElementById("post-modal"));
  modal.show();

  document.getElementById(
    "errors-container_custom-post-modal-picture"
  ).innerHTML = "";

  document.getElementById("post-modal-caption").textContent = "";

  setupValidation(mode);

  if (mode === "edit") {
    document.getElementById("post-modal-post-id").value = postId;
    document.getElementById("post-modal-form").action =
      "execute_core_file.php?filename=process_post_edit.php";
    document.getElementById("post-modal-submit-button").textContent = "Done";
    document.getElementById("post-modal-label").textContent = "Edit post";
    document.getElementById("post-modal-image").src = "";
    return;
  }

  document.getElementById("post-modal-form").action =
    "execute_core_file.php?filename=process_post_submission.php";
  document.getElementById("post-modal-submit-button").textContent = "Share";
  document.getElementById("post-modal-label").textContent = "Create new post";
  document.getElementById("post-modal-image").src = "";
};

document.addEventListener("DOMContentLoaded", () => {
  const headerPostModalTrigger = document.getElementById("post-modal-trigger");
  const postImageInput = document.getElementById("post-modal-image-picker");
  const imagePreview = document.getElementById("post-modal-image");
  const uploadContainer = document.querySelector(".upload-container");
  const editPostButtons = document.querySelectorAll(".post-edit-button");

  headerPostModalTrigger.addEventListener("click", () => {
    showModal("create");
    document.body.classList.add("modal-open");
    imagePreview.classList.add("d-none");
    uploadContainer.classList.remove("d-none");
    uploadContainer.classList.add("d-flex");
    postImageInput.value = "";
  });

  postImageInput.addEventListener("change", (event) => {
    const input = event.target;

    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = (e) => {
        imagePreview.src = e.target.result;
        uploadContainer.classList.add("d-none");
        imagePreview.classList.remove("d-none");
      };
      reader.readAsDataURL(input.files[0]);
      return;
    }
    imagePreview.src = "";
    uploadContainer.classList.add("d-flex");
  });

  for (let i = 0; i < editPostButtons.length; i++) {
    const button = editPostButtons[i];

    button.addEventListener("click", (event) => {
      event.preventDefault();

      document.body.classList.add("modal-open");
      const post = button.closest(".post");
      const postId = post.dataset.postId;

      showModal("edit", postId);

      uploadContainer.classList.add("d-none");
      imagePreview.classList.remove("d-none");

      getPost(postId)
        .then((postData) => {
          const postImage = postData.image_dir;
          const postImageCompressionSettings = "w_720/f_auto,q_auto:eco";
          const postImageTransformedUrl = addTransformationParameters(
            postImage,
            postImageCompressionSettings
          );

          document.getElementById("post-modal-caption").textContent =
            postData.caption;
          imagePreview.setAttribute("src", postImageTransformedUrl);
        })
        .catch((error) => {
          console.error(error);
        });
    });
  }
});
