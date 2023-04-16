<?php

/**
 * Article may come as an object or an array, so data data is stored accordingly in $data
 */

$data = [];
$data["image_only"] = strpos($_SERVER['REQUEST_URI'], "image");
$data['title'] = $data["image_only"] ? $article->title : $article[0]['title'];
$data['id'] = $data["image_only"] ? $article->id : $article[0]['id'];

?>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">
                    <?= $data["image_only"] ? 'Delete Image' : 'Delete Article'; ?> ?
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the article
                    <strong>
                        <?php echo $data['title']; ?>
                    </strong>
                    <?= $data["image_only"] ? 'image' : ''; ?> ?
                </p>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                <?php if ($data["image_only"]) : ?>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onClick="deleteImage(<?= $data['id']; ?>)">Delete Image</button>
                <?php else : ?>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onClick="deleteArticle(<?= $data['id']; ?>)">Delete</button>
                <?php endif ?>


            </div>
        </div>
    </div>
</div>