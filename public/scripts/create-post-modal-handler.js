const showModal = () => {
  const modal = new bootstrap.Modal(
    document.getElementById("create-post-modal")
  );
  modal.show();
};

document.addEventListener("DOMContentLoaded", () => {
  document
    .getElementById("create-post-modal-trigger")
    .addEventListener("click", () => {
      showModal();
      document.body.classList.add('modal-open');
    });

  document.getElementById("post-image").addEventListener("change", (event) => {
    const input = event.target;
    const imagePreview = document.getElementById("create-post-image");

    if (input.files && input.files[0]) {
      const reader = new FileReader();

      reader.onload = (e) => {
        imagePreview.src = e.target.result;
      };

      reader.readAsDataURL(input.files[0]);
    } else {
      imagePreview.innerHTML = "";
    }
  });

  const editPostButtons = document.querySelectorAll(".post-edit-button");

  for (let i = 0; i < editPostButtons.length; i++) {
    const button = editPostButtons[i];
    const post = button.closest(".post");
    const postId = post.dataset.postId;

    button.addEventListener("click", (event) => {
      event.preventDefault();
      const url = new URL(`post.php?post_id=${postId}`, window.location.href);
      url.searchParams.set("edit", "1");
      window.location.href = url;
    });
  }

  const urlParams = new URLSearchParams(window.location.search);
  const postIdFromURL = urlParams.get("post_id");
  const editMode = urlParams.get("edit");

  if (postIdFromURL && editMode === "1") {
    showModal();
    document.body.classList.add('modal-open');
  }
});
