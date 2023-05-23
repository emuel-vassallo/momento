<div class="d-flex justify-content-between w-100 feed-top-section mt-2 pt-4 pe-5 pb-4 ps-5">
    <!--  Search Bar -->
    <div class="form-group has-search d-flex align-items-center">
        <span class="bi bi-search form-control-feedback"></span>
        <input type="search" class="form-control mr-sm-2" placeholder="Search" aria-label="Search">
    </div>

    <!--  Create Post Button Trigger -->
    <button type="button"
        class="btn btn-primary d-flex align-items-center justify-content-center text-nowrap bg-gradient fw-semibold"
        data-toggle="modal" data-target="#create-post-modal" id="create-post-modal-trigger">
        <i class="bi bi-plus fs-4 d-flex me-1"></i>
        Create Post
    </button>

    <?php include('create_post_modal.php') ?>
</div>