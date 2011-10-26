<div class="header">
    <div class="span-16 logo">
        <h1><a href="">Re:admin</a> <span><?= Config::get('host') .':' . Config::get('port') ?></span></h1>
    </div>
    <div class="right span-4 last ui-widget">
        <label for="">Database:</label>
        <select id="database" name="database">
            <?php
                for ($i = 0; $i < Config::get('databases'); $i++) {
                    $selected   = ($i == (int)$currentdb) ? " selected='selected' " : '';
                    $count      = isset( $dbkeys[$i] ) ? $dbkeys[$i] : 0;
                    echo "<option title='{$i} ({$count})' {$selected} value='{$i}'>{$i}</option>";
                }
            ?>
        </select>
    </div>
</div>
