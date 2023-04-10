<?php if (!empty($article->errors)) : ?>
<div class="alert alert-danger" role="alert">
    <ul>
        <?php foreach ($article->errors as $error) : ?>
        <li> <?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>


<form method="post" novalidate>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="name" name="title"
            value="<?= htmlspecialchars($article->title); ?>">
    </div>
    <div class="mb-3">
        <label for="content">Content</label>
        <textarea class="form-control" placeholder="Write a content here" id="content" name="content" rows=4>
                <?= htmlspecialchars($article->content); ?>
        </textarea>
    </div>
    <div class="mb-3">
        <label for="published_at" class="form-label">Publish date and time</label>
        <input type="datetime-local" class="form-control" id="published_at" name="published_at"
            value="<?= htmlspecialchars($article->published_at); ?>">
    </div>
    <!-- Categories -->
    <fieldset class="mb-3">
        <legend>Categories:</legend>
        <?php foreach ($categories as $category) : ?>

        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="category[]" value="<?= $category['id'] ?>"
                id="<?= $category['id'] ?>" <?php if (in_array($category['id'], $category_ids)) : ?> checked
                <?php endif; ?>>
            <label class="form-check-label" for="category<?= $category['id'] ?>">
                <?= htmlspecialchars($category['name']); ?>
            </label>
        </div>
        <?php endforeach; ?>


    </fieldset>

    <button type="submit" class="btn btn-dark w-100 mt-3">Save</button>
</form>