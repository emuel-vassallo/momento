document.addEventListener("DOMContentLoaded", () => {
  const moreOptionsButtons = document.querySelectorAll(
    ".post-more-options-menu-button"
  );

  moreOptionsButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const postId = button.closest(".post").dataset.postId;

      console.log(postId);
    });
  });
});
