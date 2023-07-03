import { getUserId, followUser, unfollowUser } from "./request-utils.js";

const getUserProfileId = () => {
  const url = window.location.href;
  const urlParams = new URLSearchParams(url);
  const id = urlParams.get("user_id");
  if (id) {
    return id;
  }
  const idMatch = url.match(/user_id=(\d+)/);
  if (idMatch) {
    return idMatch[1];
  }
  return null;
};

const updateFollowersText = (countElement, action, isProfile) => {
  let currentFollowers = parseInt(countElement.textContent);

  if (action === "add") {
    currentFollowers++;
  } else if (action === "subtract") {
    currentFollowers--;
  }

  const followerText = currentFollowers === 1 ? "Follower" : "Followers";
  const text = isProfile
    ? `${currentFollowers} ${followerText}`
    : `${currentFollowers}`;

  countElement.textContent = text;
};

const handleFollowButton = async (userId, followedUserId, isUnfollowing) => {
  const sidebarCountElement = document.getElementById(
    "sidebar-user-following-count"
  );
  const profileCountElement = document.getElementById(
    "user-profile-followers-amount"
  );
  const profileFollowButton = document.getElementById(
    "user-profile-follow-button"
  );

  if (isUnfollowing) {
    if (profileFollowButton) {
      profileFollowButton.checked = true;
      updateFollowersText(profileCountElement, "subtract", true);
    }
    updateFollowersText(sidebarCountElement, "subtract", false);
    await unfollowUser(userId, followedUserId);
  } else {
    if (profileFollowButton) {
      profileFollowButton.checked = false;
      updateFollowersText(profileCountElement, "add", true);
    }
    updateFollowersText(sidebarCountElement, "add", false);
    await followUser(userId, followedUserId);
  }
};

const togglePostsFollowButton = (posterId) => {
  if (!posterId) {
    console.error(
      "posterId not found while trying to toggle follow button for posts"
    );
  }

  const postFollowButtons = document.querySelectorAll(
    `.post[data-poster-id="${parseInt(posterId)}"] .post-follow-button`
  );

  for (let i = 0; i < postFollowButtons.length; i++) {
    const button = postFollowButtons[i];

    const currentText = button.textContent.trim();

    if (currentText === "Follow") {
      button.innerHTML = `<li class="d-flex w-100 gap-2 align-items-center rounded">
    <i class="bi bi-person-dash d-flex align-items-center justify-content-center"></i>
    <p class="m-0">Unfollow</p>
    </li>`;
      return;
    }

    button.innerHTML = `<li class="d-flex w-100 gap-2 align-items-center rounded">
    <i class="bi bi-person-plus d-flex align-items-center justify-content-center"></i>
    <p class="m-0">Follow</p>
    </li>`;
  }
};

document.addEventListener("DOMContentLoaded", async () => {
  const profileFollowButton = document.getElementById(
    "user-profile-follow-button"
  );
  const moreOptionsFollowButtons = document.querySelectorAll(
    ".post-follow-button"
  );

  let userId = null;

  try {
    userId = await getUserId();
  } catch (error) {
    console.error("Error:", error);
  }

  if (profileFollowButton) {
    profileFollowButton.addEventListener("change", async () => {
      const followedUserId = getUserProfileId();
      const isUnfollowing = profileFollowButton.checked;
      handleFollowButton(userId, followedUserId, isUnfollowing);
      togglePostsFollowButton(followedUserId);
    });
  }

  for (let i = 0; i < moreOptionsFollowButtons.length; i++) {
    const button = moreOptionsFollowButtons[i];
    button.addEventListener("click", () => {
      const isUnfollowing = button.textContent.trim() === "Unfollow";
      const post = button.closest(".post");
      const posterId = parseInt(post.dataset.posterId);
      handleFollowButton(userId, posterId, isUnfollowing);
      togglePostsFollowButton(posterId);
    });
  }
});
