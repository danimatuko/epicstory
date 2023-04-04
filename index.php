<?php

require "includes/init.php";

$db = new Database();

$conn = $db->getConn();

// Paginator props
$page = $_GET['page'] ?? 1;
$records_per_page = 5;
$total_records = Article::getTotalCount($conn);

$paginator = new Paginator($page, $records_per_page, $total_records);

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

    <?php require 'includes/pagination.php'; ?>

<?php endif; ?>

<?php require 'includes/footer.php'; ?>