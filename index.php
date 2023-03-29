<?php

require 'includes/header.php';
require 'classes/Database.php';


$db = new Database();

$conn = $db->getConn();

$sql = "SELECT * 
        FROM article
        ORDER BY published_at";

$results = $conn->query($sql);

$articles = $results->fetchAll(PDO::FETCH_ASSOC);


?>



<h1 class="display-3 mb-5">Articles</h1>

<?php if (empty($articles)) : ?>
    <p>No articles found.</p>
<?php else : ?>
    <ul class="list-group list-group-flush">
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
<?php endif; ?>

<?php require 'includes/footer.php'; ?>