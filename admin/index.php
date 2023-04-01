<?php

require "../includes/init.php";

Auth::requireLogin();

$db = new Database();

$conn = $db->getConn();

$articles = Article::getAll($conn);

?>


<?php require  "../includes/header.php"; ?>

<h1 class="display-3 mb-5">Admin</h1>

<?php if (empty($articles)) : ?>
    <p>No articles found.</p>
<?php else : ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($articles as $article) : ?>
                <tr class="">
                    <td>
                        <?= $article['id'] ?>
                    </td>
                    <td>
                        <a href="article.php?id=<?= $article['id']; ?>">
                            <?= htmlspecialchars($article['title']); ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
<?php endif; ?>


<?php require '../includes/footer.php'; ?>