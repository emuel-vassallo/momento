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

    <!--  Create Post Modal -->
    <div class="modal fade" id="create-post-modal" tabindex="-1" role="dialog" aria-labelledby="createPostModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="d-flex modal-header align-items-center justify-content-center">
                    <h5 class="modal-title" id="createPostModalLabel">Create new post</h5>
                </div>
                <div class="modal-body d-flex flex-column align-items-center ms-5 me-5 p-5">
                    <label for="post-image"
                        class="create-post-image-container d-flex align-items-center justify-content-center mb-4 rounded border">
                        <img id="create-post-image" class="w-100 h-100 rounded"
                            src="./images/upload-image-placeholder.jpg">
                        <input type="file" class="form-control-file d-none w-100 h-100" id="post-image"
                            name="post-image" accept="image/*">
                    </label>

                    <div class="form-group mb-4 w-100">
                        <textarea class="form-control" id="post-bio" name="post-bio" rows="3"
                            placeholder="Write a caption..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary bg-gradient fw-bold">Share</button>
                </div>
            </div>
        </div>
    </div>


</div>