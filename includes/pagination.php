<?php

$base = strtok($_SERVER['REQUEST_URI'], "?");

?>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item <?= ($paginator->page == 1) ?  'disabled' : '' ?>">
            <a class="page-link border-0 " href="<?= $base ?>?page=<?= $paginator->previous; ?>">&larr; Previous</a>
        </li>

        <li class="page-item <?= ($paginator->total_pages == $paginator->page) ?  'disabled' : '' ?>">
            <a class="page-link border-0 " href="<?= $base ?>?page=<?= $paginator->next; ?>">Next &rarr;</a>
        </li>
    </ul>
</nav>