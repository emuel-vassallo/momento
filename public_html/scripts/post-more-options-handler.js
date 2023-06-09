import { deletePost } from "./request-utils.js";
import { getBaseUrl } from "./utility-functions.js";

const copyToClipboard = (text) => {
  const tempInput = document.createElement("input");
  tempInput.value = text;
  document.body.appendChild(tempInput);
  tempInput.select();
  navigator.clipboard.writeText(tempInput.value);
  document.body.removeChild(tempInput);
};

const handleDeletePosts = () => {
  const deletePostButtons = document.querySelectorAll(".delete-post-button");
  const confirmDeleteButton = document.getElementById("confirm-delete-post");

  deletePostButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const post = button.closest(".post");
      const postId = post.dataset.postId;

      const modal = new bootstrap.Modal(
        document.getElementById("modal-confirm-delete-post")
      );

      modal.show();
      document.body.classList.add("modal-open");

      confirmDeleteButton.addEventListener("click", () => {
        deletePost(postId)
          .then(() => {
            const scrollPosition = window.scrollY;
            window.location.reload();
            window.scrollTo(0, scrollPosition);
          })
          .catch((error) => {
            console.error(error);
          });
      });
    });
  });
};

const handleCopyLinks = () => {
  const copyLinkButtons = document.querySelectorAll(".post-copy-link-button");
  const toast = document.getElementById("toast");
  const toastMessage = document.getElementById("toast-message");

  copyLinkButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const baseUrl = getBaseUrl();
      const post = button.closest(".post");
      const postId = post.dataset.postId;
      const postLink = `${baseUrl}/post.php?post_id=${postId}`;
      copyToClipboard(postLink);

      toastMessage.textContent = 'Link copied to clipboard.';

      const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
      toastBootstrap.show();
    });
  });
};

const handleHideDeletePostModal = () => {
  document
    .querySelector("#delete-post-modal-cancel")
    .addEventListener("click", () => {
      document.querySelector(".modal-backdrop").remove();
      document.body.classList.remove("modal-open");
    });
};

document.addEventListener("DOMContentLoaded", () => {
  handleDeletePosts();
  handleCopyLinks();
  handleHideDeletePostModal();
});
