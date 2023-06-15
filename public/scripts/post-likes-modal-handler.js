const getPostLikes = (postId) => {
  const url = `../core/get_post_likes.php?post_id=${encodeURIComponent(
    postId
  )}`;

  return fetch(url)
    .then((response) => {
      if (!response.ok) {
        throw new Error(response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      if (data.success) {
        return data.profiles;
      }
      throw new Error("Failed to retrieve post data");
    })
    .catch((error) => {
      console.error(error.message);
      throw error;
    });
};

const showModal = (postId = null) => {
  const profilesList = document.getElementById("post-likes-profiles");
  profilesList.innerHTML = "";

  getPostLikes(postId)
    .then((data) => {
      let html = "";
      data.forEach((profile) => {
        const userLink = `http://localhost/instagram-clone/public/user_profile.php?user_id=${profile.id}`;
        const profilePicture = `/instagram-clone${profile.profile_picture_path}`;
        const displayName = profile.display_name;
        const username = profile.username;

        html += `
          <li class="search-result-item w-100">
            <div class="p-2 d-flex align-items-center w-100 justify-content-between">
              <a href="${userLink}" class="text-decoration-none">
                <div class="post-user-info d-flex align-items-center justify-content-center">
                  <img class="post-likes-modal-profile-picture me-2 flex-shrink-0" src="${profilePicture}" alt="${displayName}'s profile picture">
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
      document.body.classList.add("modal-open");
    });
  }
});
