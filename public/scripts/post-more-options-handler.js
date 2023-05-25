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
      const postElement = document.querySelector(`[data-post-id="${postId}"]`);
      if (postElement) {
        postElement.remove();
      }
    })
    .catch((error) => {
      console.error(error.message);
    });
};

document.addEventListener("DOMContentLoaded", () => {
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

      confirmDeleteButton.addEventListener("click", () => {
        deletePost(postId);
        modal.hide();
      });
    });
  });
});
