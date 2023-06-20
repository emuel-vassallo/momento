import { addTransformationParameters } from "./utility-functions.js";
import { getUsersList } from "./request-utils.js";

getUsersList()
  .then((data) => {
    const searchInput = document.getElementById("search-bar");
    const resultsContainer = document.getElementById("search-results");

    const miniSearch = new MiniSearch({
      fields: ["username", "display_name"],
      storeFields: ["id", "username", "display_name", "profile_picture_path"],
    });
    miniSearch.addAll(data);

    const showResultsContainer = () => {
      if (resultsContainer.classList.contains("hidden")) {
        resultsContainer.classList.remove("hidden");
      }
    };

    const hideResultsContainer = () => {
      if (!resultsContainer.classList.contains("hidden")) {
        resultsContainer.classList.add("hidden");
      }
    };

    const displayResults = (results) => {
      let html = "";
      results.forEach((result) => {
        const posterProfilePicture = result.profile_picture_path;
        const profilePicCompressionSettings = "w_100/f_auto,q_auto:eco";
        const profilePicTransformedUrl = addTransformationParameters(
          posterProfilePicture,
          profilePicCompressionSettings
        );

        html += `
        <li class="search-result-item w-100">
              <a href="user_profile.php?user_id=${result.id}"
                  class="text-decoration-none w-100 d-flex gap-2 p-2 align-items-center justify-content-start">
            <img class='search-result-profile-picture flex-shrink-0' src='${profilePicTransformedUrl}' alt='${result.display_name}'s profile picture'>
            <p class="search-result-text text-nowrap m-0 fw-semibold fs-6 overflow-hidden flex-shrink-0 fs-6 text-body">${result.display_name}</p>
            <p class="search-result-text text-nowrap m-0 text-secondary fs-6 overflow-hidden ellipsis fs-6">@${result.username}</p>
      </a>
        </li>`;
      });
      resultsContainer.innerHTML = html;
    };

    const handleSearchInput = () => {
      const query = searchInput.value.trim();
      const results = miniSearch.search(query, { prefix: true, fuzzy: 0.2 });
      displayResults(results);

      if (searchInput.value.trim() === "" || results.length === 0) {
        hideResultsContainer();
        return;
      }
      showResultsContainer();
    };

    searchInput.addEventListener("input", handleSearchInput);
  })
  .catch((error) => {
    console.error("Error:", error);
  });
