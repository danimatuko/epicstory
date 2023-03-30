<?php if (!empty($errors)) : ?>
<div class="alert alert-danger" role="alert">
    <ul>
        <?php foreach ($errors as $error) : ?>
        <li> <?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>


<form method="POST" novalidate>
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
            value="<?= $article->published_at; ?>">
    </div>
    <button type="submit" class="btn btn-dark">Save</button>
</form>