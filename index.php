<?php

require "includes/init.php";

$db = new Database();

$conn = $db->getConn();

$paginator = new Paginator($_GET['page'] ?? 1, 4, Article::getTotalCount($conn));

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);

?>


<?php require 'includes/header.php'; ?>

<h1 class="display-3 mb-5">Articles</h1>

<?php if (empty($articles)) : ?>
    <p>No articles found.</p>
<?php else : ?>
    <ul class="list-group list-group-flush mb-5">
        <?php foreach ($articles as $article) : ?>
            <li class="list-group-item">
                <article>
                    <a href="article.php?id=<?= $article['id']; ?>">
                        <h2 class="display-6"><?= htmlspecialchars($article['title']); ?></h2>
                    </a>
                    <p><?= htmlspecialchars($article['content']); ?></p>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>


    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($paginator->page == 1) ?  'disabled' : '' ?>">
                <a class="page-link border-0 " href="?page=<?= $paginator->previous; ?>">&larr; Previous</a>
            </li>

            <li class="page-item <?= ($paginator->total_pages == $paginator->page) ?  'disabled' : '' ?>">
                <a class="page-link border-0 " href="?page=<?= $paginator->next; ?>">Next &rarr;</a>
            </li>
        </ul>
    </nav>

<?php endif; ?>

<?php require 'includes/footer.php'; ?>