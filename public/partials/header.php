<nav class="header navbar navbar-light fixed-top bg-white w-100 border-bottom-1 m-0 p-0 border-bottom flex-nowrap">
    <div class="container-fluid d-flex justify-content-between w-100 pt-4 pe-5 pb-4 ps-5">
        <a class="navbar-brand d-flex align-items-center justify-content-center align-self-start" href="index.php">
            <img src="images/instagram-logo.png" width="30" height="30" class="d-inline-block align-top me-3" alt="">
            <p class="h4 m-0 p-0">Instagram</p>
        </a>

        <div class="form-group has-search d-flex align-items-center flex-column">
            <form id="search-bar-form" autocomplete="off">
                <div class="autocomplete" style="width:300px;">
                    <span class="bi bi-search form-control-feedback"></span>
                    <input id="search-bar" type="search" class="form-control mr-sm-2 bg-light" placeholder="Search"
                        aria-label="Search">
                </div>
                <ul id="search-results"
                    class="d-flex flex-column align-items-center justify-content-center m-0 p-0 mt-2 p-2 border rounded gap-2 hidden">
                </ul>
            </form>
        </div>

        <button type="button"
            class="btn btn-primary d-flex align-items-center justify-content-center text-nowrap fw-semibold"
            data-toggle="modal" data-target="#post-modal" id="post-modal-trigger">
            <i class="bi bi-plus fs-4 d-flex me-1"></i>
            Create Post
        </button>
    </div>
</nav>
