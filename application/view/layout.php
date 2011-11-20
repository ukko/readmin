<?php
/**
 * Main "layout" template
 */
?>
<!DOCTYPE html>
<html lang="en">
    <?= View::factory('head') ?>

<body>
    <?= View::factory('topbar', array('currentdb' => $currentdb, 'dbkeys' => $dbkeys)) ?>
<div class="container">

    <div class="content">

        <div class="page-header">
            <img id="icon" src="" alt="" >
            <input type="text" class="span12 command" id="command" placeholder="Type your redis command here ..">
            <button class="btn primary" id="execute">Execute</button>
        </div>

        <div class="row">
            <div class="span14">
                <?= $content ?>
            </div>
        </div>
    </div>

    <?= View::factory('footer') ?>
</div>
<!-- /container -->

</body>
</html>
