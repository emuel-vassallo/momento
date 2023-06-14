import { addLike, removeLike } from "./request-utils.js";

setTimeout(() => {
  document.body.className = "";
}, 100);

const updateLikesText = (post, addOrSubtract) => {
  const likesText = post.querySelector(".like-text");
  const currentLikes = parseInt(likesText.textContent);

  if (addOrSubtract === "add") {
    const newLikes = currentLikes + 1;
    likesText.textContent = `${newLikes} like${newLikes !== 1 ? "s" : ""}`;
  } else if (addOrSubtract === "subtract") {
    const newLikes = Math.max(currentLikes - 1, 0);
    likesText.textContent = `${newLikes} like${newLikes !== 1 ? "s" : ""}`;
  }
};

const getUserId = async () => {
  try {
    const response = await fetch("../core/get_user_id.php");
    const data = await response.json();
    return data.userId;
  } catch (error) {
    console.error("Error fetching user ID:", error);
    throw error;
  }
};

const handleDoubleClickLike = async (post, likeButton) => {
  const isLiked = likeButton.checked;

  if (isLiked) {
    return;
  }

  try {
    const userId = await getUserId();
    const postId = post.dataset.postId;
    addLike(userId, postId);
    updateLikesText(post, "add");
  } catch (error) {
    console.error("Error adding like:", error);
  }

  likeButton.checked = true;
};

const handleLikeButtonClick = async (post, likeButton) => {
  const isUnliked = !likeButton.checked;

  try {
    const userId = await getUserId();
    const postId = post.dataset.postId;

    if (isUnliked) {
      removeLike(userId, postId);
      updateLikesText(post, "subtract");
      return;
    }

    addLike(userId, postId);
    updateLikesText(post, "add");
  } catch (error) {
    console.error("Error adding like:", error);
  }
};

document.addEventListener("DOMContentLoaded", () => {
  const posts = document.querySelectorAll(".post");

  for (let i = 0; i < posts.length; i++) {
    const post = posts[i];
    const postImage = post.querySelector(".feed-post-image");
    const likeButton = post.querySelector(".like");

    postImage.addEventListener("dblclick", () =>
      handleDoubleClickLike(post, likeButton)
    );
    likeButton.addEventListener("click", () =>
      handleLikeButtonClick(post, likeButton)
    );
  }
});
