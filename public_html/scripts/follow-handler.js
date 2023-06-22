import { getUserId, followUser, unfollowUser } from "./request-utils.js";

const getUserProfileId = () => {
  const url = window.location.href;
  const id = url.match(/\d+$/)[0];
  return id;
};

document.addEventListener("DOMContentLoaded", () => {
  const followButton =
    document.getElementById("user-profile-follow-button") || null;

  if (followButton) {
    let userId = null;

    getUserId()
      .then((fetchedUserId) => {
        userId = fetchedUserId;
      })
      .catch((error) => {
        console.error("Error:", error);
      });

    followButton.addEventListener("change", async () => {
      const isUnfollowing = followButton.checked;
      const followedUserId = getUserProfileId();

      if (isUnfollowing) {
        await unfollowUser(userId, followedUserId);
      } else {
        await followUser(userId, followedUserId);
      }
    });
  }
});
