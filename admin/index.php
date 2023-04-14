<?php

require "../includes/init.php";

Auth::requireLogin();

$db = new Database();

$conn = $db->getConn();

// Paginator props
$page = $_GET['page'] ?? 1;
$records_per_page = 5;
$total_records = Article::getTotalCount($conn);

$paginator = new Paginator($page, $records_per_page, $total_records);

$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);
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
                <th scope="col">Publish Date</th>
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
                    <td>
                        <?php
                        $datetime = new DateTime($article['published_at']);
                        echo  $article['published_at'] ? $datetime->format("j F Y") : "Not published";
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
<?php endif; ?>

<?php require '../includes/pagination.php'; ?>

<?php require '../includes/footer.php'; ?>