<div class="modal fade" id="post-modal" tabindex="-1" role="dialog" aria-labelledby="post-modal-label
    aria-hidden=">
    <div class=" modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="d-flex modal-header align-items-center justify-content-center">
                <h5 class="modal-title" id="post-modal-label">Create new post</h5>
            </div>
            <form id="post-modal-form" action="../core/process_post_submission.php" method="POST"
                enctype="multipart/form-data" autocomplete="off" novalidate="novalidate">
                <div class="modal-body d-flex flex-column align-items-center ms-5 me-5 p-5">
                    <label for="post-modal-image-picker" class="post-modal-image-container w-100">
                        <img id="post-modal-image" class="w-100 h-100 rounded">
                        <input type="file" class="form-control-file d-none w-100 h-100" id="post-modal-image-picker"
                            name="new_post_image_picker" accept="image/*">
                    </label>

                    <div id="errors-container_custom-post-modal-picture" class="pt-1 mb-4"></div>

                    <div class="form-group mb-4 w-100">
                        <textarea class="form-control" id="post-modal-caption" name="post_caption" rows="3"
                            placeholder="Write a caption..."></textarea>
                    </div>
                    <button id="post-modal-submit-button" type="submit" class="btn btn-primary fw-bold">Share</button>
                </div>

            </form>
        </div>
    </div>
</div>