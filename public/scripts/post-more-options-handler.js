document.addEventListener("DOMContentLoaded", () => {
  const moreOptionsButtons = document.querySelectorAll(
    ".post-more-options-menu-button"
  );

  moreOptionsButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const post = button.closest(".post");
      const postId = post.dataset.postId;
      const posterId = post.dataset.posterId;

      console.dir({ postId, posterId });
    });
  });
});
