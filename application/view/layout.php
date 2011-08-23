<?php
/**
 * Main layout view
 */
?>
<!DOCTYPE html>
<html>
    <?= View::factory('head') ?>
    <body>
        <div class="container showgrid">
            <?= View::factory('header', array('currentdb' => $currentdb)) ?>
            <hr/>
            <div class="main">
                <div class="content">

                    <div style="display: none;" class="message column append-10 ui-state-highlight ui-corner-all"></div>

                    <div class="command span-24 last">
                        <img id="icon" src="" alt="">
                        <input type="text" id="command" class="command title" value="<?= $cmd ?>"/>
                        <input type="button" class="" id="execute" value="Execute" />
                    </div>
                    <hr/>
                    <div class="result column span-24">
                        <?= $content ?>
                    </div>
                </div>
            </div>
            <hr/>
            <?= View::factory('foot') ?>
        </div>
    </body>
</html>
