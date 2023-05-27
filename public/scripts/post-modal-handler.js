import { setupValidation } from "./validate-post-form.js";

const showModal = (mode) => {
  const modal = new bootstrap.Modal(document.getElementById("post-modal"));
  modal.show();

  document.getElementById(
    "errors-container_custom-post-modal-picture"
  ).innerHTML = "";

  setupValidation(mode);
  if (mode === "edit") {
    document.getElementById("post-modal-form").action =
      "../core/process_post_edit.php";
    document.getElementById("post-modal-submit-button").textContent = "Done";
    document.getElementById("post-modal-label").textContent = "Edit post";
    document.getElementById("post-modal-image").src = "";
    return;
  }
  document.getElementById("post-modal-form").action =
    "../core/process_post_submission.php";
  document.getElementById("post-modal-submit-button").textContent = "Share";
  document.getElementById("post-modal-label").textContent = "Create new post";
  document.getElementById("post-modal-image").src = "";
};

const getPost = (postId) => {
  const url = `../core/get_post_info.php?post_id=${encodeURIComponent(postId)}`;

  return fetch(url)
    .then((response) => {
      if (!response.ok) {
        throw new Error(response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      if (data.success) {
        return data.post;
      }
      throw new Error("Failed to retrieve post data");
    })
    .catch((error) => {
      console.error(error.message);
      throw error;
    });
};

document.addEventListener("DOMContentLoaded", () => {
  const headerPostModalTrigger = document.getElementById("post-modal-trigger");
  const postImageInput = document.getElementById("post-modal-image-picker");
  const imagePreview = document.getElementById("post-modal-image");
  const editPostButtons = document.querySelectorAll(".post-edit-button");

  headerPostModalTrigger.addEventListener("click", () => {
    showModal("create");
    document.body.classList.add("modal-open");
  });

  postImageInput.addEventListener("change", (event) => {
    const input = event.target;

    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = (e) => {
        imagePreview.src = e.target.result;
      };
      reader.readAsDataURL(input.files[0]);
      return;
    }
    imagePreview.src = "";
  });

  for (let i = 0; i < editPostButtons.length; i++) {
    const button = editPostButtons[i];

    button.addEventListener("click", (event) => {
      event.preventDefault();

      document.body.classList.add("modal-open");
      showModal("edit");

      const post = button.closest(".post");
      const postId = post.dataset.postId;

      getPost(postId)
        .then((postData) => {
          document.getElementById("post-modal-caption").textContent =
            postData.caption;
          imagePreview.setAttribute("src", postData.image_dir);
        })
        .catch((error) => {
          console.error(error);
        });
    });
  }
});
