import { getUserId, followUser, unfollowUser } from "./request-utils.js";

const getUserProfileId = () => {
  const url = window.location.href;
  const id = url.match(/\d+$/)[0];
  return id;
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

document.addEventListener("DOMContentLoaded", async () => {
  const followButton = document.getElementById("user-profile-follow-button");

  if (followButton) {
    let userId = null;

    try {
      userId = await getUserId();
    } catch (error) {
      console.error("Error:", error);
    }

    followButton.addEventListener("change", async () => {
      const isUnfollowing = followButton.checked;
      const followedUserId = getUserProfileId();
      const sidebarCountElement = document.getElementById(
        "sidebar-user-following-count"
      );
      const profileCountElement = document.getElementById(
        "user-profile-followers-amount"
      );

      if (isUnfollowing) {
        updateFollowersText(sidebarCountElement, "subtract", false);
        updateFollowersText(profileCountElement, "subtract", true);
        await unfollowUser(userId, followedUserId);
      } else {
        updateFollowersText(sidebarCountElement, "add", false);
        updateFollowersText(profileCountElement, "add", true);
        await followUser(userId, followedUserId);
      }
    });
  }
});
