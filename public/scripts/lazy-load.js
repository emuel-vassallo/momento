document.addEventListener("DOMContentLoaded", () => {
  const lazyImages = [...document.querySelectorAll("img.lazy")];
  const lazyProfilePictures = [
    ...document.querySelectorAll(".feed-card-profile-picture.lazy"),
  ];

  if ("IntersectionObserver" in window) {
    const lazyImageObserver = new IntersectionObserver((entries, observer) => {
      for (let i = 0; i < entries.length; i++) {
        const entry = entries[i];
        if (entry.isIntersecting) {
          const lazyImage = entry.target;
          lazyImage.src = lazyImage.dataset.src;
          lazyImage.classList.remove("lazy");
          lazyImageObserver.unobserve(lazyImage);
        }
      }
    });

    const lazyProfilePictureObserver = new IntersectionObserver(
      (entries, observer) => {
        for (let i = 0; i < entries.length; i++) {
        const entry = entries[i];
          if (entry.isIntersecting) {
            const lazyProfilePicture = entry.target;
            lazyProfilePicture.src = lazyProfilePicture.dataset.src;
            lazyProfilePicture.classList.remove("lazy");
            lazyProfilePictureObserver.unobserve(lazyProfilePicture);
          }
        }
      }
    );

    for (let i = 0; i < lazyImages.length; i++) {
      lazyImageObserver.observe(lazyImages[i]);
    }
    
    for (let i = 0; i < lazyProfilePictures.length; i++) {
      lazyImageObserver.observe(lazyProfilePictures[i]);
    }

    return;
  }

  console.error("IntersectionObserver is not supported by this browser.");
});
