import { addTransformationParameters } from "./utility-functions.js";
import { getPostLikes } from "./request-utils.js";

const showModal = (postId = null) => {
  const profilesList = document.getElementById("post-likes-profiles");
  profilesList.innerHTML = "";

  getPostLikes(postId)
    .then((data) => {
      if (data === undefined) {
        console.error("No data found");
        return;
      }

      let html = "";

      document.body.classList.add("modal-open");

      data.forEach((profile) => {
        const userLink = `user_profile.php?user_id=${profile.id}`;
        const profilePicture = profile.profile_picture_path;
        const profilePicCompressionSettings = "w_100/f_auto,q_auto:eco";
        const profilePicTransformedUrl = addTransformationParameters(
          profilePicture,
          profilePicCompressionSettings
        );
        const displayName = profile.display_name;
        const username = profile.username;

        html += `
          <li class="search-result-item w-100">
            <div class="p-2 d-flex  w-100">
              <a href="${userLink}" class="text-decoration-none w-100">
                <div class="post-user-info d-flex align-items-center">
                  <img class="post-likes-modal-profile-picture me-2 flex-shrink-0" src="${profilePicTransformedUrl}" alt="${displayName}'s profile picture">
                  <div class="ps-1 d-flex flex-column">
                    <p class="m-0 fw-semibold text-body">${displayName}</p>
                    <p class="m-0 text-secondary"><small>@${username}</small></p>
                  </div>
                </div>
              </a>
            </div>
          </li>`;
      });

      profilesList.innerHTML = html;

      const modal = new bootstrap.Modal(
        document.getElementById("post-likes-modal")
      );
      modal.show();
    })
    .catch((error) => {
      console.error(error.message);
    });
};

document.addEventListener("DOMContentLoaded", () => {
  const postModalTriggers = document.querySelectorAll(".like-text");

  for (let i = 0; i < postModalTriggers.length; i++) {
    const modalTrigger = postModalTriggers[i];
    const post = modalTrigger.closest(".post");
    const postId = post.dataset.postId;

    modalTrigger.addEventListener("click", () => {
      showModal(postId);
    });
  }
});
