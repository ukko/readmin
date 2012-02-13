<div class="pagination">
    <ul>
        <li class="<?php echo (empty($prevURL) ? 'disabled' : '') ?> prev"><a class="cmd" href="<?php echo $prevURL ?>">&laquo;</a></li>
        <li class="<?php echo (empty($nextURL) ? 'disabled' : '') ?> "><a class="cmd" href="<?php echo $nextURL ?>">&raquo;</a></li>

        <?php foreach($pages as $page) : ?>
        <li class="<?php echo isset($page['active']) ? 'active' : '' ?>">
            <a href="<?php echo isset($page['url']) ? $page['url'] : '' ?>" class="cmd">
                <?php echo $page['number'] ?>
            </a>
        </li>
        <?php endforeach; ?>

        <li class="disabled"><a>total</a></li>
        <li class="next"><a class="cmd" href="<?php echo $totalURL ?> " rel="twipsy" title="All items <?php echo number_format($totalItems, 0, ',', ' ') ?>"><?php echo $total ?></a></li>
    </ul>
</div>
