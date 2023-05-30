document.addEventListener("DOMContentLoaded", function () {
  let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));

  if ("IntersectionObserver" in window) {
    let lazyImageObserver = new IntersectionObserver(function (
      entries,
      observer
    ) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          let lazyImage = entry.target;
          lazyImage.src = lazyImage.dataset.src;
          lazyImage.classList.remove("lazy");
          lazyImageObserver.unobserve(lazyImage);
        }
      });
    });

    lazyImages.forEach(function (lazyImage) {
      lazyImageObserver.observe(lazyImage);
    });
  }

  let lazyProfilePictures = [].slice.call(
    document.querySelectorAll(".feed-card-profile-picture.lazy")
  );

  if ("IntersectionObserver" in window) {
    let lazyProfilePictureObserver = new IntersectionObserver(function (
      entries,
      observer
    ) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          let lazyProfilePicture = entry.target;
          lazyProfilePicture.src = lazyProfilePicture.dataset.src;
          lazyProfilePicture.classList.remove("lazy");
          lazyProfilePictureObserver.unobserve(lazyProfilePicture);
        }
      });
    });

    lazyProfilePictures.forEach(function (lazyProfilePicture) {
      lazyProfilePictureObserver.observe(lazyProfilePicture);
    });
  }
});
