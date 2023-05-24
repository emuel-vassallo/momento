<nav
    class="header navbar navbar-light fixed-top bg-white w-100 border border-top-0 border-start-0 border-end-0 m-0 p-0">
    <div class="container-fluid d-flex justify-content-between w-100 pt-4 pe-5 pb-4 ps-5">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center justify-content-center align-self-start" href="index.php">
            <img src="images/instagram-logo.png" width="30" height="30" class="d-inline-block align-top me-3" alt="">
            <p class="h4 m-0 p-0">Instagram</p>
        </a>

        <!--  Search Bar -->
        <div class="form-group has-search d-flex align-items-center">
            <span class="bi bi-search form-control-feedback"></span>
            <input type="search" class="form-control mr-sm-2 bg-light" placeholder="Search" aria-label="Search">
        </div>

        <!--  Create Post Button Trigger -->
        <button type="button"
            class="btn btn-primary d-flex align-items-center justify-content-center text-nowrap fw-semibold"
            data-toggle="modal" data-target="#create-post-modal" id="create-post-modal-trigger">
            <i class="bi bi-plus fs-4 d-flex me-1"></i>
            Create Post
        </button>
    </div>
</nav>