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

  deletePostButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const post = button.closest(".post");
      const postId = post.dataset.postId;

      // TODO: Add nicer bootstrap confirm menu.
      if (confirm("Are you sure you want to delete this post?")) {
        deletePost(postId);
      }
    });
  });
});
