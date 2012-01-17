<div class="pagination">
    <ul>
        <li class="<?php echo isset($page['prevURL']) ? 'disabled' : '' ?> prev"><a class="cmd" href="<?php echo $prevURL ?>">&larr;</a></li>
        <li class="<?php echo isset($page['nextURL']) ? 'disabled' : '' ?> "><a class="cmd" href="<?php echo $nextURL ?>">&rarr;</a></li>

        <?php foreach($pages as $page) : ?>
        <li class="<?php echo isset($page['active']) ? 'active' : '' ?>">
            <a href="<?php echo isset($page['url']) ? $page['url'] : '' ?>" class="cmd">
                <?php echo $page['number'] ?>
            </a>
        </li>
        <?php endforeach; ?>

        <li class="disabled"><a>total</a></li>
        <li class="next"><a class="cmd" href="<?php echo $totalURL ?> " title="All items <?php echo $totalItems ?>"><?php echo $total ?></a></li>
    </ul>
</div>
