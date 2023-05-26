const deletePost = (postId) => {
  fetch("../core/delete_post.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `post_id=${encodeURIComponent(postId)}`,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Error deleting the post");
      }
      return response.json();
    })
    .then((data) => {
      if (!data.success) {
        throw new Error(data.error);
      }

      const scrollPosition = window.scrollY;
      window.location.reload();
      window.scrollTo(0, scrollPosition);
    })
    .catch((error) => {
      console.error(error.message);
    });
};

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
        deletePost(postId);
        modal.hide();
        document.body.classList.remove("modal-open");
      });
    });
  });
};

const handleCopyLinks = () => {
  const copyLinkButtons = document.querySelectorAll(".post-copy-link-button");
  const linkCopiedToast = document.getElementById("post-link-copied-toast");

  copyLinkButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const post = button.closest(".post");
      const postId = post.dataset.postId;
      const postLink = `http://localhost/Emuel_Vassallo_4.2D/instagram-clone/public/post.php?post_id=${postId}`;

      copyToClipboard(postLink);
      const toastBootstrap =
        bootstrap.Toast.getOrCreateInstance(linkCopiedToast);
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
