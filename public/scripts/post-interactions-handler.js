const checkboxes = document.querySelectorAll(".like");
const postImages = document.querySelectorAll(".feed-post-image");

for (let i = 0; i < postImages.length; i++) {
  const postImage = postImages[i];

  postImage.addEventListener("dblclick", () => {
    const post = postImage.closest(".post");
    const likeButton = post.querySelector(".like");

    likeButton.checked = true;
  });
}
