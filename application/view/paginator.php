<div class="pagination">
    <ul>
        <li class="<?= isset($page['prevURL']) ? 'disabled' : '' ?> prev"><a class="cmd" href="<?= $prevURL ?>">&larr;</a></li>
        <li class="<?= isset($page['nextURL']) ? 'disabled' : '' ?> "><a class="cmd" href="<?= $nextURL ?>">&rarr;</a></li>

        <?php foreach($pages as $page) : ?>
        <li class="<?= isset($page['active']) ? 'active' : '' ?>">
            <a href="<?= isset($page['url']) ? $page['url'] : '' ?>" class="cmd">
                <?= $page['number'] ?>
            </a>
        </li>
        <?php endforeach; ?>

        <li class="disabled"><a>total</a></li>
        <li class="next"><a class="cmd" href="<?= $totalURL ?> "><?= $total ?></a></li>
    </ul>
</div>
