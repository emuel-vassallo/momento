const getPostLikes = (postId) => {
  const url = `../core/get_post_likes.php?post_id=${encodeURIComponent(postId)}`;

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
      data.forEach((profile) => {
        const listItem = document.createElement("li");
        listItem.textContent = profile.username;
        profilesList.appendChild(listItem);
      });

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
