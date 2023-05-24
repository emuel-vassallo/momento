document.addEventListener("DOMContentLoaded", () => {
  fetch("../core/get_users_list.php")
    .then((response) => response.json())
    .then((data) => {
      const searchInput = document.getElementById("search-bar");
      const resultsContainer = document.getElementById("search-results");

      const miniSearch = new MiniSearch({
        fields: ["username", "display_name"],
        storeFields: ["username", "display_name"],
      });
      miniSearch.addAll(data);

      searchInput.addEventListener("input", handleSearchInput);

      function handleSearchInput() {
        const query = searchInput.value.trim();
        const results = miniSearch.search(query, { prefix: true, fuzzy: 0.2 });
        displayResults(results);
      }

      function displayResults(results) {
        let html = "";
        results.forEach((result) => {
          html += `<li>${result.username} - ${result.display_name}</li>`;
        });
        resultsContainer.innerHTML = html;
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
});
