document.addEventListener("DOMContentLoaded", () => {
  const postsLink = document.getElementById("user-profile-posts-amount");
  const target = "#user-profile-posts";

  const smoothScroll = () => {
    const element = document.querySelector(target);
    const offset = 120;

    const elementPosition = element.getBoundingClientRect().top;
    const offsetPosition = elementPosition - offset;

    window.scrollTo({
      top: offsetPosition,
      behavior: "smooth",
    });
  };

  postsLink.addEventListener("click", smoothScroll);
});
