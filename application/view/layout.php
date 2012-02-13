<?php
/**
 * Main "layout" template
 */
?>
<!DOCTYPE html>
<html>
<?php echo View::factory('head') ?>
<body>
    <?php echo View::factory('topbar', array('currentdb' => $currentdb, 'dbkeys' => $dbkeys)) ?>
<div class="container">

    <div class="content">
        <div class="page-header">

            <img id="icon" src="/i/empty.png" alt="" >
            <input type="text" class="span9 command" id="command" placeholder="Type your redis command here .." value="<?php echo $cmd ?>" >
            <button class="btn btn-primary" id="execute">Execute</button>
<!--            <div class="alert alert-info" id="desc"><a class="close" data-dismiss="alert" href="#">&times;</a>&nbsp</div>-->
        </div>

        <div class="row">
            <div class="span14" id="content">
                <?php echo $content ?>
            </div>
        </div>
    </div>

    <?php echo View::factory('footer') ?>
</div>
<!-- /container -->

</body>
</html>
