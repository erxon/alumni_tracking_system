<nav aria-label="...">
    <ul class="pagination">
        <?php if ($page > 1) { ?>
            <li class="page-item">
                <a class="page-link" href="/thesis/alumni/index?page=<?php echo $page - 1 ?>">Previous</a>
            </li>
        <?php } else { ?>
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
        <?php } ?>

        <?php for ($i = 1; $i < $numberOfPages + 1 && $i < 3; $i++) { ?>
            <li class="page-item"><a class="page-link" href="/thesis/alumni/index?page=<?php echo $i; ?>">
                    <?php echo $i; ?>
                </a></li>
        <?php } ?>

        <?php if ($page < $numberOfPages) { ?>
            <li class="page-item">
                <a class="page-link" href="/thesis/alumni/index?page=<?php echo $page + 1; ?>">Next</a>
            </li>
        <?php } else { ?>
            <li class="page-item disabled">
                <span class="page-link">Next</span>
            </li>
        <?php } ?>
    </ul>
</nav>