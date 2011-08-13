<ul class="pager">
    <li><a href="<?= $prevURL ?>" class="<?= isset($page['prevURL']) ? 'active' : '' ?> cmd prev">&lt;&lt;&lt;</a></li>
    <li><a href="<?= $nextURL ?>" class="<?= isset($page['nextURL']) ? 'active' : '' ?> cmd next">&gt;&gt;&gt;</a></li>
    <?php foreach($pages as $page) : ?>
    <li>
        <a href="<?= isset($page['url']) ? $page['url'] : '' ?>" class="<?= isset($page['active']) ? 'active' : '' ?> cmd">
            <?= $page['number'] ?>
        </a>
    </li>
    <?php endforeach; ?>
    <li class="iz">total</li>
    <li><a class="cmd" href="<?= $totalURL ?> "><?= $total ?></a></li>
</ul>
